<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Udois\Membro;
use Udois\Usuario;
use Udois\Mensagem;

class Sala extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'foto_sala', 'descricao', 'grupo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'membros', 'sala_id', 'usuario_id');
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class);
    }
}
