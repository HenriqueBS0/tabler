<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class LixeiraController extends Controller
{
	public function index(Request $request)
	{
		$produtosExcluidos = Produto::onlyTrashed()
			->when(
				$request->has('buscar') && $request->filled('buscar'),
				function ($query) use ($request) {
					return $query->where('descricao', 'like', '%' . $request->input('buscar') . '%');
				}
			)->paginate(10);

		return view('lixeira.index', [
			'produtos' => $produtosExcluidos
		]);
	}

	public function restore(Request $request, int $id)
	{
		$produto = Produto::onlyTrashed()->find($id);
		$produto->restore();
		session()->flash('success', "Produto '{$produto->id} - {$produto->descricao}' restaurado com sucesso!");
		return redirect()->route('lixeira.index', $request->query());
	}
}
