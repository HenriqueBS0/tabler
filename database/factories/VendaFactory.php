<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendaFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		// Seleciona um produto aleatório para a venda
		$produto = Produto::inRandomOrder()->first();

		// Retorna os dados fictícios da venda
		return [
			'quantidade' => $this->faker->numberBetween(1, 10),  // Quantidade entre 1 e 10
			'valor' => $produto->valor,  // Calcula o valor com base no produto e na quantidade
			'produto_id' => $produto->id,  // Relaciona o produto à venda
		];
	}
}
