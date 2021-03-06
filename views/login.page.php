<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Acessar</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<base href="http://localhost/labs/ov/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/login.css?rnd=<?php echo rand(0,255);?>">
</head>
<body>

  <div class="container">

  <center><h3>ACESSO</h3></center>

    <form method="post" action="process" class="form-login">

      <div class="form-group">
        <input required="true" type="text" class="form-control text-center" id="user" name="user" placeholder="Usuario">
      </div>
      
      <div class="form-group">
        <input required="true" type="password" class="form-control text-center" id="pwd" name="pwd" placeholder="Senha">
      </div>
      
      <div class="form-group">
        <input type="hidden" id="do" name="do" value="login"></input>
        <button type="submit" class="btn btn-primary">LOGIN</button>
      </div>
      
      <p><a href="recuperar-acesso">Esqueceu a senha?</a> - <a href="cadastro">Cadastre-se</a></p>

      <?php if(isSet($erro) && $erro=='nao-autorizado'){?>
      <div class="alert alert-warning" role="alert">
        Usuário ou senha incorretos!
      </div>
      <?php }
      elseif(isSet($erro) && $erro=='nao-confirmado'){?>
      <div class="alert alert-warning" role="alert">
        O cadastro ainda não foi confirmado! Confira sua caixa de entrada e clique no link de confirmação.
        <br />
        <a href="cadastro/confirmacao">Não recebeu o email?</a>
      </div>
      <?php }?>


    </form>

  </div>

<script src="assets/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="assets/scripts.js"></script>
</body>
</html>
