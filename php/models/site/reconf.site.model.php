<?php 
//rotina para conferir se email esta em uso no sistema
use \db\Sql;
use \site\CadUserCli;


if(postVar('emladdr')){
  $_emailUser = postVar('emladdr');
  if($_emailUser!=''){
  $cadUsrCli = new CadUserCli();
  $res = $sql->consultaEmail($_emailUser);
  
    if($res==0){
      echo 0;//caso email nao encontrado retorna 0
    }elseif($res==1001){
      echo 1;//caso encontrado retorna 1
    }elseif($res==1002){
      echo 2;//email mal formatado
    }
  }
  
}


?>
