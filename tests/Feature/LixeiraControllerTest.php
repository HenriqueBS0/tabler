<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LixeiraControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_produtos_excluidos_sao_listados()
	{
		$produto = Produto::factory()->create();
		$produto->delete();

		$response = $this->get(route('lixeira.index'));

		$response->assertStatus(Response::HTTP_OK);
		$response->assertSee($produto->descricao);
	}

	public function test_produtos_excluidos_podem_ser_filtrados_por_nome()
	{
		$produto1 = Produto::factory()->create(['descricao' => 'Produto A']);
		$produto1->delete();

		$produto2 = Produto::factory()->create(['descricao' => 'Produto B']);
		$produto2->delete();

		$response = $this->get(route('lixeira.index', ['buscar' => 'Produto A']));

		$response->assertStatus(Response::HTTP_OK);
		$response->assertSee($produto1->descricao);
		$response->assertDontSee($produto2->descricao);
	}

	public function test_produto_excluido_pode_ser_restaurado()
	{
		$produto = Produto::factory()->create();
		$produto->delete();
		$response = $this->get(route('lixeira.restore', ['id' => $produto->id]));

		$response->assertRedirect(route('lixeira.index'));
		$response->assertSessionHas('success', "Produto '{$produto->id} - {$produto->descricao}' restaurado com sucesso!");

		$this->assertFalse($produto->fresh()->trashed());
	}
}
