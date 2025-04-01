<?php

namespace App\Http\Controllers;

use App\Services\Indicadores;

class HomeController extends Controller
{
	public function index(Indicadores $indicadores)
	{
		return view('home', [
			'produtosDisponiveis' => $indicadores->produtosDisponiveis(),
			'variedadeProdutos' => $indicadores->variedadeProdutos(),
			'vendas' => $indicadores->vendas(),
			'valorEmVendas' => $indicadores->valorEmVendas(),
			'produtosComEstoqueBaixo' => $indicadores->produtosComEstoqueBaixo(),
			'valorTotalEmEstoque' => $indicadores->valorTotalEmEstoque(),
			'graficoVendas' => $indicadores->graficoVendas()
		]);
	}
}
