<?php   
    use app\App;
    define('RESTRITA_CLIENTE','views/area-restrita/cliente/');
        
    $app->get('/', function () {
      $incBody = RESTRITA_CLIENTE . 'paginas/dashboard.php';    
      include 'views/cliente.page.tpl.php';
    });
      
    $app->get('/perfil-usuario', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');

      $incBody = RESTRITA_CLIENTE . 'forms/perfil.form.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/servicos-disponiveis', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/servicos-detalhes/:idservico', function ($idservico) {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos-detalhe.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/servicos-contratados', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos-contratados.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/minhas-faturas', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/minhas-faturas.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/pagar-fatura/:codfatura', function ($codfatura) {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/pagar-fatura.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/meus-arquivos', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/meus-arquivos.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/mensagens', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/mensagens.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-chat', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-chat.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-videochat', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-videochat.php';    
      include 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-ticket', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-ticket.php';    
      include 'views/cliente.page.tpl.php';
    });



?>
