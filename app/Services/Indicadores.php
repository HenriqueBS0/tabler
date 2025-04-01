<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Indicadores
{
	public function produtosDisponiveis()
	{
		return Produto::sum('quantidade_estoque');
	}

	public function variedadeProdutos()
	{
		return Produto::count();
	}

	public function vendas()
	{
		return Venda::count();
	}

	public function valorEmVendas()
	{
		return 'R$ ' . number_format(Venda::sum('valor'), 2, ',', '.');
	}

	public function produtosComEstoqueBaixo()
	{
		return Produto::where('quantidade_estoque', '<=', 5)->count();
	}

	public function valorTotalEmEstoque()
	{
		return 'R$ ' . number_format(Produto::sum(DB::raw('quantidade_estoque * valor')), 2, ',', '.');
	}

	public function graficoVendas()
	{
		$primeiraVenda = Venda::orderBy('created_at', 'asc')->first();
		$ultimaVenda = Venda::orderBy('created_at', 'desc')->first();

		if (!$primeiraVenda || !$ultimaVenda) {
			return [
				'meses' => [],
				'valores' => []
			];
		}

		$periodoInicial = Carbon::parse($primeiraVenda->created_at)->startOfMonth();
		$periodoFinal = Carbon::parse($ultimaVenda->created_at)->endOfMonth();

		$meses = [];
		$valores = [];

		$currentMonth = $periodoInicial->copy();

		while ($currentMonth->lte($periodoFinal)) {
			$meses[] = $currentMonth->format('Y-m');

			$totalVenda = Venda::whereYear('created_at', $currentMonth->year)
				->whereMonth('created_at', $currentMonth->month)
				->sum('valor');

			$valores[] = $totalVenda ? round($totalVenda, 2) : 0;

			$currentMonth->addMonth();
		}

		return [
			'meses' => $meses,
			'valores' => $valores
		];
	}
}
