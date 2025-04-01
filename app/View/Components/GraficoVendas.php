<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GraficoVendas extends Component
{
	public $meses = [];
	public $valores = [];

	/**
	 * Create a new component instance.
	 */
	public function __construct(array $dados)
	{
		$this->meses = $dados['meses'];
		$this->valores = $dados['valores'];
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.grafico-vendas');
	}
}
