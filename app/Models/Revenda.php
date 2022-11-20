<?php

namespace App\Models;

use Eloquent;

/**
 * @property int codigo
 * @property string razao_social
 * @property string nome_fantasia
 * @property int codigo_usuario
 * @property string senha_admin
 * 
 * @package App\Models
 */

class Revenda extends Eloquent
{
    protected $table = 'revenda';
    public $timestamps = false;

    protected $casts = [
        'codigo' => 'int',
        'numero' => 'int',
        'codigo_usuario' => 'int'
    ];

    protected $fillable = [
        'codigo',
        'razao_social',
        'nome_fantasia', 
        'codigo_usuario',
        'senha_admin'
    ];
}

?>