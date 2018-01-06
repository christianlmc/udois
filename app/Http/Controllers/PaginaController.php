<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;
use Udois\Pagina;
use Illuminate\Support\Facades\Storage;
use Input;

class PaginaController extends Controller
{
    public function index(){
    	return view('cria-pagina');
    }

    public function create(Request $request){
    	$request->validate([
	    	'titulo' 			=> 'required',
			'frase_principal'	=> 'required',
			'url'				=> 'unique:paginas|required|alpha_dash',
			'foto_banner'		=> 'required|image',
	    ]);

    	$foto = $request->file('foto_banner');
    	$nome_foto = 'banner_' . time() . '.png';

	    Storage::putFileAs(
	    	'public/banners', $request->file('foto_banner'), $nome_foto
	    );

	    $pagina = $request->except('foto_banner');
	    $pagina['foto_banner'] = $nome_foto;

	    Pagina::create($pagina);

    	return back()->with('status', 'Página Criada!');
    }
}
