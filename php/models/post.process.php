<?php 
//$app->redirect('http://localhost/labs/ov/resultado/'.$result);

if(postVar('do')=='login'){

  //model com as rotinas de recuperacao de senha de acesso
  include_once('php/models/site/login.site.model.php');

}

//recuperacao de senha do usuario
if(postVar('do')=='lostpwd'){
  
  //model com as rotinas de recuperacao de senha de acesso
  include_once('php/models/site/recuperar-senha.site.model.php');
  
}

//reenvio de email de confirmação do cadastro
//~ if(postVar('do')=='reconf'){
  
  //~ //model com as rotinas de recuperacao de senha de acesso
  //~ include_once('php/models/site/login.site.model.php');
  
//~ }

if(postVar('do')=='saveorder'){
  
  //model com as rotinas para gerar novos pedidos
  include_once('php/models/cliente/pedidos.site.model.php');  
  
}

if(postVar('do')=='saveCat'){
  
  //model com as rotinas atualizar servicos da empresa
  include_once('php/models/admin/servicos.admin.model.php');  
  
}

if(postVar('do')=='saveFase'){
  
  //model com as rotinas atualizar servicos da empresa
  include_once('php/models/admin/fases.admin.model.php');  
  
}

if(postVar('do')=='saveService'){
  
  //model com as rotinas atualizar servicos da empresa
  include_once('php/models/admin/servicos.admin.model.php');  
  
}

?>
