<?php 
use \db\Sql;
use \db\ProcSql;
use admin\faturas\Faturas;


if(!isSet($idfatura)){
  
  $lfats          = Faturas::listaFaturas( UIDEMPRESA );
  $listaDeFaturas = 'Nenhuma Fatura Encontrada!';
  
  if($lfats==false || $lfats==0){
      $listaDeFaturas = 'Nenhuma Fatura Encontrada!';
  }else{
    
    for ($i = 0; $i < count($lfats); $i++)
    {
      $faturas = $lfats[$i];
      foreach ($faturas as $key => $value) {
        $listaDeFaturas .= "{$key} => {$value}<br />\n";
      }
    }
  }
  
}else{//SE ID FATURA INFORMADO RETORNA DADOS DA FATURA
  
  $dadosFatura    = Faturas::dadosFatura( $idfatura );
  $detalhesFatura = '';
  
  if($dadosFatura==false || $dadosFatura==0){
    
    $detalhesFatura = 'Dados não disponíveis!';
  
  }else{
    
    for ($i = 0; $i < count($dadosFatura); $i++)
    {
      $detalhes = $dadosFatura[$i];
      
      foreach ($detalhes as $key => $value) {
        $detalhesFatura .= "{$key} => {$value}<br />\n";
      }
      
    }
    
    
    
    
    
  }
  
}

?>
