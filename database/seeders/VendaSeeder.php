<?php

namespace Database\Seeders;

use App\Models\Venda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class VendaSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		// Cria 100 vendas aleatórias, distribuídas entre os dois últimos anos
		// Excluindo Maio de 2024
		$startDate = Carbon::now()->subYears(1); // Dois anos atrás
		$endDate = Carbon::now(); // Data atual

		for ($i = 0; $i < 100; $i++) {
			do {
				$randomDate = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));
			} while ($randomDate->year == 2024 && $randomDate->month == 8);

			Venda::factory()->create([
				'created_at' => $randomDate,
				'updated_at' => $randomDate
			]);
		}
	}
}
