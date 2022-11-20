<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 02 Oct 2019 18:14:00 +0000.
 */

namespace App\Models;

use Eloquent;

/**
 * Class Usuario
 * 
 * @property int $usr_codigo
 * @property string $usr_login
 * @property string $usr_senha
 * @property string $usr_administrador
 * @property string $usr_nome 
 * @property string $usr_email 
 *  
 * @property string $remember_token
 *
 * @package App\Models
 */
class Usuario extends Eloquent
{
	protected $table = 'fr_usuario';
	protected $primaryKey = 'usr_codigo';
	public $timestamps = false;

	public function getPrimeiroNome() {
		$ret = explode(' ', trim($this->usr_nome));
		return $ret[0];
    }
    
	public function getNome() {
        $usr_nome = $this->usr_nome;
		return $usr_nome;
    }

    public function getSaudacao() {
        $h = (integer)date("H");
        if($h >= 12 && $h<18) {
            $msg = "Boa tarde, {$this->getPrimeiroNome()}.";
        }else if ($h >= 0 && $h <12 ){
            $msg = "Bom dia, {$this->getPrimeiroNome()}.";
        }else {
            $msg = "Boa noite, {$this->getPrimeiroNome()}.";
        }
		if ($this->alterar_senha == '1') {
			$msg .= ' Por favor, altere sua senha.';
		}
		return $msg;
    }

	protected $fillable = [
		'usr_codigo',
		'usr_login',
		'usr_senha',
		'usr_administrador',
		'usr_nome',
		'usr_email'
	];

	public function usuarios()
	{
		return $this->hasMany(\App\Models\Usuario::class);
	}
	
}
