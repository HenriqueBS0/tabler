<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$produtos = Produto::when(
			$request->has('buscar') && $request->filled('buscar'),
			function ($query) use ($request) {
				return $query->where('descricao', 'like', '%' . $request->input('buscar') . '%');
			}
		)->paginate(10);

		$data = ['produtos' => $produtos];

		if ($request->has('idDestroy')) {
			$data['produtoDestroy'] = Produto::find($request->input('idDestroy'));
		}

		return view('produto.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('produto.form', [
			'title' => 'Novo produto',
			'action' => route('produtos.store'),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(ProdutoRequest $request)
	{
		$produto = Produto::create($request->validated());
		session()->flash('success', "Produto '{$produto->id} - {$produto->descricao}' criado com sucesso!");
		return redirect()->route('produtos.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Produto $produto)
	{
		return view('produto.form', [
			'title' => "Alterar produto: {$produto->id} - {$produto->descricao}",
			'action' => route('produtos.update', ['produto' => $produto]),
			'produto' => $produto
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(ProdutoRequest $request, Produto $produto)
	{
		$produto->update($request->validated());
		session()->flash('success', "Produto '{$produto->id} - {$produto->descricao}' alterado com sucesso!");
		return redirect()->route('produtos.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Produto $produto)
	{
		$produto->delete();
		session()->flash('success', "Produto '{$produto->id} - {$produto->descricao}' excluído com sucesso!");
		return redirect()->route('produtos.index');
	}
}
