<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProdutosModel;

class ProdutosController extends Controller
{
    // Lista todos os produtos
    public function index()
    {
        $produtos = ProdutosModel::all();
        return response()->json($produtos);
    }

    // Mostra um produto específico
    public function show($id)
    {
        $produto = ProdutosModel::find($id);

        if (!$produto) {
            return response()->json(['mensagem' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    // Cria um novo produto
    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.min' => 'O preço deve ser maior que 0.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',
        ]);

        $produto = ProdutosModel::create($dados);

        return response()->json($produto, 201);
    }

    // Atualiza um produto existente
    public function update(Request $request, $id)
    {
        $produto = ProdutosModel::find($id);

        if (!$produto) {
            return response()->json(['mensagem' => 'Produto não encontrado'], 404);
        }

        $dados = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'preco' => 'sometimes|numeric|min:0.01',
            'quantidade' => 'sometimes|integer|min:0',
        ], [
            'nome.string' => 'O nome deve ser uma string.',
            'nome.max' => 'O nome deve ter no máximo 255 caracteres.',
            'preco.numeric' => 'O preço deve ser um número.',
            'preco.min' => 'O preço deve ser maior que 0.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade não pode ser negativa.',
        ]);

        $produto->update($dados);

        return response()->json($produto);
    }

    // Remove um produto
    public function destroy($id)
    {
        $produto = ProdutosModel::find($id);

        if (!$produto) {
            return response()->json(['mensagem' => 'Produto não encontrado'], 404);
        }

        $produto->delete();

        return response()->json(['mensagem' => 'Produto removido com sucesso']);
    }
}
