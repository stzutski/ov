<?php   
    use app\App;
    define('RESTRITA_ADMIN','views/area-restrita/admin/');

    $app->get('/', function () {
      $incBody = RESTRITA_ADMIN . 'telas/dashboard.php';    
      include 'views/cliente.page.tpl.php';
    });
      
    $app->get('/perfil-admin', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'forms/perfil.form.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/clientes', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/lista-clientes.php';    
      include ('php/models/admin/clientes.admin.model.php');
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/servicos', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/servicos.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/faturas', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/faturas.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/detalhe-fatura/:idfatura', function ($idfatura) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhe-faturas.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/financeiro', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/financeiro.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/detalhes-cliente/:idcliente', function ($idcliente) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhes-cliente.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/mensagens', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/mensagens.php';    
      include 'views/admin.page.tpl.php';
    });
      
    $app->get('/tickets-suporte', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/suporte-ticket.php';    
      include 'views/admin.page.tpl.php';
    });



?>
