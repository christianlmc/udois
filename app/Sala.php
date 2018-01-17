<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Udois\Membro;
use Udois\Usuario;

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

    public function membros(){
        return $this->hasMany(Membro::class);
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'membros', 'sala_id', 'usuario_id');
    }
}
