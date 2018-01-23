<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Sala;
use Udois\Membro;
use Auth;
use Storage;

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
        //Pega as Salas e os Membros das Salas em que o usuario esta
        $salas = Auth::user()->salas()->with('usuarios')->get();

        foreach ($salas as $sala) {
            if ($sala->grupo == false) {
                //Pega o outro usuario pertencente a sala
                $usuario = $sala->usuarios->where('id', '<>', Auth::id())->first();

                //Seta os atributos do usuario como se fosse uma sala
                if($usuario->foto_perfil) 
                    $sala->foto_sala = Storage::url('profiles/' . $usuario->foto_perfil);
                else
                    $sala->foto_sala = asset('user.png');
                $sala->nome = $usuario->nome;
                $sala->descricao = $usuario->email;
            }
            else{
                //Modifica o atributo foto_sala para conseguir puxar a foto armazenada
                if ($sala->foto_sala)
                    $sala->foto_sala = Storage::url('profiles/' . $sala->foto_sala);
                else
                    $sala->foto_sala = asset('group.png');
            }
        }

        return view('home', compact('salas'));
    }
}
