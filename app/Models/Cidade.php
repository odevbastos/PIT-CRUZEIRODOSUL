<?php

namespace App\Models;

use Eloquent;

/**
 * Class Cidade
 * 
 * @property int $codigo
 * @property string $nome
 * 
 * @package App\Models
 */

class Cidade extends Eloquent
{
	protected $table = 'cidade';
	public $timestamps = false;

	protected $casts = [
		'codigo' => 'int'
	];

	protected $fillable = [
		'codigo',
		'nome'
	];
}

?>