@extends('template')
@section('tituloPagina')
  Principal
@endsection
@section('conteudo')
<div id="dashboard">
	<div class="row">
		<div class="card uper bg-default text-white" style="width: -webkit-fill-available;">
			<div class="card-header">
				<div align="right">
					<a class="btn btn-success" href="{{ route('create') }}" ><img src="/img/add.png" alt="Incluir"></a>
					<a class="btn btn-info" href="/pesquisarCliente"><img src="/img/search.png"></a>
				</div>
			</div>
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
				<div class="table-responsive">
				<table class="table table-striped">
				<thead>
					<tr>
						<th bgcolor="white">Código</th>
						<th bgcolor="white">CNPJ</th>
						<th bgcolor="white">Liberado</th>
						<th bgcolor="white">Razão Social</th>
						<th bgcolor="white">Nome Fantasia</th>
						<th bgcolor="white" colspan="2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($cliente as $cliente)
					<tr>
						<td bgcolor="white">{{$cliente->codigo}} </td>
						<td bgcolor="white" width="14%">{{$cliente->cgc_cpf}} </td>
						<td bgcolor="white">{{$cliente->desc_liberado}} </td>
						<td bgcolor="white" width="46%">{{$cliente->razao_social}}</td>
						<td bgcolor="white" width="40%">{{$cliente->nome_fantasia}}</td>
						@if (session()->get('usuario_logado')->usr_administrador == "S")
							<td bgcolor="white"><a href="{{ route('edit', $cliente->codigo)}}" class="btn btn-info"><img src="/img/edit.png" alt="Alterar"></a></td>
						@endif
						<td bgcolor="white"><a href="{{ route('show', $cliente->codigo)}}" class="btn btn-warning"><img src="/img/eye.png" alt="Detalhes"></a></td>
					</tr>
					@endforeach
				</tbody>
				</table>
				</div>
			<div>
		</div>
    </div>
</div><!-- Dashboard -->
     
@endsection