<?php 
  //POST PROCESS
  $app->post('/process', function () use ($app) {
        include 'php/models/post.process.php';
  });

  //GET AJAX
  $app->get('/ajx', function () {
    include 'php/models/ajx.process.php';
  });

  //POST AJAX
  $app->post('/ajx', function () {
    include 'php/models/ajx.process.php';
  });

  //LOGOUT
  $app->get('/logout', function() use ($app) {
    if(sessionVar('_uL')){unset($_SESSION['_uL']);}
     $app->redirect(URLAPP . 'login');
  }); 
    
  //ERRO 404 (CARREGA PAGINA DE ERRO 404)
  $app->notFound(function () use ($app) {
      //echo "PAGINA NAO ENCONTRADA";
      include_once('views/errors/404.html');
  });  
?>
