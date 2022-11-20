<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
	use Notifiable;

	public $table='fr_usuario';
	public $timestamps = false;

    public function getAuthPassword() {
        return $this->usr_senha;
    }

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usr_nome', 'usr_email', 'usr_senha',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
