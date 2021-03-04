<?php   
    use app\App;
    define('RESTRITA_CLIENTE','views/area-restrita/cliente/');
        
    $app->get('/', function () {
      $incBody = RESTRITA_CLIENTE . 'paginas/dashboard.php';    
      include_once 'views/cliente.page.tpl.php';
    });
      
    $app->get('/perfil-usuario', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');

      $incBody = RESTRITA_CLIENTE . 'forms/perfil.form.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/categorias-servicos', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/categoria-servicos.php';
      include_once ('php/models/cliente/servicos.cliente.model.php');    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/contratar/servico/:idCategoriaServico', function ($idCategoriaServico) {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/contratar-servico.php';
      include_once ('php/models/cliente/servicos.cliente.model.php');    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/carrinho-pedido/:idPedido', function ($idPedido) {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/carrinho.php';
      include_once ('php/models/cliente/servicos.cliente.model.php');    
      include_once 'views/cliente.page.tpl.php';
    });




  
    $app->get('/servicos-disponiveis', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/servicos-detalhes/:idservico', function ($idservico) {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos-detalhe.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/servicos-contratados', function () {

      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/servicos-contratados.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/minhas-faturas', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/minhas-faturas.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/pagar-fatura/:codfatura', function ($codfatura) {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
            
      $incBody = RESTRITA_CLIENTE . 'paginas/pagar-fatura.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/meus-arquivos', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/meus-arquivos.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/mensagens', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/mensagens.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-chat', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-chat.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-videochat', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-videochat.php';    
      include_once 'views/cliente.page.tpl.php';
    });
  
    $app->get('/suporte-ticket', function () {
      
      App::chkPerm(decode( sessionVar('_uL') ),'cliente');
      
      $incBody = RESTRITA_CLIENTE . 'paginas/suporte-ticket.php';    
      include_once 'views/cliente.page.tpl.php';
    });



?>
