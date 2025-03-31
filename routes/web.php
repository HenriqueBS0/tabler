<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LixeiraController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('produtos', ProdutoController::class)->except(['show']);

Route::resource('vendas', VendaController::class)->only(['index', 'store']);

Route::prefix('lixeira')->name('lixeira.')->controller(LixeiraController::class)->group(function () {
	Route::get('/', 'index')->name('index');
	Route::get('/restore/{id}', 'restore')->name('restore');
});
