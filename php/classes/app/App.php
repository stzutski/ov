<?php 
namespace app;


class App {
  
  public static function chkPerm($required='',$userLevel=''){
    
    
    //caso permissoes informadas entao confere
    if($required!='' && $userLevel!='')
    {
      if($required!=$userLevel){
          header('Location:'.URLAPP);
          exit;
      }
    }
    else//caso permissoes nao sejam informadas encaminha para home
    {
          header('Location:'.URLAPP);
          exit;
    }
    
  }
  
  
}

?>
