<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Udois\Sala;

class Usuario extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'email', 'senha', 'admin', 'foto_perfil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha', 'remember_token',
    ];

    public function salas()
    {
        return $this->belongsToMany(Sala::class, 'membros', 'usuario_id', 'sala_id');
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }
}
