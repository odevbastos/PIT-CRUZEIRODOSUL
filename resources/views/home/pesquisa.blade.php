@extends('template') 
@section('tituloPagina')
Pesquisa de clientes
@endsection @section('conteudo')
<style>
.uper {
	margin-top: 40px;
}
</style>
<div class="card uper">
  <div class="card-header">
	<form method="post" action="/executarPesquisaCliente" >		
	@csrf
      <div class="form-group">
		<input 
			type="text" 
			id="texto_pesquisa" 
			placeholder="Digite algo para pesquisar..."
			class="form-control"
			autofocus
			required
			name ="texto_pesquisa">
		</div>
        		
		<button type="submit" class="btn btn-success"><img src="/img/search.png" alt="Pesquisar">Pesquisar</button>
		<a  class="btn btn-danger"  href="/principal"><img src="/img/cancel.png" alt="Voltar">Voltar</a>
		
	</form>
  </div>
  <div class="card-body">
	@if(isset($listaClientes))
		@foreach($listaClientes as $t)
		  <div class="card">
			<div class="card-header"><h4>
			@if (session()->get('usuario_logado')->usr_administrador == "S")
				<a href="/edit/{{$t->codigo_cliente}}" class="btn btn-info"><img src="/img/edit.png" alt="Acessar"></a></td>
			@endif
				<a href="{{ route('show', $t->codigo_cliente)}}" class="btn btn-warning"><img src="/img/eye.png" alt="Detalhes"></a>
			{{$t->codigo_cliente}} - {{$t->razao_social}} ({{$t->nome_fantasia}})</h4>
			</div>			
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
					<tr><th><strong>Empresa</strong></th><td width="90%">{{$t->razao_social}} ({{$t->nome_fantasia}})</td></tr>
					<tr><th><strong>CNPJ/CPF</strong></th><td>{{$t->cgc_cpf}}</td></tr>
					<tr><th><strong>Revenda</strong></th><td>{{$t->revenda}}</td></tr>
					<tr><th><strong>Liberado</strong></th><td>{{$t->liberado}}</td></tr>
					</table>
				</div>
			</div>
		  </div>
		@endforeach			
	@endif
  <div>
</div>
@endsection
