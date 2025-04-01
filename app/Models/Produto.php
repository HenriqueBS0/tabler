<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

	public function vendas(): HasMany
	{
		return $this->hasMany(Venda::class);
	}

	protected function ultimaVenda(): Attribute
	{
		return Attribute::get(fn() => $this->vendas()->latest()->value('created_at')
			? Carbon::parse($this->vendas()->latest()->value('created_at'))->format('d/m/Y')
			: null);
	}

	protected function totalVendido(): Attribute
	{
		return Attribute::get(fn() => $this->vendas()->sum(DB::raw('quantidade * valor')));
	}

	protected function totalVendidoFormatado(): Attribute
	{
		return Attribute::get(fn() => number_format($this->total_vendido, 2, ',', '.'));
	}
}
