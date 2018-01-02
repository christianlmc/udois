<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
    	return view('meu-perfil');
    }

    public function atualizarPerfil(Request $request)
    {
    	$data = $request->input('foto_perfil');

    	list($type, $data) = explode(';', $data);
    	list(, $data) = explode(',', $data);

    	$data = base64_decode($data);

    	Storage::put('public/', $data);
    }
}
