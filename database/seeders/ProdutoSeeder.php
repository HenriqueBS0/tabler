<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// Produtos reais de supermercado
		$produtosFixos = [
			['descricao' => 'Arroz Branco 5kg', 'valor' => 25.90, 'quantidade_estoque' => 50],
			['descricao' => 'Feijão Preto 1kg', 'valor' => 7.50, 'quantidade_estoque' => 100],
			['descricao' => 'Óleo de Soja 900ml', 'valor' => 8.90, 'quantidade_estoque' => 80],
			['descricao' => 'Açúcar Refinado 1kg', 'valor' => 4.20, 'quantidade_estoque' => 120],
			['descricao' => 'Macarrão Espaguete 500g', 'valor' => 5.80, 'quantidade_estoque' => 90],
			['descricao' => 'Café em Pó 250g', 'valor' => 12.00, 'quantidade_estoque' => 60],
			['descricao' => 'Leite Integral 1L', 'valor' => 6.50, 'quantidade_estoque' => 110],
			['descricao' => 'Margarina 500g', 'valor' => 9.30, 'quantidade_estoque' => 75],
			['descricao' => 'Farinha de Trigo 1kg', 'valor' => 5.40, 'quantidade_estoque' => 85],
			['descricao' => 'Sal Refinado 1kg', 'valor' => 3.90, 'quantidade_estoque' => 95],
			['descricao' => 'Detergente Líquido 500ml', 'valor' => 2.80, 'quantidade_estoque' => 200],
			['descricao' => 'Sabão em Pó 1kg', 'valor' => 15.70, 'quantidade_estoque' => 50],
			['descricao' => 'Papel Higiênico 12 rolos', 'valor' => 22.50, 'quantidade_estoque' => 100],

			// Excluídos
			['descricao' => 'Shampoo 350ml', 'valor' => 14.90, 'quantidade_estoque' => 70, 'deleted_at' => now()],
			['descricao' => 'Creme Dental 90g', 'valor' => 5.30, 'quantidade_estoque' => 90, 'deleted_at' => now()],
		];

		// Inserir produtos fixos
		foreach ($produtosFixos as $produto) {
			Produto::factory()->create($produto);
		}

		// Gerar mais 35 produtos aleatórios usando a factory
		Produto::factory()->count(35)->create();
	}
}
