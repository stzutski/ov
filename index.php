<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

//REGISTRA SESSAO
session_start();

include 'config.php';

use \Slim\Slim;
$app = new \Slim\Slim();



  require_once('rotas/system.routes.php');////rotas de sistema
/*
if(decode( sessionVar('_uL') ) == 'cliente' ){

  $app->get('/', function () {  
  $incBody='views/area-restrita/cliente/cliente.dashboard.php';
  include 'views/cliente.page.tpl.php';
  }
  
}
elseif(decode( sessionVar('_uL') ) == 'admin' ){
  
  $app->get('/', function () {  
  $incBody='views/area-restrita/admin/admin.dashboard.php';
  include 'views/admin.page.tpl.php';
  }  
  
}
elseif(decode( sessionVar('_uL') ) == 'master' ){
  
  $app->get('/', function () {  
  $incBody='views/area-restrita/master/master.dashboard.php';
  include 'views/master.page.tpl.php';
  }
  
}else{
  
  $app->get('/', function () {  
  include 'views/login.page.php';
  }

}*/




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
      //include 'views/login.page.php';
    }
    
  });

  //LOGIN: FORMULARIO DE LOGIN
  $app->get('/login', function () {
      include 'views/login.page.php';
  });

  //LOGIN: ERRO DADOS INCORRETOS
  $app->get('/erro-login/:erro', function($erro) {
    include 'views/login.page.php';
  });

  //RECUPERAR ACESSO: FORM RECUPERACAO
  $app->get('/recuperar-acesso', function () {
      include 'views/recuperar-acesso.page.php';
  });

  //RECUPERAR ACESSO: STATUS RECUPERACAO
  $app->get('/confirma-recuperacao/:codRecuperacao', function ($codRecuperacao) {
      include_once('php/models/site/recuperar-senha.site.model.php');//CARREGA O MODEL DE RECUPERACAO
      include 'views/recuperar-acesso-status.page.php';
  });

  //CADASTRO :: FORMULARIO DE CADASTRO
  $app->get('/cadastro', function () {
      include 'views/cadastro.page.php';
  });

  //CADASTRO :: AVISO DE CONFIRMACAO NECESSARIA
  $app->get('/cadastro/confirmacao', function () {
      include 'views/cadastro.aviso-confirmacao.page.php';
  });

  //CADASTRO :: RCBTO VIA GET DO LINK DE CONFIRMACAO
  $app->get('/cadastro/confirmacao/:codigoConfirmacao', function ($codigoConfirmacao) {
      include_once('php/models/site/confirma-cadastro.site.model.php');//CARREGA O MODEL DE CONFIRMACAO
      include 'views/cadastro.aviso-confirmacao.page.php';
  });



  require_once('rotas/cliente.routes.php');
  require_once('rotas/admin.routes.php');
  //require_once('rotas/master.routes.php');


 
    
$app->run();

?>
