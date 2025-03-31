<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('vendas', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->integer('quantidade');
			$table->float('valor');
			$table->foreignId('produto_id')->references('id')->on('produtos')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('vendas');
	}
};
