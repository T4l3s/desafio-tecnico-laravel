<?php

use App\Models\ProdutosModel;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pesquisa = request('pesquisa');

    if ($pesquisa) {
        $produtos = ProdutosModel::where('nome', 'like', '%' . $pesquisa . '%')->get();
    } else {
        $produtos = ProdutosModel::all();
    }

    return view('produtos', ['produtos' => $produtos]);
});

Route::get('/criar-produto', function () {
    return view('criar-produto');
});

Route::get('/atualizar-produto/{id}', function ($id) {
    $produto = ProdutosModel::findOrFail($id);
    return view('atualizar-produto', ['produto' => $produto]);
});