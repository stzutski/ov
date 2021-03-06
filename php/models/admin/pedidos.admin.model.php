<?php 
use \db\Sql;
use \db\ProcSql;
use \db\Dbi;
use admin\pedidos\Pedidos;


if(!isSet($idpedido)){
  
  $_dbi        = new Dbi();
  $dbiUser     = $_dbi->dbi_usuarios();
  $dbiCli      = $_dbi->dbi_clientes();

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
        $nome_user='';
        if($key=='id_usuario'){$nome_user=$dbiUser[$value]['nome_usuario'].' '.$dbiUser[$value]['sobrenome_usuario'];}
        
        $listaDePeds .= "{$key} => {$value}($nome_user)<br />\n";
      }
      
    }
  }
  
}else{//SE ID FATURA INFORMADO RETORNA DADOS DO PEDIDO
  
  $_dbi         = new Dbi();
  $dbiSrv       = $_dbi->dbi_servicos();
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
        $nome_servico='';
        if($key=='id_item'){$nome_servico=$dbiSrv[$value]['nome_servico'];}
        $listaDeItens .= "{$key} => {$value} ($nome_servico)<br />\n";
      }
      
    }
  }  
  
  
}

?>
