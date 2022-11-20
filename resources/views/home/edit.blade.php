@extends('template')

@section('tituloPagina')
  Alteração de cidade
@endsection
@section('conteudo')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper bg-primary text-white">
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('clientes.update', $cliente->codigo) }}">
        @method('PATCH')
        @csrf
        
        <div class="form-group">
          <label for="codigo">Código:</label>
          <input type="text"
            class="form-control"
            name="codigo"
            id="codigo"
            value="{{$cliente->codigo}}"
            disabled
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label for="tipo">Tipo:</label>
                <select id='tipo' name='tipo' class="form-control" required disabled> 
                    <option 
                    @if($cliente->tipo == "J")
                      selected
                    @endif
                      value="J" label="Pessoa Jurídica"/>
                    <option 
                    @if($cliente->tipo == "F")
                      selected
                    @endif
                      value="F" label="Pessoa Física"/>
                </select>
              </div>

              <div class="col-6">
                <label for="liberado">Liberado:</label>
                  <select id='liberado' name='liberado' class="form-control" required> 
                    <option 
                    @if($cliente->liberado == -1)
                      selected
                    @endif
                      value="-1" label="SIM"/>
                    <option 
                    @if($cliente->liberado == 0)
                      selected
                    @endif
                      value="0" label="NÃO"/>
                </select>
              </div>
            </div>
          </div>
        
          <div class="form-group">
            <label for="cgc_cpf">CNPJ:</label>
            <input type="text"
              class="cnpj form-control"
              name="cgc_cpf"
              id="cgc_cpf"
              value="{{$cliente->cgc_cpf}}"
              required
              autofocus
              data-plus-as-tab="true"/>
          </div>

        <div class="form-group">
          <label for="razao_social">Razão social:</label>
          <input type="text"
            class="form-control"
            name="razao_social"
            id="razao_social"
            maxLength="50"
            value="{{$cliente->razao_social}}"
            required
            autofocus
            maxlength="50"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="nome_fantasia">Nome fantasia:</label>
          <input type="text"
            class="form-control"
            name="nome_fantasia"
            id="nome_fantasia"
            maxLength="40"
            autofocus
            value="{{$cliente->nome_fantasia}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="endereco">Endereço:</label>
          <input type="text"
            class="form-control"
            name="endereco"
            id="endereco"
            maxLength="60"
            required
            autofocus
            value="{{$cliente->endereco}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-4">
              <label for="numero">Numero:</label>
              <input type="text"
                class="numero form-control"
                name="numero"
                id="numero"
                value="{{$cliente->numero}}"
                required
                autofocus
                data-plus-as-tab="true"/>
            </div>

            <div class="col-8">
              <label for="cep">CEP:</label>
              <input type="text"
                class="cep form-control"
                name="cep"
                id="cep"
                required
                autofocus
                value="{{$cliente->cep}}"
                data-plus-as-tab="true"/>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="bairro">Bairro:</label>
          <input type="text"
            class="form-control"
            name="bairro"
            id="bairro"
            maxLength="30"
            required
            autofocus
            value="{{$cliente->bairro}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
        <label for="codigo_cidade">Cidade:</label>
          <div class="form-group">
            <div class="row">
              <div class="col-2">
                <input
                  id="codigo_cidade"
                  type="text" required
                  value="{{ $cliente->codigo_cidade }}"
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                  maxlength="5"
                  autofocus="true"
                  onfocus="this.select()"
                  onblur="selecionaCombo(this, 1, 'desc_cidade');"
                  name="codigo_cidade"
                  data-plus-as-tab="true"
                  class="form-control">
              </div>
              <div class="col-10">
                <select id='desc_cidade'
                      name='desc_cidade' required
                      onchange="selecionaCombo(this, 2, 'codigo_cidade');"
                      class="form-control"
                      >
                  <option value="" label="Selecione a cidade"/>
                  @foreach ($listaCidades as $cidade)
                  <option
                      @if($cliente->codigo_cidade == $cidade->codigo)
                        selected
                      @endif
                      value="{{$cidade->codigo}}"
                      label="{{$cidade->nome}}"/>
                  @endforeach
                </select>
                </div>
              </div>
          </div>
        </div>

        <div class="form-group">
          <label for="telefone">Telefone:</label>
          <input type="text"
            class="telefone form-control"
            name="telefone"
            id="telefone"
            required
            autofocus
            value="{{$cliente->telefone}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="fax">Telefone(2):</label>
          <input type="text"
            class="celular form-control"
            name="fax"
            id="fax"
            autofocus
            value="{{$cliente->fax}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="email">E-mail:</label>
          <input type="email"
            class="form-control"
            name="email"
            id="email"
            maxLength="40"
            required
            autofocus
            value="{{$cliente->email}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="inscricao_estadual">Inscrição Estadual:</label>
          <input type="text"
            class="form-control"
            name="inscricao_estadual"
            id="inscricao_estadual"
            maxLength="20"
            value="{{$cliente->inscricao_estadual}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="inscricao_municipal">Inscrição Municipal:</label>
          <input type="text"
            class="form-control"
            name="inscricao_municipal"
            maxLength="8"
            id="inscricao_municipal"
            value="{{$cliente->inscricao_municipal}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="observacao">Observação:</label>
          <input type="text"
            class="form-control"
            name="observacao"
            id="observacao"
            maxLength="254"
            value="{{$cliente->observacao}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="codigo_revenda">Revenda:</label>
          <div class="form-group">
            <div class="row">
              <div class="col-2">
                <input
                  id="codigo_revenda"
                  type="text" required
                  value="{{ $cliente->codigo_revenda }}"
                  onkeydown="someBotao()"
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                  maxlength="5"
                  autofocus="true"
                  onfocus="this.select()"
                  onblur="selecionaCombo(this, 1, 'desc_revenda');"
                  name="codigo_revenda"
                  data-plus-as-tab="true"
                  class="form-control">
              </div>
              <div class="col-10">
                <select id='desc_revenda'
                      name='desc_revenda' required
                      onchange="selecionaCombo(this, 2, 'codigo_revenda');"
                      class="form-control"
                      >
                  <option value="" label="Selecione a revenda"/>
                  @foreach ($listaRevendas as $revenda)
                  <option
                      @if($cliente->codigo_revenda == $revenda->codigo)
                        selected
                      @endif
                      value="{{$revenda->codigo}}"
                      label="{{$revenda->razao_social}}"/>
                  @endforeach
                </select>
                </div>
              </div>
          </div>
        </div>

        <div class="form-group">
          <label for="tipo_contrato">Tipo de contrato:</label>
                <select id='tipo_contrato'
                      name='tipo_contrato' required autofocus
                      class="form-control">
                  <option value="" label="Selecione o tipo de contrato..."/>
                  <option
                      @if($cliente->tipo_contrato == 1)
                        selected
                      @endif
                      value="1" label="Lincença de uso por terminal"/>
                  <option
                      @if($cliente->tipo_contrato == 2)
                        selected
                      @endif
                      value="2" label="Repasse de percentual 30%"/>
                  <option
                      @if($cliente->tipo_contrato == 3)
                        selected
                      @endif
                        value="3" label="Repasse de percentual 40%"/>
                  <option      
                      @if($cliente->tipo_contrato == 4)
                        selected 
                      @endif
                        value="4" label="Repasse de percentual 50%"/>
                  <option  
                      @if($cliente->tipo_contrato == 5)
                        selected
                      @endif
                        value="5" label="Repasse de percentual 100%"/>
                </select>
        </div>

        <div class="form-group">
          <label for="cobranca">Responsável pela Cobrança:</label>
          <select id='cobranca' 
                  name='cobranca' required autofocus
                  disabled
                  class="form-control">
              <option value="B" label="Brasil Software"/>
              <option value="R" label="Revenda"/>
            </select>
        </div>

        <div class="form-group">
          <label for="valor_cobrado_nfe">Valor cobrado da NF-e:</label>
          <input type="text"
            class="dinheiro form-control"
            name="valor_cobrado_nfe"
            id="valor_cobrado_nfe"
            value="{{$cliente->valor_cobrado_nfe}}"
            maxLength="14"
            required
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="valor_automacao_vendas">Valor por automação de vendas:</label>
          <input type="text"
            class="dinheiro form-control"
            name="valor_automacao_vendas"
            id="valor_automacao_vendas"
            value="{{$cliente->valor_automacao_vendas}}"
            maxLength="14"
            required
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="valor_automacao_vendas">Quantidade de vendedores:</label>
          <input type="text"
            class="numero form-control"
            name="quantidade_vendedores"
            id="quantidade_vendedores"
            value="{{$cliente->quantidade_vendedores}}"
            required
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="quantidade_bases">Quantidade de bases:</label>
          <input type="text"
            class="numero form-control"
            name="quantidade_bases"
            id="quantidade_bases"
            required
            value="{{$cliente->quantidade_bases}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
              <label for="quantidade_licencas">Quantidade de licenças:</label>
              <input type="text"
              class="numero form-control"
              name="quantidade_licencas"
              id="quantidade_licencas"
              required
              value="{{$cliente->quantidade_licencas}}"
              data-plus-as-tab="true"/>
          </div>

        <div class="form-group">
          <label for="valor_contrato">Valor do contrato:</label>
          <input type="text"
            class="dinheiro form-control"
            name="valor_contrato"
            id="valor_contrato"
            value="{{$cliente->valor_contrato}}"
            maxLength="14"
            required
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="valor_licenca_master">Valor da licença master:</label>
          <input type="text"
            class="dinheiro form-control"
            name="valor_licenca_master"
            id="valor_licenca_master"
            maxLength="14"
            value="{{$cliente->valor_licenca_master}}"
            data-plus-as-tab="true"/>
        </div>
        
        <div class="form-group">
          <label for="valor_licenca_senior">Valor da licença senior:</label>
          <input type="text"
            class="dinheiro form-control"
            name="valor_licenca_senior"
            id="valor_licenca_senior"
            maxLength="14"
            value="{{$cliente->valor_licenca_senior}}"
            data-plus-as-tab="true"/>
        </div>

        <div class="form-group">
          <label for="data_cadastro">Data de cadastro:</label>
          <input type="date"
            class="form-control"
            value="{{$cliente->data_cadastro}}"
            disabled
            name="data_cadastro"
            id="data_cadastro"
            data-plus-as-tab="true">
        </div>

        <div class="form-group">
          <label for="data_alteracao">Data de alteração:</label>
          <input type="date"
            class="form-control"
            value="{{$cliente->data_alteracao}}"
            disabled
            name="data_alteracao"
            id="data_alteracao"
            data-plus-as-tab="true">
        </div>

        <div class="form-group">
          <label for="data_contrato">Data da assinatura do contrato:</label>
          <input type="date"
            class="form-control"
            value="{{$cliente->data_contrato}}"
            required
            name="data_contrato"
            id="data_contrato"
            data-plus-as-tab="true">
        </div>

        <div style="text-align:right !important;">
        <button type="submit" class="btn btn-success"><img src="/img/save.png" alt="Salvar">
        </button>
          <a  class="btn btn-danger"  href="{{URL::previous()}}"><img src="/img/back.png" alt="Voltar"></a>
        </div>
      </form>
  </div>
</div>
@endsection
