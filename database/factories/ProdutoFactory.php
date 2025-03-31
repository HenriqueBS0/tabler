<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'descricao' => fake()->unique()->sentence(3),
			'codigo_barras' => fake()->unique()->numerify('############'),
			'valor' => fake()->randomFloat(2, 1, 300),
			'quantidade_estoque' => fake()->numberBetween(0, 500),
		];
	}
}
