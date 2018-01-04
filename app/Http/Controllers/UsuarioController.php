<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Usuario;
use Auth;
use Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
    	return view('meu-perfil');
    }

    public function atualizarPerfil(Request $request)
    {
    	$request->validate([
	    	'nome' => 'sometimes|required',
	    	'senha' => 'sometimes|required|confirmed',
	    ]);

    	$foto = $request->input('foto_perfil');

    	if($foto){
    		list($type, $foto) = explode(';', $foto);
    		list(, $foto) = explode(',', $foto);
	    	
	    	if(base64_encode(base64_decode($foto)) === $foto){	//Verifica se a foto esta no formato correto
	    		$foto = base64_decode($foto);
	    		$nome_foto = 'profile_' . Auth::id() . time() . '.png';
	    		Storage::put('public/profiles/' . $nome_foto, $foto);
	    		$request->merge(['foto_perfil' => $nome_foto]);
	    	}
	    	else{
	    		return back();
	    	}
	    }

	    if ($request->input('senha')) {
	    	$request->merge(['senha' => Hash::make($request->input('senha'))]);
	    }
	    Auth::user()->update($request->all());
	    
	    return back()->with('status', 'Perfil Atualizado!');
	}
}
