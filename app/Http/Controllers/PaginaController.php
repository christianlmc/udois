<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function index(){
    	return view('cria-pagina');
    }

    public function create(){
    	return back()->with('status', 'Página Criada!');
    }
}
