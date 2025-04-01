<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProdutoControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_index()
	{
		$produtos = Produto::factory(5)->create();
		$response = $this->get(route('produtos.index'));
		$response->assertStatus(Response::HTTP_OK)
			->assertViewIs('produto.index');

		foreach ($produtos as $produto) {
			$response->assertSee($produto->descricao);
		}
	}

	public function test_busca_produto()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto Teste A']);
		$produto2 = Produto::factory()->create(['descricao' => 'Outro Produto']);

		$response = $this->get(route('produtos.index', ['buscar' => 'Teste']));

		$response->assertStatus(200)
			->assertViewIs('produto.index')
			->assertSee($produto1->descricao)
			->assertDontSee($produto2->descricao);
	}

	public function test_create()
	{
		$response = $this->get(route('produtos.create'));

		$response->assertStatus(Response::HTTP_OK)
			->assertViewIs('produto.form')
			->assertSee('Novo produto')
			->assertSeeHtml('name="descricao"')
			->assertSeeHtml('name="quantidade_estoque"')
			->assertSeeHtml('name="codigo_barras"')
			->assertSeeHtml('name="valor"');
	}

	public function test_store()
	{
		$dados = [
			'descricao' => 'Produto Teste',
			'codigo_barras' => '1234567890123',
			'valor' => 100.00,
			'quantidade_estoque' => 10,
		];

		$response = $this->post(route('produtos.store'), $dados);

		$response->assertRedirect(route('produtos.index'));
		$this->assertDatabaseHas('produtos', $dados);
	}

	public function test_edit()
	{
		$produto = Produto::factory()->create();

		$response = $this->get(route('produtos.edit', ['produto' => $produto]));

		$response->assertStatus(Response::HTTP_OK)
			->assertViewIs('produto.form')
			->assertSee('Alterar produto')
			->assertSeeHtml('name="descricao"')
			->assertSeeHtml('name="quantidade_estoque"')
			->assertSeeHtml('name="codigo_barras"')
			->assertSeeHtml('name="valor"');
	}

	public function test_update()
	{
		$produto = Produto::factory()->create();

		$dadosAtualizados = [
			'descricao' => 'Produto Atualizado',
			'codigo_barras' => '1234567890124',
			'valor' => 150.00,
			'quantidade_estoque' => 5,
		];

		$response = $this->put(route('produtos.update', ['produto' => $produto]), $dadosAtualizados);

		$response->assertRedirect(route('produtos.index'));
		$this->assertDatabaseHas('produtos', $dadosAtualizados);
	}

	public function test_confirm_destroy()
	{
		$produto = Produto::factory()->create();

		$response = $this->get(route('produtos.index', ['idDestroy' => $produto->id]));
		$response->assertStatus(Response::HTTP_OK)
			->assertViewIs('produto.index')
			->assertSee("Deseja realmente excluir o produto '{$produto->id} - {$produto->descricao}'?");
	}

	public function test_destroy()
	{
		$produto = Produto::factory()->create();

		$response = $this->delete(route('produtos.destroy', ['produto' => $produto]));

		$response->assertRedirect(route('produtos.index'));
		$this->assertSoftDeleted('produtos', ['id' => $produto->id]);
	}
}
