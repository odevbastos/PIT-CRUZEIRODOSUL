<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro de clientes</title>

  <link rel="shortcut icon" href="/img/logobrasilsoftware.png" type="image/x-icon" />

  <!-- Custom fonts for this template-->
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/sb-admin-2.min.js"></script>
  <script src="/js/plusastab.joelpurra.js"></script>
  <script src="/js/emulatetab.joelpurra.js"></script>
  <script src="/js/jquery.bootstrap-growl.js"></script>
  
  <!-- Material Design Bootstrap -->
  <link href="/css/mdb.min.css" rel="stylesheet">
 
 <!-- Custom styles for this template-->
  <link href="/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/jquery-ui.css">
  <script src="/js/jquery-ui.js"></script>
  <script type="text/javascript" src="/js/language/pt-BR.js"></script>

  <link href="/css/cadCliente.css" rel="stylesheet">

  <style>
	
	 .background-colorPerfil
	{
    background-color: #38abd1;
	}

	</style>
	<script>
  function mensagem(texto) {
      $.bootstrapGrowl(texto,
      {
        type: "info",
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

  function mensagemErro(texto) {
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
  
	</script>

    <script type="text/javascript" src="/js/selectize.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/selectize.css" />

    <script type="text/javascript" src="/js/summernote-lite.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/summernote-lite.css" />
    <script type="text/javascript" src="/js/summernote-pt-BR.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link type="text/css" href="/css/jquery-fab-button.css" rel="stylesheet">

	<script language="javascript" type="text/javascript" src="/js/jquery.canvaswrapper.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.colorhelpers.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.saturated.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.browser.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.drawSeries.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.uiConstants.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.legend.js"></script>
	<script language="javascript" type="text/javascript" src="/js/jquery.flot.pie.js"></script>
	
</head>

<body id="page-top" style="font-family: 'Georgia, serif;'" onload="startTime();">

  <!-- Page Wrapper -->
	<div id="wrapper">

    <!-- Sidebar -->
	@yield('sidebar')
	
    <!-- End of Sidebar -->
	</div>
	
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
		<nav class="navbar fixed-top navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">
		
		<!-- Topbar Navbar -->

		<ul class="navbar-nav">
			<li>
				<a style="font-weight: bold; color: black; font-size: 20px;" href="/principal">
          <img src="/img/logobrasilsoftware.png" width="40">
          <span class="mr-2 d-none d-lg-inline"> Cadastro de clientes </span>
        </a>
			</li>
		</ul>
		
		<ul class="navbar-nav ml-auto">
			@yield('botaoVoltar')

		  @yield('mensagensUsuario')
		  
		  <div class="topbar-divider d-none d-sm-block"></div>

		  <!-- Nav Item - User Information -->
		  <li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <span class="mr-2 d-none d-lg-inline"><font color="blue"><span id="relogio"></span><span id="saudacao"><br>{{ session()->get('usuario_logado')->usr_nome }}</span></font></span>
			  <img id="fotoUsuario" name="fotoUsuario" src="/img/user.png">
			</a>

			<!-- Dropdown - User Information -->
			<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
			  <a class="dropdown-item" href="/logout" data-toggle="modal" data-target="#logoutModal">
				<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
				Sair
			  </a>
			</div>
		  </li>

		</ul>
				
		</nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
		<div class="container-fluid" style="margin-top: 100px;"  >    
    
		@yield('conteudo')
		</div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; www.brasilsoftware.com 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
   
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Deseja sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em Sair para encerrar a sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="/logout">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="/js/popper.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="/js/mdb.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

<script>
var contadorGeral         = 9; // começa em 9 para executar na primeira carga

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();

    var indice;
    var indMensagem;

    m = checkTime(m);
    s = checkTime(s);

    if ($('#relogio').length) {
      document.getElementById('relogio').innerHTML = h + ":" + m + ":" + s;
    }

    var t = setTimeout(startTime, 5000);
    contadorGeral++;
    if (contadorGeral > 10) {
      contadorGeral = 0;
    }
  }

  function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
  }
  JoelPurra.PlusAsTab.setOptions({
    key: 13
	});
  
  function selecionaCombo(obj, campo, campoRelacionado) {
        if (campo == 1) {
            $('#' + campoRelacionado).val(obj.value).trigger('change');
        } else {
            $('#' + campoRelacionado).val(obj.value);
        }
    }

  function pesquisaCNPJ(cnpj){
      var urlBase       = 'http://ws.hubdodesenvolvedor.com.br/v2/cnpj/?json&cnpj=';
      var ignore_db     = '&ignore_db';
      var cnpjFormatado = cnpj.value.replace(/\D/g, '');
      var tokenBrasil   = '&token=67675270sBbqfUkCZE122185648';

      if (localizaClienteExistente(cnpjFormatado)) {

        var urlCompleta   = urlBase + cnpjFormatado + tokenBrasil;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", urlCompleta, true);

        xhttp.onreadystatechange = function(){
            if ( xhttp.readyState == 4 && xhttp.status == 200 ) {
                var retorno = JSON.parse(xhttp.responseText).status;

                if ( retorno ){
                    var empresa = JSON.parse(xhttp.responseText).result;

                    // Razão social
                    if (empresa.nome.length > 50) {
                      document.getElementById('razao_social').value   = empresa.nome.substring(0, 50);
                    } else {
                      document.getElementById('razao_social').value   = empresa.nome;
                    }

                    // Nome fantasia
                    if (empresa.fantasia.length > 0) {
                      if (empresa.fantasia.length > 40) {
                        document.getElementById('nome_fantasia').value  = empresa.fantasia.substring(0, 40);
                      }else{
                        document.getElementById('nome_fantasia').value  = empresa.fantasia;
                      }
                    }

                    // Endereço
                    if (empresa.logradouro.length > 0) {
                      if (empresa.logradouro.length > 60) { 
                        document.getElementById('endereco').value = empresa.logradouro.substring(0, 40);
                      } else {
                        if (empresa.complemento.length > 0) {
                          if ((empresa.logradouro + ' / ' + empresa.complemento).length > 60) {
                            document.getElementById('endereco').value = (empresa.logradouro + ' / ' + empresa.complemento).substring(0, 60);
                          }else {
                            document.getElementById('endereco').value = empresa.logradouro + ' / ' + empresa.complemento;
                          }
                        }
                      }
                    }

                    // Número (endereço)
                    if (empresa.numero.length > 0) {
                      if (empresa.numero.isInteger(value)){
                        document.getElementById('numero').value = empresa.numero;
                      }
                    }

                    // Bairro
                    if (empresa.bairro.length > 0) {
                      if (empresa.bairro.length > 30) { 
                        document.getElementById('bairro').value = empresa.bairro.substring(0, 30);
                      }else{
                        document.getElementById('bairro').value = empresa.bairro;
                      }
                    }
                    
                    // CEP
                    if (empresa.cep.length > 0) {
                      document.getElementById('cep').value = empresa.cep;
                    }

                    // E-mail
                    if (empresa.email.length > 0) {
                      if (empresa.email.length > 40) {
                        document.getElementById('email').value = empresa.email.substring(0, 40);
                      }else{
                        document.getElementById('email').value = empresa.email;
                      }
                    }

                    // Telefone
                    if (empresa.telefone.length > 0) {
                      if (empresa.telefone.length > 20) {
                        document.getElementById('telefone').value = empresa.telefone.substring(0, 20);
                      }
                    }

                    // Retorna código da cidade
                    localizaCidade(empresa.municipio);
                }
            }
        }
        xhttp.send();

      }else {
        document.getElementById('cgc_cpf').value = '';
      }
  }

  function localizaCidade(nome_cidade){
      var nome = retira_acentos(nome_cidade);

      $.ajax({
          type: 'GET',
          url:  '/ConsultaCidade/' + nome,
          cache: false,
          success: function(texto) { 
              var cidade = JSON.parse(texto);
              document.getElementById('codigo_cidade').value = cidade.codigo;
              document.getElementById('desc_cidade').value = cidade.nome;
              selecionaCombo(document.getElementById('codigo_cidade'), 1, 'desc_cidade');
          }
      });
  }

  function localizaClienteExistente(cnpj){
    var retorno = true;

      $.ajax({
          type: 'GET',
          url:  '/ConsultaClienteExistente/' + cnpj,
          cache: false,
          success: function(texto) { 
              var cliente = JSON.parse(texto);

              mensagem('Cliente já cadastrado.\n' +
                    'Entre em contato com a Brasil Software.\n\n' + 
                    '(75) 3221-6114');
              
              retorno = false
          }
      });

      return retorno;
  }

  function retira_acentos(str) {
      com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝŔÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿŕ";
      sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
      novastr="";
      
      for(i=0; i<str.length; i++) {
        troca=false;
        for (a=0; a<com_acento.length; a++) {
          if (str.substr(i,1)==com_acento.substr(a,1)) {
            novastr+=sem_acento.substr(a,1);
            troca=true;
            break;
          }
        }
        if (troca==false) {
          novastr+=str.substr(i,1);
        }
      }
      
      return novastr;
  }

  @if(session('msg'))
		mensagem('{{session('msg')}}');
	@endif

</script>
<script src="js/jquery-fab-button.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>   
<script>
    $('.dinheiro').mask('#.###.###.###.###.###,##', {reverse: true});
    $('.telefone').mask('(00) #00000000');
    $('.celular').mask('(00) #00000000');
    $('.cep').mask('00.000-000');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.numero').mask('########0');
</script>

</body>
</html>
