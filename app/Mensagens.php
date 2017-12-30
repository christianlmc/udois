<?php

namespace Udois;

use Illuminate\Database\Eloquent\Model;

class Mensagens extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'texto', 'id_membro', 'hora_visualizado', 'hora_enviado', 'arquivo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 
    ];
}
