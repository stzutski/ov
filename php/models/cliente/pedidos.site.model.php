<?php 
//MODEL COM ROTINAS RELATIVAS AOS PEDIDOS DE COMPRAS (CONTRATACOES) REALIZADOS PELO CLIENTE "LOGADO"
use \db\Sql;
use \db\ProcSql;
use cliente\servicos\Servicos;


  //recebe dados do post para recuperar a categoria os servicos e as quantidades contratadas
  $camposPost   = $_POST;
  $itensPedido  = array();S
  foreach ($camposPost as $key => $value) {
    
    if(strstr($key,'qt_')){
        $iPed              = str_replace('qt_','',$key);
        $itensPedido[$iPed] = $value;//grava no array o ID do servidor e a quantidade solicitada (ITENS DO PEDIDO)
    }
    
  }
  
  if(count($itensPedido)>0 && $camposPost['idc']){
    
    $novo_pedido['itens']     = $itensPedido;
    $novo_pedido['categoria'] = $camposPost['idc'];
    
    //insere um novo pedido na tabela
    include_once ('php/models/cliente/servicos.cliente.model.php');
    
    if(isSet($idPedido)){
      $app->redirect(URLAPP .'carrinho-pedido/' . $idPedido);
    }
    
  }


?>
