<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Pagina;
use Udois\Usuario;
use Illuminate\Support\Facades\Storage;

class PaginaController extends Controller
{
    public function index(){
    	return view('cria-pagina');
    }

    public function single($url){
        $pagina = Pagina::where('url', $url)->first();
        $admin = Usuario::where('admin', true)->first();


        if($pagina)
            return view('pagina', compact('pagina', 'admin'));
        else
            return abort(404);
    }

    public function list(){
    	$paginas = Pagina::all();
    	return view('editar-pagina', compact('paginas'));
    }

    public function get($id){
        $pagina = Pagina::findOrFail($id);
        return response()->json($pagina);
    }

    public function edit(Request $request){
        $pagina = Pagina::find($request->id);

        $request->validate([
            'titulo'            => 'sometimes|required',
            'frase_principal'   => 'sometimes|required',
            'url'               => 'sometimes|unique:paginas|required|alpha_dash',
            'foto_banner'       => 'sometimes|required|image|max:10000',
        ]);

        $pagina->update($request->all());

        return back()->with('status', 'Página Atualizada!');
    }

    public function delete(Request $request){
        $pagina = Pagina::find($request->id);

        if($pagina){
            Storage::delete('public/banners/' . $pagina->foto_banner);
            $pagina->delete();
            return back()->with('status', 'A página foi excluida com sucesso!');
        }
        else{
            return back()->with('error', 'Ocorreu um erro ao deletar a pagina!');   
        }

    }

    public function create(Request $request){
    	$request->validate([
	    	'titulo' 			=> 'required',
			'frase_principal'	=> 'required',
			'url'				=> 'unique:paginas|required|alpha_dash',
			'foto_banner'		=> 'required|image|max:10000',
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
