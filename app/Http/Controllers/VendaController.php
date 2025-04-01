<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$produtos = Produto::all()->map(fn($produto) => [
			'id' => $produto->id,
			'descricao' => $produto->descricao,
			'valor' => $produto->valor,
			'quantidade_estoque' => $produto->quantidade_estoque
		]);

		$vendas = DB::table('vendas')->join('produtos', 'vendas.produto_id', '=', 'produtos.id')
			->select('vendas.*', 'produtos.descricao as produto_descricao');

		if ($request->has('buscar') && $request->filled('buscar')) {
			$vendas->where('produtos.descricao', 'like', "%{$request->input('buscar')}%");
		}

		$vendas = $vendas->paginate(5);

		return view('venda.index', ['produtos' => $produtos, 'vendas' => $vendas]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'produto_id' => 'required|exists:produtos,id',
			'quantidade' => 'required|integer|min:1',
			'valor' => 'required|numeric|min:0',
		]);

		$produto = Produto::findOrFail($request->produto_id);

		if ($request->quantidade > $produto->quantidade_estoque) {
			return redirect()->back()->with('error', 'Quantidade solicitada excede o estoque disponível.');
		}

		Venda::create([
			'produto_id' => $request->produto_id,
			'quantidade' => $request->quantidade,
			'valor' => $request->valor,
		]);

		$produto->quantidade_estoque -= $request->quantidade;

		if ($request->boolean('atualizar_valor_produto')) {
			$produto->valor = $request->valor;
		}

		$produto->update();

		return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
	}
}
