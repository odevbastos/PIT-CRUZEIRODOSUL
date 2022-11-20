@extends('template')

@section('tituloPagina')
  Detalhes do cliente
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
      </div><br/>
    @endif
      <form method="post" action="/edit" >
          <div class="card-header"><h4>
            <a  class="btn btn-danger" style="text-align:left !important;" href="{{URL::previous()}}">
              <img src="/img/back.png" alt="Voltar">
            </a>

            <label for="descricao_tipo" style="text-align:left !important; color: black">
            {{$cliente->codigo}} - {{$cliente->razao_social}} ({{$cliente->nome_fantasia}})</label></h4>
          </div>

          <div class="form-group">
          @csrf
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
              @csrf
                <label for="descricao_tipo">Tipo:</label>
                <input type="text"
                  class="form-control"
                  name="descricao_tipo"
                  id="descricao_tipo"
                  value="{{$cliente->tipo}}"
                  disabled
                  data-plus-as-tab="true"/>
              </div>

              <div class="col-6">
              @csrf
                <label for="desc_liberado">Liberado:</label>
                <input type="text"
                  class="form-control"
                  name="desc_liberado"
                  id="desc_liberado"
                  value="{{$cliente->desc_liberado}}"
                  disabled
                  data-plus-as-tab="true"/>
              </div>
            </div>
          </div>

          <div class="form-group">
          @csrf
              <label for="cgc_cpf">CNPJ/CPF:</label>
              <input type="text"
              class="form-control"
              name="cgc_cpf"
              id="cgc_cpf"
              value="{{$cliente->cgc_cpf}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="razao_social">Razão social:</label>
              <input type="text"
              class="form-control"
              name="razao_social"
              id="razao_social"
              value="{{$cliente->razao_social}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="nome_fantasia">Nome fantasia:</label>
              <input type="text"
              class="form-control"
              name="nome_fantasia"
              id="nome_fantasia"
              value="{{$cliente->nome_fantasia}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="endereco">Endereço:</label>
              <input type="text"
              class="form-control"
              name="endereco"
              id="endereco"
              value="{{$cliente->endereco}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="numero">Numero:</label>
              <input type="number"
              class="form-control"
              name="numero"
              id="numero"
              value="{{$cliente->numero}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="bairro">Bairro:</label>
              <input type="text"
              class="form-control"
              name="bairro"
              id="bairro"
              value="{{$cliente->bairro}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="cep">CEP:</label>
              <input type="number"
              class="form-control"
              name="cep"
              id="cep"
              value="{{$cliente->cep}}"
              disabled
              data-plus-as-tab="true"/>
          </div>
          
          <div class="form-group">
          @csrf
              <label for="cidade">Cidade:</label>
              <input type="text"
              class="form-control"
              name="cidade"
              id="cidade"
              value="{{$cliente->nome_cidade}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
            <div class="row">
                <div class="col-6">
                  @csrf
                  <label for="telefone">Telefone(1):</label>
                  <input type="text"
                  class="form-control"
                  name="telefone"
                  id="telefone"
                  value="{{$cliente->telefone}}"
                  disabled
                  data-plus-as-tab="true"/>
                </div>

                <div class="col-6">
                  @csrf
                  <label for="fax">Telefone(2):</label>
                  <input type="text"
                  class="form-control"
                  name="fax"
                  id="fax"
                  value="{{$cliente->fax}}"
                  disabled
                  data-plus-as-tab="true"/>
                </div>
            </div>
          </div>

          <div class="form-group">
          @csrf
              <label for="email">E-mail:</label>
              <input type="email"
              class="form-control"
              name="email"
              id="email"
              value="{{$cliente->email}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="inscricao_estadual">Inscrição Estadual:</label>
              <input type="text"
              class="form-control"
              name="inscricao_estadual"
              id="inscricao_estadual"
              value="{{$cliente->inscricao_estadual}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="inscricao_municipal">Inscrição Municipal:</label>
              <input type="text"
              class="form-control"
              name="inscricao_municipal"
              id="inscricao_municipal"
              value="{{$cliente->inscricao_municipal}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="observacao">Observação:</label>
              <input type="text"
              class="form-control"
              name="observacao"
              id="observacao"
              value="{{$cliente->observacao}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
            <label for="codigo_revenda">Revenda:</label>
            <input type="text"
              class="form-control"
              name="codigo_revenda"
              id="codigo_revenda"
              value="{{$cliente->nome_revenda}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
            <label for="tipo_contrato">Tipo de contrato:</label>
            <input type="text"
              class="form-control"
              name="codigo_revenda"
              id="codigo_revenda"
              value="{{$cliente->desc_tipo_contrato}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
            <label for="cobranca">Responsável pela Cobrança:</label>
            <input type="text"
              class="form-control"
              name="cobranca"
              id="cobranca"
              value="{{$cliente->cobranca}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="valor_cobrado_nfe">Valor cobrado da NF-e:</label>
              <input type="number"
              class="form-control"
              name="valor_cobrado_nfe"
              id="valor_cobrado_nfe"
              value="{{$cliente->valor_cobrado_nfe}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="valor_automacao_vendas">Valor por automação de vendas:</label>
              <input type="number"
              class="form-control"
              name="valor_automacao_vendas"
              id="valor_automacao_vendas"
              value="{{$cliente->valor_automacao_vendas}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="quantidade_vendedores">Quantidade de vendedores:</label>
              <input type="number"
              class="form-control"
              name="quantidade_vendedores"
              id="quantidade_vendedores"
              value="{{$cliente->quantidade_vendedores}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="quantidade_bases">Quantidade de bases:</label>
              <input type="number"
              class="form-control"
              name="quantidade_bases"
              id="quantidade_bases"
              value="{{$cliente->quantidade_bases}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="quantidade_licencas">Quantidade de licenças:</label>
              <input type="number"
              class="form-control"
              name="quantidade_licencas"
              id="quantidade_licencas"
              value="{{$cliente->quantidade_licencas}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="valor_contrato">Valor do contrato:</label>
              <input type="number"
              class="form-control"
              name="valor_contrato"
              id="valor_contrato"
              value="{{$cliente->valor_contrato}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="valor_licenca_master">Valor da licença master:</label>
              <input type="number"
              class="form-control"
              name="valor_licenca_master"
              id="valor_licenca_master"
              value="{{$cliente->valor_licenca_master}}"
              disabled
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
          @csrf
              <label for="valor_licenca_senior">Valor da licença senior:</label>
              <input type="number"
              class="form-control"
              name="valor_licenca_senior"
              id="valor_licenca_senior"
              value="{{$cliente->valor_licenca_senior}}"
              disabled
              data-plus-as-tab="true"/>
          </div>      

          <div class="form-group">
          @csrf
              <label for="data_contrato">Data de cadastro:</label>
              <input type="date"
              class="form-control"
              name="data_contrato"
              id="data_contrato"
              value="{{$cliente->data_contrato}}"
              disabled
              data-plus-as-tab="true">
          </div>

          <div class="form-group">
          @csrf
              <label for="data_alteracao">Data de alteração:</label>
              <input type="date"
              class="form-control"
              name="data_alteracao"
              id="data_alteracao"
              value="{{$cliente->data_alteracao}}"
              disabled
              data-plus-as-tab="true">
          </div>

          <div class="form-group">
          @csrf
              <label for="data_contrato">Data de contrato:</label>
              <input type="date"
              class="form-control"
              name="data_contrato"
              id="data_contrato"
              value="{{$cliente->data_contrato}}"
              disabled
              data-plus-as-tab="true">
          </div>

          
      </form>
  </div>
</div>
@endsection