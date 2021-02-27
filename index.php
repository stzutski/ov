<?php 
include 'config.php';


use \Slim\Slim;

$app = new \Slim\Slim();


/*
  $app->get('/feed', function() use ($app) {
    
      $app->redirect('http://localhost/labs/ov/cadastro');
      
  });

  $app->get('/admin', function () {
      $incBody='views/restrictArea/admin/forms/teste.form.php';
      include('views/admin.page.tpl.php');
  });
*/




  //rotas do sistema
  require_once('routes/system.routes.php');
  
  //rotas abertas do site (ex: login, cadastro, rec.Senha...etc.)
  require_once('routes/site.routes.php');

  //rotas para usuarios nivel: CLIENTES logados
  require_once('routes/cliente.routes.php');

  //rotas para usuarios nivel: ADMIN logados
  require_once('routes/admin.routes.php');

  //rotas para  usuarios nivel: MASTER logados
  require_once('routes/master.routes.php');


  

  $app->get('/logout', function () {
      header('location:http://localhost/labs/ov');
  });










$app->run();




?>
