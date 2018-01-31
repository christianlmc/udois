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
	public function index($sala_id)
	{
		//Verifica se a sala existe
		try{
			$sala = Sala::with(['mensagens' => function ($query){
				$query->orderBy('created_at', 'desc')->take(50);
			}, 'mensagens.usuario'])->findOrFail($sala_id);

			$usuarios = $sala->usuarios;
			if ($sala->grupo == false) {
				//Define o nome da sala como o nome do usuario com quem esta conversando
				$sala->nome = $usuarios->where('id', '<>', Auth::id())->first()->nome;
			}
			//Ordena as mensagens da mais antiga para a mais nova
			$mensagens = $sala->mensagens->reverse()->values();
		}
		catch(Exception $e){
			return redirect('home');
		}
		foreach ($usuarios as $usuario) {
			if ($usuario->foto_perfil) {
				$usuario->foto_perfil = Storage::url('profiles/' . $usuario->foto_perfil);
			}
			else{
				$usuario->foto_perfil = asset('user.png');
			}
		}

		foreach ($mensagens as $mensagem) {
			$mensagem->hora_enviado = date('d/m/Y H:i', strtotime($mensagem->hora_enviado));
			if ($mensagem->hora_visualizado != null) {
				$mensagem->hora_visualizado = date('d/m/Y H:i', strtotime($mensagem->hora_visualizado));
			}
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
		if ($request->file('arquivo')){
			$nome_arquivo = 'file_' . Auth::id() . time() . '.' . $request->file('arquivo')->getClientOriginalExtension();
			$nome_arquivo_original = $request->file('arquivo')->getClientOriginalName();
			$pasta = 'sala_' . $sala_id . '/';

			$request->file('arquivo')->storeAs($pasta, $nome_arquivo);		
		}

		$mensagem = new Mensagem([
			'texto' => isset($nome_arquivo_original) ? $nome_arquivo_original : $request->texto,
			'hora_visualizado'	=> null,
			'hora_enviado'	=> date("Y-m-d H:i:s"),
			'arquivo'	=> isset($nome_arquivo) ? $nome_arquivo : null,
			'sala_id'	=> $sala_id,
			'usuario_id' => Auth::id()
		]);


		$mensagem->save();

		$mensagem->hora_enviado = date('d/m/Y H:i', strtotime($mensagem->hora_enviado));

		$mensagem->usuario;

		return $mensagem;
	}

	public function loadMore($sala_id, $mensagem_id)
	{
		$mensagens = Mensagem::with('usuario')
								->where('sala_id', $sala_id)
								->where('id', '<', $mensagem_id)
								->orderBy('created_at', 'desc')
								->take(50)->get();

		foreach ($mensagens as $mensagem) {
			$mensagem->hora_enviado = date('d/m/Y H:i', strtotime($mensagem->hora_enviado));
			if ($mensagem->hora_visualizado) {
				$mensagem->hora_visualizado = date('d/m/Y H:i', strtotime($mensagem->hora_visualizado));
			}
		}

		return $mensagens;
	}

	public function update($sala_id)
	{
		
		$hora_visualizado = date("Y-m-d H:i:s");
									
		Mensagem::where('hora_visualizado', null)
							->where('sala_id', $sala_id)
							->where('usuario_id', '<>', Auth::id())
							->update(['hora_visualizado' => $hora_visualizado]);

		$mensagens = Mensagem::where('sala_id', $sala_id)
							->where('usuario_id', '<>', Auth::id())
							->where('hora_visualizado', $hora_visualizado)
							->get();

		foreach ($mensagens as $mensagem) {
			$mensagem->hora_enviado = date('d/m/Y H:i', strtotime($mensagem->hora_enviado));
			$mensagem->hora_visualizado = date('d/m/Y H:i', strtotime($mensagem->hora_visualizado));
		}

		return $mensagens;		
	}
}
