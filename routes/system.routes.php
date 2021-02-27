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
  
  //ERRO 404
  $app->notFound(function () use ($app) {
      //echo "PAGINA NAO ENCONTRADA";
      include_once('views/errors/404.html');
  });  
?>
