<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Venda extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'quantidade',
		'valor',
		'produto_id',
	];

	protected function valorFormatado(): Attribute
	{
		return Attribute::get(fn() => number_format($this->valor, 2, ',', '.'));
	}

	protected function valorTotal(): Attribute
	{
		return Attribute::get(fn() => $this->quantidade * $this->valor);
	}

	protected function valorTotalFormatado(): Attribute
	{
		return Attribute::get(fn() => number_format($this->valor_total, 2, ',', '.'));
	}

	public function produto(): BelongsTo
	{
		return $this->belongsTo(Produto::class);
	}
}
