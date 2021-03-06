<form id="lostpwd" name="lostpwd" method="post" action="ajx" class="form-link-confirmacao">
	<div class="form-group">
    <input required="true" type="email" class="form-control text-center" id="emladdr" name="emladdr" placeholder="Email Cadastrado">
    <small id="reconfirmarEmail" class="form-text text-muted">Informe o endereço de email utilizado em seu cadastro.</small>
	</div>
	<div class="form-group text-center">
    <input type="hidden" id="do" name="do" value="lostpwd"></input>
    <button type="button" class="btn btn-danger btn-lstpwd" data-go="<?php echo URLAPP.'ajx'?>">Recuperar Acesso</button>  
	</div>
  <a href="login">Login?</a> - <a href="cadastro">Cadastre-se</a>
</form>
