<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Cadastre-se</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<base href="http://localhost/labs/ov/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/cadastro.css?rnd=<?php echo rand(0,255);?>">
</head>

<body>




<div class="container">

<center><h3>Cadastro de usuário (passo 1/2)</h3></center>

<form method="post" action="process" class="form-cadastro box-texto-home">

	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoNome" name="campoNome" placeholder="Nome">
	</div>
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoSobrenome" name="campoSobrenome" placeholder="Sobrenome">
	</div>
	<div class="form-group">
	<input required="true" type="email" class="form-control" id="campoEmail" name="campoEmail" placeholder="Seu email">
	</div>
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoTelefone" name="campoTelefone" placeholder="Celular: ex: (00) 0000-0000">
	</div>	
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoCpf" name="campoCpf" placeholder="CPF: ex: 000.000.000-00">
	</div>

	<div class="form-group">
	<select required="true" id="campoUf" name="campoUf" class="form-control">
		<option value="">Selecione</option>
		<?php echo listaUF('',true); ?>
	</select>
	</div>	
	<div class="form-group">
	<select required="true" id="campoPais" name="campoPais" class="form-control">
		<option value="">Selecione</option>
		<?php echo listaPais('',true); ?>
	</select>
	</div>


	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoSenha" name="campoSenha" placeholder="Senha">
	</div>
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoConfSenha" name="campoConfSenha" placeholder="Confirme a senha">
	</div>

	<div class="form-group">
  <input type="hidden" id="do" name="do" value="newuser"></input>
  <button type="submit" class="btn btn-primary">Cadastrar</button>
	</div>

  <p><a href="login">Login</a> - <a href="recuperar-acesso">Perdeu a senha?</a></p>

</form>


</div>




<script src="assets/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="assets/scripts.js"></script>
</body>
</html>
