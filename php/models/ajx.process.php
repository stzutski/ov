<?php 
//rotina de recuperacao de senha
if(postVar('do')=='lostpwd'){
  include_once('php/models/site/recuperar-senha.site.model.php');
}

//rotina para conferir se email esta cadastrado
if(postVar('do')=='chkmail' || postVar('go')=='chkmail'){
  include_once('php/models/site/checkmail.site.model.php');
}

//rotina para conferir se email esta cadastrado
if(postVar('do')=='reconf'){
  //model com as rotinas de recuperacao de senha de acesso
  include_once('php/models/site/login.site.model.php');
}

//rotina para atualizar a ordem de itens em uma tabela Z-ORDENADA
if(postVar('do')=='reorder' || postVar('go')=='reorder'){
  include_once('php/models/admin/reorder.admin.model.php');  
}

//rotina para clonar servicos > fases > etapas
if(postVar('do')=='cloneserv' || postVar('go')=='cloneserv'){
  include_once('php/models/admin/cloneserv.admin.model.php');
}

//rotina para clonar servicos > fases > etapas
if(postVar('do')=='ficha' || postVar('go')=='ficha'){
  include_once('php/models/admin/ficha.admin.model.php');
}

//rotina retornar CIDADES DE UM ESTADO(UF)
if(postVar('do')=='lstcidades' || postVar('go')=='lstcidades'){
  include_once('php/models/site/cadastro.site.model.php');
}



$tipo='';
$msg='';

if(isSet($_GET['tipo'])){$tipo=$_GET['tipo'];}
if(isSet($_GET['msg'])){$msg=$_GET['msg'];}

if($tipo=='alert' && $tipo!=''){
  
  echo 'alert("Alerta: '.$msg.'");';
  
}

if($tipo=='alert2' && $tipo!=''){
  
  echo 'alert("Alerta2: '.$msg.'");';
  
}

?>
