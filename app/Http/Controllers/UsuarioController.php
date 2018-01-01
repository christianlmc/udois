<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
    	return view('meu-perfil');
    }
}
