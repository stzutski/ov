<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Confirmação de Cadastro</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<base href="http://localhost/labs/ov/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/cadastro.css?rnd=<?php echo rand(0,255);?>">
</head>
<body>
  
  
<?php 
//AINDA DEVE SER FEITO

if(!isSet($codigoConfirmacao)){
  include 'views/site/rotinas-cadastro/cadastro.aviso-confirmacao.page.php';
}
if(isSet($codigoConfirmacao) && $codigoConfirmacao!=''){
  
  if(!isSet($status_cadastro) || $status_cadastro=='0'){//cadastro nao confirmado erro na confirmacao
  include 'views/site/rotinas-cadastro/cadastro.erro-na-confirmacao.page.php';  
  }
  
  if(isSet($status_cadastro) && $status_cadastro=='1'){//cadastro CONFIRMADO COM SUCESSO
  include 'views/site/rotinas-cadastro/cadastro.cadastro-confirmado.page.php';  
  }
}

?>  
  
  

<script src="assets/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="assets/scripts.js"></script>
</body>
</html>  
