<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Sala;
use Udois\Membro;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();

        foreach ($usuario->salas as $sala) {
            if($sala->grupo == false){
                $pessoa = Membro::where("usuario_id", '<>', Auth::user()->id)->where('sala_id', $sala->id)->first();
                $sala->foto_sala = $pessoa->usuario->foto_perfil;
                $sala->nome = $pessoa->usuario->nome;
                $sala->descricao = $pessoa->usuario->email;
            }
        }

        $salas = $usuario->salas;

        return view('home', compact('salas'));
    }
}
