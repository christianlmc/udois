<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Udois\Usuario;
use Udois\Membro;
use Udois\Sala;

class Mensagem extends Model
{
	protected $table = 'mensagens';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'texto', 'usuario_id', 'sala_id', 'hora_visualizado', 'hora_enviado', 'arquivo', 'audio',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		// 
	];

	public function sala()
	{
		return $this->belongsTo(Sala::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
