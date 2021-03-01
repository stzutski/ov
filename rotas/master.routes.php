<?php   
  use app\App;
  define('RESTRITA_MASTER','views/area-restrita/master/');

  if(decode( sessionVar('_uL') ) == 'master' ){
      
    $app->get('/perfil-master', function () {
      App::chkPerm('master','master');
      $incBody = RESTRITA_MASTER . 'forms/perfil.form.php';    
      include 'views/master.page.tpl.php';
    });
  
  
  }
?>
