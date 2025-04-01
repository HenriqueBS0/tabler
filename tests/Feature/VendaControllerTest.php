<?php

namespace Tests\Feature;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class VendaControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_listagem_de_vendas()
	{
		$produto = Produto::factory()->create();

		$venda = Venda::factory()->create([
			'produto_id' => $produto->id,
			'quantidade' => 2,
			'valor' => 100.00,
		]);

		$response = $this->get(route('vendas.index'));

		$response->assertStatus(Response::HTTP_OK);
		$response->assertSee($produto->descricao);
		$response->assertSee($venda->valor);
	}

	public function test_listagem_de_vendas_com_filtro()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto A']);
		$produto2 = Produto::factory()->create(['descricao' => 'Produto B']);

		Venda::factory()->create(['produto_id' => $produto1->id, 'quantidade' => 1, 'valor' => 50.00]);
		Venda::factory()->create(['produto_id' => $produto2->id, 'quantidade' => 1, 'valor' => 75.00]);

		$response = $this->get(route('vendas.index', ['buscar' => 'Produto A']));

		$response->assertStatus(Response::HTTP_OK);
		$response->assertSeeHtml("<td>{$produto1->descricao}</td>");
		$response->assertDontSeeHtml("<td>{$produto2->descricao}</td>");
	}

	public function test_criar_venda_com_estoque_suficiente()
	{
		$produto = Produto::factory()->create(['quantidade_estoque' => 10]);

		$response = $this->post(route('vendas.store'), [
			'produto_id' => $produto->id,
			'quantidade' => 2,
			'valor' => 100.00,
		]);

		$response->assertRedirect(route('vendas.index'));
		$response->assertSessionHas('success', 'Venda registrada com sucesso!');

		$produto->refresh();
		$this->assertEquals(8, $produto->quantidade_estoque);

		$this->assertDatabaseHas('vendas', [
			'produto_id' => $produto->id,
			'quantidade' => 2,
			'valor' => 100.00,
		]);
	}

	public function test_criar_venda_com_estoque_insuficiente()
	{
		$produto = Produto::factory()->create(['quantidade_estoque' => 2]);

		$response = $this->post(route('vendas.store'), [
			'produto_id' => $produto->id,
			'quantidade' => 5,
			'valor' => 100.00,
		]);

		$response->assertSessionHas('error', 'Quantidade solicitada excede o estoque disponível.');
	}

	public function test_criar_venda_com_atualizacao_de_valor_do_produto()
	{
		$produto = Produto::factory()->create(['quantidade_estoque' => 10, 'valor' => 100.00]);

		$response = $this->post(route('vendas.store'), [
			'produto_id' => $produto->id,
			'quantidade' => 2,
			'valor' => 150.00,
			'atualizar_valor_produto' => true,
		]);

		$response->assertRedirect(route('vendas.index'));
		$response->assertSessionHas('success', 'Venda registrada com sucesso!');

		$produto->refresh();
		$this->assertEquals(8, $produto->quantidade_estoque);

		$this->assertEquals(150.00, $produto->valor);

		$this->assertDatabaseHas('vendas', [
			'produto_id' => $produto->id,
			'quantidade' => 2,
			'valor' => 150.00,
		]);
	}
}
