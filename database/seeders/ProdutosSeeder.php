<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdutosModel;

class ProdutosSeeder extends Seeder
{
    /**
     * Executa os seeders da tabela produtos.
     */
    public function run(): void
    {
        $produtos = [
            [
                'nome' => 'Notebook Dell Inspiron',
                'preco' => 3500.00,
                'quantidade' => 10,
            ],
            [
                'nome' => 'Mouse Logitech M170',
                'preco' => 80.50,
                'quantidade' => 50,
            ],
            [
                'nome' => 'Teclado Mecânico Redragon',
                'preco' => 250.99,
                'quantidade' => 20,
            ],
            [
                'nome' => 'Monitor LG 24"',
                'preco' => 899.90,
                'quantidade' => 15,
            ],
            [
                'nome' => 'Cadeira Gamer ThunderX3',
                'preco' => 1200.00,
                'quantidade' => 5,
            ],
        ];

        foreach ($produtos as $produto) {
            ProdutosModel::create($produto);
        }
    }
}
