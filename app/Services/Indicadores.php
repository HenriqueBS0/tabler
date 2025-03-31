<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class Indicadores
{
	// Retorna a soma de todos os produtos em estoque
	public function produtosDisponiveis()
	{
		return Produto::sum('quantidade_estoque');
	}

	// Retorna a quantidade de produtos diferente
	public function variedadeProdutos()
	{
		return Produto::count();
	}

	// Retorna o número total de vendas
	public function vendas()
	{
		return Venda::count();
	}

	// Retorna o valor total em vendas
	public function valorEmVendas()
	{
		return 'R$ ' . number_format(Venda::sum('valor'), 2, ',', '.');
	}

	// Retorna o número de produtos com estoque baixo (quantidade_estoque <= 5, por exemplo)
	public function produtosComEstoqueBaixo()
	{
		return Produto::where('quantidade_estoque', '<=', 5)->count();
	}

	// Retorna o valor total em estoque
	public function valorTotalEmEstoque()
	{
		return 'R$ ' . number_format(Produto::sum(DB::raw('quantidade_estoque * valor')), 2, ',', '.');
	}
}
