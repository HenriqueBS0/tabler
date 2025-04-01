<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{

		$produto = request()->route('produto');

		// Se for um produto em edição, utilizamos a regra para permitir que o próprio produto não seja validado contra ele mesmo
		return [
			'descricao' => [
				'required',
				'string',
				'max:100',
				$produto ? 'unique:produtos,descricao,' . $produto->id : 'unique:produtos,descricao',
			],
			'codigo_barras' => [
				'required',
				'string',
				'max:20',
				$produto ? 'unique:produtos,codigo_barras,' . $produto->id : 'unique:produtos,codigo_barras',
			],
			'valor' => [
				'required',
				'numeric',
				'min:0',
			],
			'quantidade_estoque' => [
				'required',
				'integer',
				'min:0',
			],
		];
	}
}
