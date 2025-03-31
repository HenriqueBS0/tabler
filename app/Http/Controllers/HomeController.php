<?php

namespace App\Http\Controllers;

use App\Services\Indicadores;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		return view('home', ['indicadores' => new Indicadores()]);
	}
}
