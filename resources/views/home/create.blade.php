@extends('template')

@section('tituloPagina')
  Inclusão de Cliente
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
      <form method="post" action="{{ route('store') }}" >
      @csrf

          <div class="form-group">
            <div class="row">
              <div class="col-6">
                <label>Tipo: </label><br>
                <select id='tipo' name='tipo' class="form-control" required disabled>
                    <option value="J" label="Pessoa Jurídica"/>
                    <option value="F" label="Pessoa Física"/>
                </select>
              </div>
              <div class="col-6">
                <label for="liberado">Liberado:</label>
                <select id='liberado' name='liberado' 
                  class="form-control" required>
                    <option value="-1" label="SIM"/>
                    <option value="0" label="NÃO"/>
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
              onblur="pesquisaCNPJ(this);"
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
              autofocus
              maxlength="40"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="endereco">Endereço:</label>
              <input type="text"
              class="form-control"
              name="endereco"
              id="endereco"
              required
              autofocus
              maxlength="60"
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
              required
              autofocus
              maxlength="30"
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
                      class="form-control">
                      <option value="" label="Selecione a cidade..."/>
                      @foreach ($listaCidades as $p)
                        <option
                          value="{{$p->codigo}}"
                          label="{{$p->nome}}">{{$p->nome}}
                        </option>
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
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="fax">Telefone(2):</label>
              <input type="text"
              class="celular form-control"
              name="fax"
              id="fax"
              autofocus
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email"
              class="form-control"
              name="email"
              id="email"
              required
              autofocus
              maxlength="40"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="inscricao_estadual">Inscrição Estadual:</label>
              <input type="text"
              class="form-control"
              name="inscricao_estadual"
              id="inscricao_estadual"
              autofocus
              maxlength="20"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="inscricao_municipal">Inscrição Municipal:</label>
              <input type="text"
              class="form-control"
              name="inscricao_municipal"
              id="inscricao_municipal"
              autofocus
              maxlength="8"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="observacao">Observação:</label>
              <input type="text"
              class="form-control"
              name="observacao"
              id="observacao"
              autofocus
              maxlength="254"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group" 
          @if (session()->get('usuario_logado')->usr_administrador == "N")
          style="display: none !important;"
          @endif
          >
          <label for="codigo_revenda">Revenda:</label>
          <div class="form-group">
            <div class="row">
                <div class="col-2">
                  <input
                    id="codigo_revenda"
                    type="text"
                    @if (session()->get('usuario_logado')->usr_administrador == "S")
                      required
                    @else
                      disabled
                    @endif
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
                        name='desc_revenda' 
                        @if (session()->get('usuario_logado')->usr_administrador == "S")
                          required
                        @else
                          disabled
                        @endif
                        onchange="selecionaCombo(this, 2, 'codigo_revenda');"
                        class="form-control">
                        <option value="" label="Selecione a revenda..."/>
                        @foreach ($listaRevendas as $p)
                          <option
                            value="{{$p->codigo}}"
                            label="{{$p->razao_social}}">{{$p->razao_social}}
                          </option>
                        @endforeach
                    </select>
                  </div>
              </div>
          </div>
        </div>

          <div class="form-group">
            <label for="tipo_contrato">Tipo de contrato:</label>
              <select id='tipo_contrato' name='tipo_contrato' class="form-control" required autofocus>
                <option value="" label="Selecione o tipo de contrato..."/>
                <option value="1" label="Lincença de uso por terminal"/>
                <option value="2" label="Repasse de percentual 30%"/>
                <option value="3" label="Repasse de percentual 40%"/>
                <option value="4" label="Repasse de percentual 50%"/>
                <option value="5" label="Repasse de percentual 100%"/>
              </select>
          </div>

          <div class="form-group">
            <label for="cobranca">Responsável pela Cobrança:</label>
            <select id='cobranca' name='cobranca' class="form-control" disabled="true" required disabled>
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
              required
              autofocus
              maxLength="14"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="valor_automacao_vendas">Valor por automação de vendas:</label>
              <input type="text"
              class="dinheiro form-control"
              name="valor_automacao_vendas"
              id="valor_automacao_vendas"
              autofocus
              maxLength="14"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="quantidade_vendedores">Quantidade de vendedores:</label>
              <input type="text"
              class="numero form-control"
              name="quantidade_vendedores"
              id="quantidade_vendedores"
              autofocus
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="quantidade_bases">Quantidade de bases:</label>
              <input type="text"
              class="numero form-control"
              name="quantidade_bases"
              id="quantidade_bases"
              required
              autofocus
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="quantidade_licencas">Quantidade de licenças:</label>
              <input type="text"
              class="numero form-control"
              name="quantidade_licencas"
              id="quantidade_licencas"
              required
              autofocus
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="valor_contrato">Valor do contrato:</label>
              <input type="text"
              class="dinheiro form-control"
              name="valor_contrato"
              id="valor_contrato"
              required
              autofocus
              maxLength="14"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="valor_licenca_master">Valor da licença master:</label>
              <input type="text"
              class="dinheiro form-control"
              name="valor_licenca_master"
              id="valor_licenca_master"
              autofocus
              maxLength="14"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="valor_licenca_senior">Valor da licença senior:</label>
              <input type="text"
              class="dinheiro form-control"
              name="valor_licenca_senior"
              id="valor_licenca_senior"
              autofocus
              maxLength="14"
              data-plus-as-tab="true"/>
          </div>

          <div class="form-group">
              <label for="data_contrato">Data da assinatura do contrato:</label>
              <input type="date"
              class="form-control"
              required
              autofocus
              name="data_contrato"
              id="data_contrato"
              data-plus-as-tab="true">
          </div>

          <div class="card-footer" style="text-align:right !important;">
            <button type="submit" class="btn btn-success"><img src="/img/save.png" alt="Salvar"></button>
                  <a  class="btn btn-danger"  href="{{URL::previous()}}"><img src="/img/back.png" alt="Voltar"></a>
          </div>
      </form>
  </div>
</div>
@endsection
