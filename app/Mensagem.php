<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Udois\Usuario;
use Udois\Membro;

class Mensagem extends Model
{
	protected $table = 'mensagens';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'texto', 'membro_id', 'hora_visualizado', 'hora_enviado', 'arquivo',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		// 
	];

	public function membro()
	{
		return $this->belongsTo(Membro::class);
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class)->withPivot('usuario_id')->using(Membro::class);
	}
}
