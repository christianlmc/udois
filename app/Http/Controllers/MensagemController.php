<?php

namespace Udois\Http\Controllers;

use Illuminate\Http\Request;

use Udois\Sala;
use Udois\Mensagem;
use Udois\Membro;
use Auth;
use Exception;
use Storage;

class MensagemController extends Controller
{
	public function index($id)
	{
		//Verifica se a sala existe
		try{
			$sala = Sala::with('mensagens.membro')->findOrFail($id);
			$usuarios = $sala->usuarios;
			if ($sala->grupo == false) {
				//Define o nome da sala como o nome do usuario com quem esta conversando
				$sala->nome = $usuarios->where('id', '<>', Auth::id())->first()->nome;
			}
			$mensagens = $sala->mensagens;
		}
		catch(Exception $e){
			return redirect('home');
		}
		foreach ($usuarios as $usuario) {
			$usuario->foto_perfil = Storage::url('profiles/' . $usuario->foto_perfil);
		}
		//Verifica se o usuario pertence a sala
		foreach ($sala->usuarios as $usuario) {
			if ($usuario->id == Auth::id()) {
				return view('mensagens', compact('sala', 'usuarios', 'mensagens'));
			}
		}

		return redirect('home');
	}

	public function create(Request $request, $sala_id)
	{
		$usuario = Auth::user();

		try {
			$membro = Membro::where('sala_id', $sala_id)
							->where('usuario_id', $usuario->id)
							->first();
		} catch (Exception $e) {
			
		}

		$mensagem = new Mensagem([
			'texto' => $request->texto,
			'id_membro'	=> $membro->id,
			'hora_visualizado'	=> null,
			'hora_enviado'	=> date("Y-m-d H:i:s"),
			'arquivo'	=> false,
			'membro_id'	=> $membro->id,
		]);

		$mensagem->membro;
		return $mensagem;
	}
}
