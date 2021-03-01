<?php 
include 'config.php';

use \Slim\Slim;
$app = new \Slim\Slim();
//$app->config('debug', true);

/*
  $app->get('/feed', function() use ($app) {
      $app->redirect('http://localhost/labs/ov/cadastro');
  });

  $app->get('/admin', function () {
      $incBody='views/restrictArea/admin/forms/teste.form.php';
      include('views/admin.page.tpl.php');
  });
*/
 


  require_once('rotas/system.routes.php');////rotas de sistema


  $app->get('/', function () {
    
    if(decode( sessionVar('_uL') ) == 'cliente' ){//rotas usr: CLIENTE
      $incBody='views/area-restrita/cliente/cliente.dashboard.php';
      include 'views/cliente.page.tpl.php';
    }
    elseif(decode( sessionVar('_uL') ) == 'admin' ){//rotas usr: ADMIN
      $incBody='views/area-restrita/admin/admin.dashboard.php';
      include 'views/admin.page.tpl.php';
    }
    elseif(decode( sessionVar('_uL') ) == 'master' ){//rotas usr: MASTER
      $incBody='views/area-restrita/master/master.dashboard.php';
      include 'views/master.page.tpl.php';
    }
    else{
      include 'views/login.page.php';
    }
    
  });

  $app->get('/login', function () {
      include 'views/login.page.php';
  });

  //ERRO LOGIN
  $app->get('/erro-login/:erro', function($erro) {
    include 'views/login.page.php';
  });

  //CADASTRO
  $app->get('/cadastro', function () {
      include 'views/site/cadastro.php';
  });


  require_once('rotas/cliente.routes.php');
  require_once('rotas/admin.routes.php');
  //require_once('rotas/master.routes.php');


 
    
$app->run();

?>
