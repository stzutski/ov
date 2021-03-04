<?php 
//$app->redirect('http://localhost/labs/ov/resultado/'.$result);

if(postVar('do')=='login'){

  if(postVar('user')=='cliente' && postVar('pwd')=='cliente'){
      $_SESSION['_uL']    = encode('cliente');
      $_SESSION['logado'] = 'sim';
  }
  elseif(postVar('user')=='admin' && postVar('pwd')=='admin'){
      $_SESSION['_uL'] = encode('admin');
      $_SESSION['logado'] = 'sim';
  }
  elseif(postVar('user')=='master' && postVar('pwd')=='master'){
      $_SESSION['_uL'] = encode('master');
      $_SESSION['logado'] = 'sim';
  }else{
    $app->redirect(URLAPP . 'erro-login/nao-autorizado');
  }
  
  $app->redirect(URLAPP);
}

if(postVar('do')=='saveorder'){
  
  //recebe dados do post para recuperar a categoria os servicos e as quantidades contratadas
  $camposPost   = $_POST;
  $itensPedido  = array();
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
  
}

?>
