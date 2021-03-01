<?php 
namespace app;


class App {
  
  public static function chkPerm($required='',$userLevel=''){
    
    logsys("conferindo permissoes ($required),($userLevel)");
    
    //caso permissoes informadas entao confere
    if($required!='' && $userLevel!='')
    {
      if($required!=$userLevel){
          logsys("erro de permissao ($required),($userLevel)");
          header('Location:'.URLAPP);
          exit;
      }
          logsys("autorizando ($required),($userLevel)");
    }
    else//caso permissoes nao sejam informadas encaminha para home
    {
          logsys("erro de permissao ($required),($userLevel)");
          header('Location:'.URLAPP);
          exit;
    }
    
  }
  
  
}

?>
