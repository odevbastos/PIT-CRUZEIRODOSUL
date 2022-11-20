<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simples Os</title>

  <link rel="shortcut icon" href="/img/logobrasilsoftware.png" type="image/x-icon" />

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.min.css" rel="stylesheet">

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

  <style type="text/css">
.login-box
{
	height: 50%;
	width: 60%;
	border: 1px solid grey;
	margin-top: 10%;
	margin-left: auto;
	margin-right: auto;
	position: center;
	box-shadow: 21px 12px 24px 10px rgba(0, 0, 0, .5);
	background: #dadada;
}
.login-header
{
	text-align: center;
	font-family: "Georgia, serif"
	font-size: 35px;
	background: linear-gradient(to bottom, #00bfff 0%, #0000ff 100%);
	color:#fff;
	position: relative;
	box-shadow: 1px 3px 14px  rgba(0, 0, 0, .5);
}
.login-body
{
	padding: 20px;
	line-height: 2;
    font-family: "Georgia, serif"
	font-size: 35px;
}
.form-control
{
    font-family: "Georgia, serif"
	font-size: 35px;
}
</style>
</head>

<body>

  <div class="container">
	<div class="login-box" >
		<div class="login-header" style="text-align:left;"><img src="/img/logobrasilsoftware.png"> Login - Simples Ordem de Serviço</div>
		<div class="login-body">

            <form method="POST" action="/login" class="user" id="formLogin">
                @csrf
				<label>Usuário</label>
				<input type="text"
						class="form-control"
						id="usuario"
						name="usuario"
						autofocus
						required
						data-plus-as-tab="true">
				<label>Senha</label>
				<input type="password"
					class="form-control"
					id="senha" 
					name="senha"
					data-plus-as-tab="true"
					required>
          
				<hr> 
				<input type="button" onclick="$('#formLogin').submit();" value="Entrar" class="form-control btn btn-success " name="btnEntrar">

			</form>
			  <div align="center">
				<small>Copyright &copy; www.brasilsoftware.com 2022</small>
			  </div>
		</div>
	</div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>

  <script src="/js/jquery.bootstrap-growl.js"></script>
  <script src="/js/plusastab.joelpurra.js"></script>
  <script src="/js/emulatetab.joelpurra.js"></script>

<script>

  function mensagem(texto) {
	$.bootstrapGrowl(texto,
	{
	type: "danger",
	ele: "body",
	offset: {
	from: "top",
	amount: 20
	},
	align: "right",
	width: 250,
	delay: 4000,
	allow_dismiss: true,
	stackup_spacing: 10
	});
  }
	@if(session('msg'))
		mensagem('{{session('msg')}}');
	@endif
	@if ($errors->any())
		@foreach ($errors->all() as $error)
			mensagem('{{ $error }}');
		@endforeach
	@endif

</script>


</body>
<script>
	JoelPurra.PlusAsTab.setOptions({
		key: 13
	});
</script>


</html>
