<?php 

namespace App\Models;

use Eloquent;

/**
 * Class Cliente
 * 
 * @property int $codigo
 * @property string $tipo
 * @property string $razao_social
 * @property string $nome_fantasia
 * @property string $endereco
 * @property int $numero
 * @property string $bairro
 * @property string $cep
 * @property int $codigo_cidade
 * @property string $telefone
 * @property string $fax
 * @property string $email
 * @property string $cgc_cpf
 * @property string $inscricao_estadual
 * @property string $inscricao_municipal
 * @property string $observacao
 * @property int $codigo_revenda
 * @property int $codigo_usuario
 * @property boolean $liberado
 * @property string $data_cadastro
 * @property string $data_contrato
 * @property int $tipo_contrato
 * @property float $valor_contrato
 * @property string $data_alteracao
 * @property float $valor_licenca_master
 * @property float $valor_licenca_senior
 * @property string $cobranca
 * @property float $valor_cobrado_nfe
 * @property float $valor_automacao_vendas
 * @property int $quantidade_vendedores
 * @property int $quantidade_bases
 * @property int $quantidade_licencas
 * @property int $cliente_novo
 *
 * @package App\Models
 */

class Cliente extends Eloquent
{
    protected $table = 'cliente';
    protected $primaryKey = 'codigo';
    public $timestamps = false;

    protected $casts = [
        'codigo' => 'int',
        'numero' => 'int',
        'codigo_cidade' => 'int',
        'codigo_revenda' => 'int',
        'codigo_usuario' => 'int',
        'liberado' => 'boolean',
        'tipo_contrato' => 'int',
        'quantidade_vendedores' => 'int',
        'quantidade_bases' => 'int',
        'quantidade_licencas' => 'int',
        'cliente_novo' => 'int'
    ];

    protected $fillable = [
        'codigo',
        'tipo',
        'razao_social',
        'nome_fantasia', 
        'endereco',
        'numero', 
        'bairro', 
        'cep',
        'codigo_cidade',
        'telefone',
        'fax', 
        'email', 
        'cgc_cpf',
        'inscricao_estadual', 
        'inscricao_municipal',
        'observacao',
        'codigo_revenda',
        'codigo_usuario',
        'liberado',
        'data_cadastro',
        'data_contrato',
        'tipo_contrato',
        'valor_contrato',
        'data_alteracao',
        'valor_licenca_master',
        'valor_licenca_senior',
        'cobranca',
        'valor_cobrado_nfe',
        'valor_automacao_vendas',
        'quantidade_vendedores',
        'quantidade_bases',
        'quantidade_licencas',
        'cliente_novo'
    ];

}

?>