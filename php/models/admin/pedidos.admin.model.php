<?php 
use \db\Sql;
use \db\ProcSql;
use admin\pedidos\Pedidos;


if(!isSet($idpedido)){
  
  $lpeds       = Pedidos::listaPedidos( UIDEMPRESA );
  $listaDePeds = '';
  
  if($lpeds==false || $lpeds==0){
      $listaDePeds = 'Nenhum Pedido Encontrado!';
  }else{
    
    for ($i = 0; $i < count($lpeds); $i++)
    {
      $pedidos      = $lpeds[$i];
      $listaDePeds .=  "<hr />\n";
      
      foreach ($pedidos as $key => $value) {
        $listaDePeds .= "{$key} => {$value}<br />\n";
      }
      
    }
  }
  
}else{//SE ID FATURA INFORMADO RETORNA DADOS DA FATURA
  
  $dadosPedi    = Pedidos::dadosPedido( $idpedido, UIDEMPRESA );
  $detalhesPedi = '';
  
  if($dadosPedi==false || $dadosPedi==0){
    
    $detalhesPedi = 'Dados não disponíveis!';
  
  }else{
    
    for ($i = 0; $i < count($dadosPedi); $i++)
    {
      $detalhes = $dadosPedi[$i];
      
      foreach ($detalhes as $key => $value) {
        $detalhesPedi .= "{$key} => {$value}<br />\n";
      }
      
    }
    
  }
  
  //retorna todos os itens do pedido selecionado
  $litens       = Pedidos::itensPedido( UIDEMPRESA );
  $listaDeItens = '';
  
  if($litens==false || $litens==0){
      $listaDeItens = 'Nenhum Item Para Este Pedido!';
  }else{
    
    for ($i = 0; $i < count($litens); $i++)
    {
      $itens      = $litens[$i];
      $listaDeItens .=  "<hr />\n";
      
      foreach ($itens as $key => $value) {
        $listaDeItens .= "{$key} => {$value}<br />\n";
      }
      
    }
  }  
  
  
}

?>
