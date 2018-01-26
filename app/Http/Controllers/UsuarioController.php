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

    public function update(Request $request)
    {
    	$request->validate([
	    	'nome' => 'sometimes|required',
	    	'senha' => 'sometimes|required|confirmed',
	    ]);

    	$foto = $request->input('foto_perfil');
    	$usuario = Auth::user();

    	if($foto){
    		$foto = explode(',', $foto)[1]; //Remove o cabecalho da foto para upload
	    	
	    	if(base64_encode(base64_decode($foto)) === $foto){	//Verifica se a foto esta no formato correto
	    		$foto = base64_decode($foto);
	    		$nome_foto = 'profile_' . Auth::id() . time() . '.png';
	    		Storage::put('public/profiles/' . $nome_foto, $foto);
	    		
	    		if($usuario->foto_perfil) 
	    			Storage::delete('public/profiles/' . $usuario->foto_perfil);
	    		
	    		$request->merge(['foto_perfil' => $nome_foto]);
	    	}
	    	else{
	    		return back();
	    	}
	    }

	    if ($request->input('senha')) {
	    	$request->merge(['senha' => Hash::make($request->input('senha'))]);
	    }

	    $usuario->update($request->all());
	    
	    return back()->with('status', 'Perfil Atualizado!');
	}
}
