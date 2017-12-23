<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paginas extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo', 'url', 'foto_banner', 'frase_principal', 'frase_2', 'frase_3', 'frase_4',
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
