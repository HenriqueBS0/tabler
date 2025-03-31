<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LixeiraController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('produtos', ProdutoController::class)->except(['show']);
Route::resource('vendas', VendaController::class);
Route::resource('lixeira', LixeiraController::class)->only([
	'index'
]);
