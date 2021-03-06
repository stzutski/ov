<?php 
//rotina para conferir se email esta em uso no sistema
use \db\Sql;
use \site\CadUserCli;


if(postVar('emladdr')){
  $_emailUser = trim(postVar('emladdr'));
  if($_emailUser!=''){
  $cadUsrCli  = new CadUserCli();
  $res        = $cadUsrCli->consultaEmail($_emailUser);
  
    if($res==0){
      echo 0;//caso email nao encontrado retorna 0
      //echo 'alert("email ok")';
      //echo '$("#emlUsed").hide();$("#emlOk").show();$("#emlErr").hide();';
      //echo 'emlAlerts(0)';
    }elseif($res==1001){
      echo 1;//caso encontrado retorna 1
      //echo 'alert("email EM USO")';
      //echo '$("#emlUsed").show();$("#emlOk").hide();$("#emlErr").hide();';
      //echo 'emlAlerts(1)';
    }elseif($res==1002){
      echo 2;//email mal formatado
      //echo 'alert("email INCORRETO")';
      //echo '$("#emlUsed").hide();$("#emlOk").hide();$("#emlErr").show();';
      //echo 'emlAlerts(2)';
    }
  }
  
}


?>
