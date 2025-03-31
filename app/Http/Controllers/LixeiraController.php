<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class LixeiraController extends Controller
{
	public function index(Request $request)
	{
		$data = [
			'produtos' => Produto::onlyTrashed()->when($request->has('buscar'), function ($query) use ($request) {
				return $query->where('descricao', 'like', '%' . $request->input('buscar') . '%');
			})->paginate(10)
		];

		return view('lixeira.index', $data);
	}

	public function restore(Request $request, int $id)
	{
		// Recupera o produto excluído usando onlyTrashed()
		$produto = Produto::onlyTrashed()->find($id);
		$produto->restore();  // Restaura o produto excluído
		session()->flash('success', "Produto '{$produto->id} - {$produto->descricao}' restaurado com sucesso!");

		// Redireciona para a página de lixeira e mantém os parâmetros da URL
		return redirect()->route('lixeira.index', $request->query());
	}
}
