<form id="reconf" method="post" action="process" class="form-link-confirmacao">
	<div class="form-group">
    <input required="true" type="email" class="form-control text-center" id="emladdr" name="emladdr" placeholder="Email Cadastrado">
    <small id="reconfirmarEmail" class="form-text text-muted">Informe o endereço de email utilizado em seu cadastro.</small>
	</div>
	<div class="form-group text-center">
    <input type="hidden" id="do" name="do" value="reconf"></input>
    <button type="button" class="btn btn-primary btn-reconf" data-go="<?php echo URLAPP.'ajx'?>">Solicitar Link</button>  
	</div>
  <p><a href="login">Login</a> - <a href="recuperar-acesso">Perdeu a senha?</a></p>
  
  <?php if(isSet($status_cadastro) && $status_cadastro==0){?>
  <div class="alert alert-warning" role="alert">
  <b>Aviso:</b> Se este erro persistir após receber um novo link de confirmação, envie uma mensagem para nosso suporte: <?php echo MAILSUPORTE;?>
  </div>  
  <?php }?>
  
</form>
