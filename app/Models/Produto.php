<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
	use HasFactory;
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'descricao',
		'codigo_barras',
		'valor',
		'quantidade_estoque',
	];

	protected function valorFormatado(): Attribute
	{
		return Attribute::get(fn() => number_format($this->valor, 2, ',', '.'));
	}
}
