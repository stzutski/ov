<?php 
//$app->redirect('http://localhost/labs/ov/resultado/'.$result);

if(postVar('do')=='login'){

  if(postVar('user')=='cliente' && postVar('pwd')=='cliente'){
      $_SESSION['_uL']    = encode('cliente');
      $_SESSION['logado'] = 'sim';
  }
  elseif(postVar('user')=='admin' && postVar('pwd')=='admin'){
      $_SESSION['_uL'] = encode('admin');
      $_SESSION['logado'] = 'sim';
  }
  elseif(postVar('user')=='master' && postVar('pwd')=='master'){
      $_SESSION['_uL'] = encode('master');
      $_SESSION['logado'] = 'sim';
  }else{
    $app->redirect(URLAPP . 'erro-login/nao-autorizado');
  }
  
  $app->redirect(URLAPP);
}



?>
