<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

use Udois\Usuario;
use Udois\Sala;
use Udois\Mensagem;

class Membro extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'sala_id','admin_sala',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function mensagens()
    {
        return $this->hasMany(Mensagem::class)->orderBy('hora_enviado');
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
}
