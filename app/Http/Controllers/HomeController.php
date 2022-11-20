<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Revenda;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }else {
            return view('home.login');
        }
    }

    public function login(Request $request) 
    {
        // valida dados recebidos do formulário
        $request->validate([
            'usuario' => 'required',
            'senha'   => 'required',
        ]);

        $usuario_autenticado = false;
        
        // Recupera os dados do usuário
        $resultado = DB::select("
                                SELECT 
                                u.usr_codigo, 
                                u.usr_login, 
                                u.usr_senha, 
                                u.usr_administrador, 
                                u.usr_nome, 
                                u.usr_email,
                                r.codigo as codigo_revenda
                            FROM 
                                fr_usuario u
                                INNER JOIN revenda r ON u.usr_codigo = r.codigo_usuario
                            WHERE 
                                u.usr_login = '{$request->usuario}' AND 
                                u.usr_senha = md5(u.usr_codigo || '{$request->senha}')                        
        ");
        
        if ($resultado != null){
            $usuario_logado = $resultado[0];
            $usuario_autenticado = true;
            session()->put('usuario_logado', $usuario_logado);
            session(['usuario_autenticado' => $usuario_autenticado]);
        }
        
        if ($usuario_autenticado) {
            return redirect()->route('principal');
        }else{
            return redirect()->back()->with('msg', 'Acesso negado!');
		}
    }

    public function principal()
    {
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $sqlRecuperaClientes = " 
                            SELECT 
                                c.codigo, 
                                c.razao_social, 
                                c.nome_fantasia, 
                                (CASE length(c.cgc_cpf) 
                                    WHEN 11 
                                    THEN substring(c.cgc_cpf from 1 for 3) || '.' || 
                                        substring(c.cgc_cpf from 4 for 3) || '.' || 
                                        substring(c.cgc_cpf from 7 for 3) || '-' || 
                                        substring(c.cgc_cpf from 10 for 2)
                                    WHEN 14 THEN substring(c.cgc_cpf from 1 for 2) || '.' || substring(c.cgc_cpf from 3 for 3) || '.' || substring(c.cgc_cpf from 6 for 3) || '/' || substring(c.cgc_cpf from 9 for 4) || '-' || substring(c.cgc_cpf from 13 for 2)
                                    ELSE ''
                                END) as cgc_cpf,  
                                c.liberado,
                                (CASE c.liberado
                                        WHEN -1 THEN 'Sim'
                                        WHEN 0 THEN 'Não'
                                    END) as desc_liberado 
                            FROM
                                cliente c
                                INNER JOIN revenda r ON c.codigo_revenda = r.codigo
                                INNER JOIN cidade ci ON c.codigo_cidade = ci.codigo ";
        
        if (session()->get('usuario_logado')->usr_administrador == "N"){
            $codigo_revenda = session()->get('usuario_logado')->codigo_revenda;
            $sqlRecuperaClientes = $sqlRecuperaClientes." WHERE c.codigo_revenda= {$codigo_revenda}";
        }

        $sqlRecuperaClientes = $sqlRecuperaClientes." ORDER BY c.codigo DESC ";

        $cliente = DB::select($sqlRecuperaClientes);
        return view('home.principal', compact('cliente'));
    }

    public function create()
    {
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $listaRevendas = DB::select("
                                    SELECT 
                                        codigo,
                                        razao_social,
                                        nome_fantasia, 
                                        codigo_usuario,
                                        senha_admin 
                                    FROM 
                                        revenda 
                                    ORDER BY razao_social");

        $listaCidades = DB::select("
                                    SELECT 
                                        codigo, 
                                        nome, 
                                        codigo_estado, 
                                        codigo_ibge 
                                    FROM 
                                        cidade 
                                    ORDER BY nome ");

        return view('home.create', [
            'listaRevendas' => $listaRevendas, 
            'listaCidades' => $listaCidades
            ]);
    }

    public function store(Request $request)
    {        
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $cnpj = preg_replace('/[^0-9]+/', '', $request->get('cgc_cpf'));

        $request->validate([
            'razao_social' => 'required',
            'endereco' =>  'required',
            'numero' => 'required',
            'bairro' =>  'required',
            'cep' =>  'required',
            'codigo_cidade' =>  'required',
            'telefone' =>  'required',
            'email' =>  'required',
            'cgc_cpf' =>  'required',
            'data_contrato' =>  'required',
            'tipo_contrato' =>  'required',
            'valor_contrato' =>  'required',
            'quantidade_bases' =>  'required',
            'quantidade_licencas' =>  'required',
            'observacao' => 'max:254'
        ]);

        $cliente = new Cliente([
            'tipo' => "J", //$request->get('tipo'),
            'liberado' => $request->get('liberado'),
            'razao_social' => $request->get('razao_social'),
            'nome_fantasia' => $request->get('nome_fantasia'),
            'endereco' => $request->get('endereco'),
            'numero' => (preg_replace('/[^0-9]+/', '', $request->get('numero')) == null) ? 0 : preg_replace('/[^0-9]+/', '', $request->get('numero')),
            'bairro' => $request->get('bairro'),
            'cep' => preg_replace('/[^0-9]+/', '', $request->get('cep')),
            'codigo_cidade' => $request->get('codigo_cidade'),
            'telefone' => preg_replace('/[^0-9]+/', '', $request->get('telefone')),
            'fax' => preg_replace('/[^0-9]+/', '', $request->get('fax')),
            'email' => $request->get('email'),
            'cgc_cpf' => preg_replace('/[^0-9]+/', '', $request->get('cgc_cpf')), 
            'inscricao_estadual' => $request->get('inscricao_estadual'),
            'inscricao_municipal' => $request->get('inscricao_municipal'),
            'observacao' => $request->get('observacao'),
            'data_contrato' => $request->get('data_contrato'),
            'tipo_contrato' => $request->get('tipo_contrato'),
            'valor_contrato' => str_replace(",", ".", str_replace(".", "", $request->get('valor_contrato'))),
            'valor_licenca_master' => ($request->get('valor_licenca_master') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_licenca_master'))) ,
            'valor_licenca_senior' => ($request->get('valor_licenca_senior') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_licenca_senior'))),
            'valor_cobrado_nfe' => ($request->get('valor_cobrado_nfe') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_cobrado_nfe'))),
            'valor_automacao_vendas' => ($request->get('valor_automacao_vendas') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_automacao_vendas'))),
            'quantidade_vendedores' => ($request->get('quantidade_vendedores') == null) ? 0 : $request->get('quantidade_vendedores'),
            'quantidade_bases' => $request->get('quantidade_bases'),
            'quantidade_licencas' => $request->get('quantidade_licencas'),
        ]);

        if (session()->get('usuario_logado')->usr_administrador == "S"){
            $revenda = DB::select("SELECT codigo_usuario FROM revenda WHERE codigo= {$request->get('codigo_revenda')}");

            $cliente['codigo_revenda'] = $request->get('codigo_revenda');
            $cliente['codigo_usuario'] = $revenda[0]->codigo_usuario;
        }else{
            $cliente['codigo_revenda'] = session()->get('usuario_logado')->codigo_revenda;
            $cliente['codigo_usuario'] = session()->get('usuario_logado')->usr_codigo;
        }
                
        $consulta_cliente = DB::select("SELECT codigo, razao_social from cliente WHERE cgc_cpf = '{$cnpj}'");

        if ($consulta_cliente == null) {
            $cliente->save();
            return redirect('/principal')->with('Sucesso', 'Registro incluido!');
        } else {
            return redirect()->back()->with('msg', 'Cliente já cadastrado. Entre em contato com a Brasil Software!');
        }
    }

    public function show($codigo)
    {
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $dados = DB::select(" 
                            SELECT 
                                c.codigo, 
                                (CASE c.tipo 
                                    WHEN 'J' THEN 'JURÍDICO' 
                                    WHEN 'F' THEN 'FÍSICO' 
                                END) as tipo,
                                c.razao_social, 
                                c.nome_fantasia, 
                                c.endereco, 
                                c.numero, 
                                c.bairro, 
                                c.cep, 
                                c.codigo_cidade, 
                                c.telefone, 
                                c.fax, 
                                c.email, 
                                (CASE length(c.cgc_cpf) 
                                    WHEN 11 
                                    THEN substring(c.cgc_cpf from 1 for 3) || '.' || 
                                        substring(c.cgc_cpf from 4 for 3) || '.' || 
                                        substring(c.cgc_cpf from 7 for 3) || '-' || 
                                        substring(c.cgc_cpf from 10 for 2)
                                    WHEN 14 THEN substring(c.cgc_cpf from 1 for 2) || '.' || substring(c.cgc_cpf from 3 for 3) || '.' || substring(c.cgc_cpf from 6 for 3) || '/' || substring(c.cgc_cpf from 9 for 4) || '-' || substring(c.cgc_cpf from 13 for 2)
                                    ELSE ''
                                END) as cgc_cpf,
                                c.inscricao_estadual, 
                                c.inscricao_municipal, 
                                c.observacao, 
                                c.codigo_revenda, 
                                c.codigo_usuario, 
                                c.liberado, 
                                (CASE c.liberado
                                        WHEN -1 THEN 'Sim'
                                        WHEN 0 THEN 'Não'
                                    END) as desc_liberado,
                                c.data_cadastro::date,
                                c.data_contrato, 
                                c.tipo_contrato, 
                                c.valor_contrato, 
                                c.data_alteracao::date, 
                                c.valor_licenca_master, 
                                c.valor_licenca_senior, 
                                (CASE c.cobranca 
                                    WHEN 'B' THEN 'BRASIL SOFTWARE' 
                                    WHEN 'R' THEN 'REVENDA' 
                                END) as cobranca, 
                                c.valor_cobrado_nfe, 
                                c.valor_automacao_vendas, 
                                c.quantidade_vendedores, 
                                c.quantidade_bases, 
                                c.quantidade_licencas, 
                                c.cliente_novo, 
                                (CASE c.tipo_contrato 
                                    WHEN 0 THEN ''
                                    WHEN '1' THEN 'Lincença de uso por terminal'
                                    WHEN '2' THEN 'Repasse de percentual 30%'
                                    WHEN '3' THEN 'Repasse de percentual 40%'
                                    WHEN '4' THEN 'Repasse de percentual 50%'
                                    WHEN '5' THEN 'Repasse de percentual 100%'
                                END) as desc_tipo_contrato,
                                r.nome_fantasia as nome_revenda,
                                ci.nome as nome_cidade  
                            FROM
                                cliente c
                                INNER JOIN revenda r ON c.codigo_revenda = r.codigo
                                INNER JOIN cidade ci ON c.codigo_cidade = ci.codigo
                            WHERE
                                c.codigo= {$codigo}");

        return view('home.display', ['cliente' => $dados[0]]);
    }

    public function edit($codigo)
    {
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $dados = DB::select(" 
                            SELECT 
                                c.codigo, 
                                (CASE c.tipo 
                                    WHEN 'J' THEN 'JURÍDICO' 
                                    WHEN 'F' THEN 'FÍSICO' 
                                END) as tipo,
                                c.razao_social, 
                                c.nome_fantasia, 
                                c.endereco, 
                                c.numero, 
                                c.bairro, 
                                c.cep, 
                                c.codigo_cidade, 
                                c.telefone, 
                                c.fax, 
                                c.email, 
                                (CASE length(c.cgc_cpf) 
                                    WHEN 11 
                                    THEN substring(c.cgc_cpf from 1 for 3) || '.' || 
                                        substring(c.cgc_cpf from 4 for 3) || '.' || 
                                        substring(c.cgc_cpf from 7 for 3) || '-' || 
                                        substring(c.cgc_cpf from 10 for 2)
                                    WHEN 14 
                                    THEN substring(c.cgc_cpf from 1 for 2) || '.' || 
                                        substring(c.cgc_cpf from 3 for 3) || '.' || 
                                        substring(c.cgc_cpf from 6 for 3) || '/' || 
                                        substring(c.cgc_cpf from 9 for 4) || '-' || 
                                        substring(c.cgc_cpf from 13 for 2)
                                    ELSE ''
                                END) as cgc_cpf,
                                c.inscricao_estadual, 
                                c.inscricao_municipal, 
                                c.observacao, 
                                c.codigo_revenda, 
                                c.codigo_usuario, 
                                c.liberado, 
                                (CASE c.liberado
                                        WHEN -1 THEN 'Sim'
                                        WHEN 0 THEN 'Não'
                                    END) as desc_liberado,
                                c.data_cadastro::date,
                                c.data_contrato, 
                                c.tipo_contrato, 
                                c.valor_contrato, 
                                c.data_alteracao::date, 
                                c.valor_licenca_master, 
                                c.valor_licenca_senior, 
                                (CASE c.cobranca 
                                    WHEN 'B' THEN 'BRASIL SOFTWARE' 
                                    WHEN 'R' THEN 'REVENDA' 
                                END) as cobranca, 
                                c.valor_cobrado_nfe, 
                                c.valor_automacao_vendas, 
                                c.quantidade_vendedores, 
                                c.quantidade_bases, 
                                c.quantidade_licencas, 
                                c.cliente_novo, 
                                (CASE c.tipo_contrato 
                                    WHEN 0 THEN ''
                                    WHEN '1' THEN 'Lincença de uso por terminal'
                                    WHEN '2' THEN 'Repasse de percentual 30%'
                                    WHEN '3' THEN 'Repasse de percentual 40%'
                                    WHEN '4' THEN 'Repasse de percentual 50%'
                                    WHEN '5' THEN 'Repasse de percentual 100%'
                                END) as desc_tipo_contrato,
                                r.nome_fantasia as nome_revenda,
                                ci.nome as nome_cidade  
                            FROM
                                cliente c
                                INNER JOIN revenda r ON c.codigo_revenda = r.codigo
                                INNER JOIN cidade ci ON c.codigo_cidade = ci.codigo
                            WHERE
                                c.codigo= {$codigo}");

        $listaRevendas = DB::select("
                                    SELECT 
                                        codigo,
                                        razao_social,
                                        nome_fantasia, 
                                        codigo_usuario,
                                        senha_admin 
                                    FROM 
                                        revenda 
                                    ORDER BY razao_social");

        $listaCidades = DB::select("
                                    SELECT 
                                        codigo, 
                                        nome, 
                                        codigo_estado, 
                                        codigo_ibge 
                                    FROM 
                                        cidade 
                                    ORDER BY nome ");
        
        return view('home.edit', [
            'cliente' => $dados[0],
            'listaRevendas' => $listaRevendas,
            'listaCidades' => $listaCidades
            ]);
    }

    public function update(Request $request, $codigo)
    {
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

        $request->validate([
            'razao_social' =>  'required',
            'nome_fantasia' =>  'required',
            'endereco' =>  'required',
            'numero' =>  'required',
            'bairro' =>  'required',
            'cep' =>  'required',
            'codigo_cidade' =>  'required',
            'telefone' =>  'required',
            'email' =>  'required',
            'cgc_cpf' =>  'required',
            'codigo_revenda' =>  'required',
            'data_contrato' =>  'required',
            'tipo_contrato' =>  'required',
            'valor_cobrado_nfe' =>  'required',
            'valor_automacao_vendas' =>  'required',
            'quantidade_vendedores' =>  'required',
            'valor_contrato' =>  'required',
            'valor_licenca_master' =>  'required',
            'valor_licenca_senior' =>  'required',
            'quantidade_bases' =>  'required',
            'quantidade_licencas' =>  'required',
        ]);

        $cliente = Cliente::find($codigo);
        $cliente->tipo                      = "J"; //$request->get('tipo');
        $cliente->liberado                  = $request->get('liberado');
        $cliente->razao_social              = $request->get('razao_social');
        $cliente->nome_fantasia             = $request->get('nome_fantasia');
        $cliente->endereco                  = $request->get('endereco');
        $cliente->numero                    = (preg_replace('/[^0-9]+/', '', $request->get('numero')) == null) ? 0 : preg_replace('/[^0-9]+/', '', $request->get('numero'));
        $cliente->bairro                    = $request->get('bairro');
        $cliente->cep                       = preg_replace('/[^0-9]+/', '', $request->get('cep'));
        $cliente->codigo_cidade             = $request->get('codigo_cidade');
        $cliente->telefone                  = preg_replace('/[^0-9]+/', '', $request->get('telefone'));
        $cliente->fax                       = preg_replace('/[^0-9]+/', '', $request->get('fax'));
        $cliente->email                     = $request->get('email');
        $cliente->cgc_cpf                   = preg_replace('/[^0-9]+/', '', $request->get('cgc_cpf'));
        $cliente->inscricao_estadual        = $request->get('inscricao_estadual');
        $cliente->inscricao_municipal       = $request->get('inscricao_municipal');
        $cliente->observacao                = $request->get('observacao');
        $cliente->codigo_revenda            = $request->get('codigo_revenda');
        $cliente->data_contrato             = $request->get('data_contrato');
        $cliente->data_alteracao            = date('Y-m-d');
        $cliente->tipo_contrato             = $request->get('tipo_contrato');
        $cliente->valor_contrato            = str_replace(",", ".", str_replace(".", "", $request->get('valor_contrato')));
        $cliente->valor_licenca_master      = ($request->get('valor_licenca_master') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_licenca_master')));
        $cliente->valor_licenca_senior      = ($request->get('valor_licenca_senior') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_licenca_senior')));
        $cliente->valor_cobrado_nfe         = ($request->get('valor_cobrado_nfe') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_cobrado_nfe')));
        $cliente->valor_automacao_vendas    = ($request->get('valor_automacao_vendas') == null) ? 0 : str_replace(",", ".", str_replace(".", "", $request->get('valor_automacao_vendas')));
        $cliente->quantidade_vendedores     = $request->get('quantidade_vendedores');
        $cliente->quantidade_bases          = $request->get('quantidade_bases');
        $cliente->quantidade_licencas       = $request->get('quantidade_licencas');
        $cliente->save();
        
        return redirect('/principal')->with('Sucesso', 'Registro Alterado!');
    }
        
    public function pesquisarCliente() 
	{
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }

		return view('home.pesquisa');
    }
    
	public function executarPesquisaCliente(Request $request)
	{
        if (!session()->get('usuario_autenticado')) {
            return redirect()->route('login');
        }
        
        $texto 			= $request->get('texto_pesquisa');

        $sql = "
            SELECT 
                c.codigo as codigo_cliente,
                c.razao_social, 
                c.nome_fantasia, 
                (CASE length(c.cgc_cpf) 
                    WHEN 11 
                    THEN substring(c.cgc_cpf from 1 for 3) || '.' || 
                         substring(c.cgc_cpf from 4 for 3) || '.' || 
                         substring(c.cgc_cpf from 7 for 3) || '-' || 
                         substring(c.cgc_cpf from 10 for 2)
                    WHEN 14 THEN substring(c.cgc_cpf from 1 for 2) || '.' || substring(c.cgc_cpf from 3 for 3) || '.' || substring(c.cgc_cpf from 6 for 3) || '/' || substring(c.cgc_cpf from 9 for 4) || '-' || substring(c.cgc_cpf from 13 for 2)
                    ELSE ''
                END) as cgc_cpf,  
                (CASE c.liberado
                WHEN -1 THEN 'Sim' 
                WHEN 0 THEN 'Não'
                END) as liberado,
                r.razao_social as revenda 
            FROM
                cliente c
                INNER JOIN revenda r ON c.codigo_revenda = r.codigo
                INNER JOIN cidade ci ON c.codigo_cidade = ci.codigo
            WHERE ";
            
        if (session()->get('usuario_logado')->usr_administrador == "N"){
            $codigo_revenda = session()->get('usuario_logado')->codigo_revenda;
            $sql .= " c.codigo_revenda= {$codigo_revenda} and ";
        }
				
		if(intval($texto) != 0){
			$sql .= " (
                    c.codigo = {$texto} or
                    c.cgc_cpf ilike '%{$texto}%' or 
					r.cgc_cpf ilike '%{$texto}%' 
                    )";
		}else{
			$sql .= "
						(
							c.razao_social ilike '%{$texto}%' or
							r.razao_social ilike '%{$texto}%' or
							c.nome_fantasia ilike '%{$texto}%' or
							r.nome_fantasia ilike '%{$texto}%' or
							c.cgc_cpf ilike '%{$texto}%' or 
							r.cgc_cpf ilike '%{$texto}%' 
						)
						";
		}
        
        $listaClientes = DB::select($sql);
		$dados['listaClientes']    = $listaClientes;
		return view('home.pesquisa')->with($dados);
    }

    public function ConsultaCidade($nome)
    {
        $resposta = DB::select("SELECT codigo, nome from cidade WHERE retira_acentos(nome) ilike '{$nome}'");

        return json_encode($resposta[0]);
    }

    public function ConsultaClienteExistente($cnpj)
    {
        $resposta = DB::select("SELECT codigo, razao_social from cliente WHERE cgc_cpf = '{$cnpj}'");

        return json_encode($resposta[0]);
    }
}
