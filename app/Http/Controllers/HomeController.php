<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Sala;
use Udois\Usuario;
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

        //Variavel que pega todos os usuarios que o usuario tem chat aberto (incluindo ele mesmo)
        $id_usuarios = [Auth::id()];

        foreach ($salas as $sala) {
            //Se a sala não for um grupo
            if ($sala->grupo == false) {
                //Pega o outro usuario pertencente a sala
                $usuario = $sala->usuarios->where('id', '<>', Auth::id())->first();

                array_push($id_usuarios, $usuario->id);

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

            $sala->nao_lidas = $sala->mensagens->where('hora_visualizado', null)
                                                ->where('usuario_id', '<>', Auth::id())
                                                ->count();
        }

        if (Auth::user('admin')) {
            $usuarios_sem_chat_com_admin = Usuario::whereNotIn('id', $id_usuarios)->get();

            $usuarios = [];
            foreach ($usuarios_sem_chat_com_admin as $usuario) {
                $sala = new Sala([
                    'nome' => $usuario->nome,
                    'descricao'  => $usuario->email,
                    'foto_sala' => $usuario->foto_perfil ? Storage::url('profiles/' . $usuario->foto_perfil) : asset('user.png'),
                ]);
                $sala->id = $usuario->id;

                array_push($usuarios, $sala);
            }

            return view('home', compact('salas', 'usuarios'));
        }
        else{
            return view('home', compact('salas'));
        }

    }

    public function adminCreate($usuario_id)
    {
        dd($usuario_id);
    }
}
