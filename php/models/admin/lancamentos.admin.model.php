<?php 
use \db\Sql;
use \db\ProcSql;
use admin\lancamentos\Lancamentos;


if(!isSet($idlancamento)){
  
  $llctos       = Lancamentos::listaLancamentos( UIDEMPRESA );
  $listaDeLctos = '';
  
  if($llctos==false || $llctos==0){
      $listaDeLctos = 'Nenhum Lançamento Encontrado!';
  }else{
    
    for ($i = 0; $i < count($llctos); $i++)
    {
      $lancamentos   = $llctos[$i];
      $listaDeLctos .=  "<hr />\n";
      
      foreach ($lancamentos as $key => $value) {
        $listaDeLctos .= "{$key} => {$value}<br />\n";
      }
      
    }
  }
  
}else{//SE ID FATURA INFORMADO RETORNA DADOS DA FATURA
  
  $dadosLcto    = Lancamentos::dadosLancamento( $idlancamento );
  $detalhesLcto = '';
  
  if($dadosLcto==false || $dadosLcto==0){
    
    $detalhesLcto = 'Dados não disponíveis!';
  
  }else{
    
    for ($i = 0; $i < count($dadosLcto); $i++)
    {
      $detalhes = $dadosLcto[$i];
      
      foreach ($detalhes as $key => $value) {
        $detalhesLcto .= "{$key} => {$value}<br />\n";
      }
      
    }
    
    
    
    
    
  }
  
}

?>
