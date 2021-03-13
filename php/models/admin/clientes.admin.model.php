<?php 
use \db\Sql;
use \db\ProcSql;
use admin\usuarios\Usuarios;

$legenda     = '<h2>Legenda 2</h2>';


$_listaUsers = Usuarios::getListUserCli();

if(!isSet($idcliente)){//caso ID USUARIO não informado então lista todos
  
$_listaUsers = Usuarios::getListUserCli();
  
}elseif(isSet($idcliente)&&$idcliente!=''){//CASO INFORMADO RECUPERA OS DADOS
  
$_dataUserCli     = Usuarios::getUserCli($idcliente);
if(count($_dataUserCli)>0){$cli = $_dataUserCli[0];}

$_dependentesCli  = Usuarios::getDependentes($_dataUserCli[0]['id_cliente']);
$_enderecoCli     = Usuarios::getEndereco($_dataUserCli[0]['id_cliente']);
if(count($_enderecoCli)>0){$end = $_enderecoCli[0];}

$_pedidosCli     = Usuarios::getPedidos($_dataUserCli[0]['id_usuario']);
$_servicosCli    = Usuarios::getItensPedido($_dataUserCli[0]['id_usuario']);

}


//$lista_usuarios = json_encode($lista);

/*
mailTo(
      'roberto.rsc@gmail.com',
      'Mensagem de notificacao de TESTE',
      'AVISO: um administrador solicitou a lista de clientes em'.date('d/m/Y H:i:s'));
*/






?>
