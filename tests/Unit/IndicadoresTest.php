<?php

namespace Tests\Unit;

use App\Models\Produto;
use App\Models\Venda;
use App\Services\Indicadores;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class IndicadoresTest extends TestCase
{
	use RefreshDatabase;

	public function test_produtos_disponiveis()
	{
		Produto::factory()->createMany([
			['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100],
			['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals(15, $indicadores->produtosDisponiveis());
	}

	public function test_variedade_produtos()
	{
		Produto::factory()->createMany([
			['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100],
			['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals(2, $indicadores->variedadeProdutos());
	}

	public function test_vendas()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100]);
		$produto2 = Produto::factory()->create(['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]);

		Venda::factory()->createMany([
			['produto_id' => $produto1->id, 'quantidade' => 1, 'valor' => 100],
			['produto_id' => $produto2->id, 'quantidade' => 2, 'valor' => 400]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals(2, $indicadores->vendas());
	}

	public function test_valor_em_vendas()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100]);
		$produto2 = Produto::factory()->create(['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]);

		Venda::factory()->createMany([
			['produto_id' => $produto1->id, 'quantidade' => 1, 'valor' => 100],
			['produto_id' => $produto2->id, 'quantidade' => 2, 'valor' => 400]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals('R$ 500,00', $indicadores->valorEmVendas());
	}

	public function test_produtos_com_estoque_baixo()
	{
		Produto::factory()->createMany([
			['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100],
			['descricao' => 'Produto 2', 'quantidade_estoque' => 2, 'valor' => 200]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals(1, $indicadores->produtosComEstoqueBaixo());
	}

	public function test_valor_total_em_estoque()
	{
		Produto::factory()->createMany([
			['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100],
			['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]
		]);

		$indicadores = new Indicadores();

		$this->assertEquals('R$ 2.000,00', $indicadores->valorTotalEmEstoque());
	}

	public function test_grafico_vendas()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto 1', 'quantidade_estoque' => 10, 'valor' => 100]);
		$produto2 = Produto::factory()->create(['descricao' => 'Produto 2', 'quantidade_estoque' => 5, 'valor' => 200]);

		Venda::factory()->createMany([
			[
				'produto_id' => $produto1->id,
				'quantidade' => 1,
				'valor' => 100,
				'created_at' => Carbon::parse('2023-01-01')
			],
			[
				'produto_id' => $produto2->id,
				'quantidade' => 2,
				'valor' => 400,
				'created_at' => Carbon::parse('2023-02-01')
			],
			[
				'produto_id' => $produto2->id,
				'quantidade' => 2,
				'valor' => 400,
				'created_at' => Carbon::parse('2023-04-01')
			],
			[
				'produto_id' => $produto2->id,
				'quantidade' => 2,
				'valor' => 400,
				'created_at' => Carbon::parse('2023-04-30')
			]
		]);

		$indicadores = new Indicadores();
		$grafico = $indicadores->graficoVendas();

		$this->assertEquals(['2023-01', '2023-02', '2023-03', '2023-04'], $grafico['meses']);
		$this->assertEquals([100.00, 400.00, 0.00, 800.00], $grafico['valores']);
	}
}
