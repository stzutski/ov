<?php 
//rotina para realizar a confirmacao e ativacao do cadastro
//deve receber pelo GET( $codigoConfirmacao ) e retornar $status_cadastro = 0 | 1
use \db\Sql;
use \site\CadUserCli;


if(!isSet($codigoConfirmacao) || $codigoConfirmacao==''){//CASO COD NAO RECEBIDO OU EM BRANCO
  
  $status_cadastro = 0;//RETORNA ZERO (INFORMANDO O ERRO)
  
}
elseif(isSet($codigoConfirmacao) && $codigoConfirmacao!=''){
  
  $user = new CadUserCli();
  $res  = $user->userCadConfirm($codigoConfirmacao);
  
  if($res==null){//caso NULL ou codigo não informado ou inexistente
    
    $status_cadastro = 0;
    
  }elseif($res==false){//o codigo é valido mas ocorreu um erro na ativacao (update tab usuarios)
    
    $status_cadastro = 0;
    
  }elseif($res==true){//caso TRUE (ATIVADO COM SUCESSO)
    
    $status_cadastro = 1;
    
  }

}









?>
