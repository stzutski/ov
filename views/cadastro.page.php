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

<form id="adUser" name="adUser" method="post" action="cadastro" class="form-cadastro box-texto-home">

<?php 
if(iSSet($msge)&&$msge!=''){
echo '<div class="alert alert-warning" role="alert"><center><b>Erros Encontrados!</b></center><br />'.nl2br($msge).'</div>';
}?>


	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoNome" name="campoNome" value="<?php echo postVar('campoNome');?>" placeholder="Nome">
	</div>
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoSobrenome" name="campoSobrenome" value="<?php echo postVar('campoSobrenome');?>" placeholder="Sobrenome">
	</div>
	<div class="form-group">
	<input required="true" type="email" class="form-control chkRegisterMail" id="campoEmail" name="campoEmail" value="<?php echo postVar('campoEmail');?>" placeholder="Seu email" data-go="<?php echo URLAPP . 'ajx'?>">
  <small id="emlUsed" class="form-text text-danger" style="display:none;">O email já esta em uso.</small>
  <small id="emlOk" class="form-text text-success" style="display:none;">O email ok.</small>
  <small id="emlErr" class="form-text text-danger" style="display:none;">Não parece válido.</small>
	</div>
	<div class="form-group">
	<input required="true" type="text" class="form-control" id="campoTelefone" name="campoTelefone" value="<?php echo postVar('campoTelefone');?>" <?php echo jsMask('telefone');?> placeholder="Celular: ex: (00) 0000-0000">
  <small id="campoTelefone" class="form-text text-muted">Somente números.</small>
	</div>	
	<div class="form-group">
	<input aria-describedby="cpfHelp" required="true" type="text" class="form-control" id="campoCpf" name="campoCpf" value="<?php echo postVar('campoCpf');?>" <?php echo jsMask('cpf',14);?> placeholder="CPF: ex: 000.000.000-00">
  <small id="cpfHelp" class="form-text text-muted">Somente números.</small>
	</div>

	<div class="form-group">
	<select required="true" id="campoUf" name="campoUf" class="form-control" data-url="<?php echo URLAPP;?>">
		<option value="">Selecione o Estado</option>
		<?php echo listaUF('',true,postVar('campoUf')); ?>
	</select>
	</div>	
  
	<div class="form-group">
    <div id="cidAjx">
      <select required="true" id="campoCidade" name="campoCidade" class="form-control">
        <?php
        $cidades = listaCidades('',true); 
        if(postVar('campoUf')!= '' && postVar('campoCidade')!=''){
        $cidades = listaCidades(postVar('campoUf'),true,postVar('campoCidade')); 
        }
        if($cidades==false){
          echo '<option value="">Selecione</option>';
          echo '<option value="">Estado Não Informado</option>';
        }
        else
        {
          echo '<option value="">Selecione a Cidade</option>';
          echo $cidades;
        }
         ?>
      </select>
    </div>	
	</div>	
  

	<div class="form-group">
	<input aria-describedby="pwdHelp" required="true" type="password" class="form-control" id="campoSenha" name="campoSenha" placeholder="Senha">
  <small id="pwdHelp" class="form-text text-muted">Mínimo 6 caracteres.</small>
	</div>
	<div class="form-group">
	<input required="true" type="password" class="form-control" id="campoConfSenha" name="campoConfSenha" placeholder="Confirme a senha">
  <small id="campoConfSenha" class="form-text text-muted">Confirme a senha escolhida.</small>
	</div>

	<div class="form-group">
  <input type="hidden" id="uidEmpresa" name="uidEmpresa" value="1">
  <input type="hidden" id="campoPais" name="campoPais" value="BRA">
  <input type="hidden" id="do" name="do" value="newuser">
  <button id="btCads" type="button" class="btn btn-primary">Cadastrar</button>
	</div>

  <p><a href="login">Login</a> - <a href="recuperar-acesso">Perdeu a senha?</a></p>

</form>


</div>




<script src="assets/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="assets/masks.js"></script>
<script src="assets/sigup.js?v=<?php echo time();?>"></script>
<script src="assets/scripts.js?v=<?php echo time();?>"></script>
</body>
</html>
