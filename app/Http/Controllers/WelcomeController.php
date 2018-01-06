<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Pagina;
use Udois\Usuario;

class WelcomeController extends Controller
{
	public function index()
	{
		$paginas = Pagina::all();
		$admin = Usuario::where('admin', true)->first();
		return view('welcome', compact('paginas', 'admin'));
	}
}
