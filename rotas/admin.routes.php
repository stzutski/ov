<?php   
    use app\App;
    define('RESTRITA_ADMIN','views/area-restrita/admin/');
    
    //TELA INICIAL DO USUARIO ADMINISTRADOR
    $app->get('/', function () {
      $incBody = RESTRITA_ADMIN . 'telas/dashboard.php';    
      include 'views/cliente.page.tpl.php';
    });
      
    //ADMINISTRACAO DAS REGRAS DO NEGOCIO
    $app->get('/adm-servicos/:moduloregra', function ($moduloregra) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/adm-servicos.php';    
      include 'views/admin.page.tpl.php';
    });
      
    //FORM UPD DADOS DO ADMINISTRADOR
    $app->get('/perfil-admin', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'forms/perfil.form.php';    
      include 'views/admin.page.tpl.php';
    });
      
    //LISTA DE CLIENTES DO ADMIN
    $app->get('/clientes', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/lista-clientes.php';    
      include ('php/models/admin/clientes.admin.model.php');
      include 'views/admin.page.tpl.php';
    });
      
    //FORM DETALHES DO CLIENTE DO ADMIN
    $app->get('/detalhes-cliente', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/det-cli.php';  
      //$incBody = RESTRITA_ADMIN . 'paginas/detalhes-cliente.php';  
      include ('php/models/admin/clientes.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //LISTA DE SERVICOS DO ADMIN
    $app->get('/servicos', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/servicos.php';  
      include ('php/models/admin/servicos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
          
    //EXIBE DETALHES DO SERVICO SELECIONADO
    $app->get('/detalhes-servico/:idServico', function ($idServico) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhes-servicos.php';  
      include ('php/models/admin/detalhes-servico.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //ADICIONAR NOVO SERVICO A UMA CATEGORIA
    $app->get('/add-servico/categoria/:idCategoria', function ($idCategoria) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'forms/form-addServCat.admin.php';  
      include ('php/models/admin/detalhes-servico.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
          
    //EXIBE DADOS DE UMA CATEGORIA SELECIONADA
    $app->get('/cat-servicos/:idCategoria', function ($idCategoria) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/categorias-servicos.php';  
      include ('php/models/admin/categorias-servicos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });


    //PAGINA PARA TESTES DIVERSOS
    $app->get('/sandbox', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/sandbox.php';  
      include ('php/models/admin/ficha.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });

    //LISTA DAS CATEGORIAS DE SERVICOS DO ADMIN
    $app->get('/cat-servicos', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/categorias-servicos.php';  
      include ('php/models/admin/categorias-servicos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });


    //CONFIGURAR FASES DO SERVICO
    $app->get('/adm-fases-servico/servico/:idServico', function ($idServico) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/adm-fases-servico.php';  
      include ('php/models/admin/fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });

    //adicionar nova FASE ao SERVICO
    $app->get('/add-fases-servico/servico/:idServico', function ($idServico) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      // REMOVER $incBody = RESTRITA_ADMIN . 'paginas/add-fases-servico.php';  
      $incBody = RESTRITA_ADMIN . 'forms/form-add-fase-servico.php';  
      include ('php/models/admin/fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });    
    //adicionar nova ETAPA para FASE do SERVICO
    $app->get('/add-etapa-fase/fase/:idFase', function ($idFase) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      // REMOVER $incBody = RESTRITA_ADMIN . 'paginas/add-etapas-servico.php';  
      $incBody = RESTRITA_ADMIN . 'forms/form-add-etapa-fase.php';  
      include ('php/models/admin/fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });    


    $app->get('/adm-fases-servico/fase/:idFase', function ($idFase) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/adm-fases-servico.php';  
      include ('php/models/admin/fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
    
    //FORM ALTERAR ETAPA CADASTRADA
    $app->get('/adm-fases-servico/etapa/:idEtapa', function ($idEtapa) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/adm-fases-servico.php';  
      include ('php/models/admin/etapas.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
    
    
    $app->get('/adm-fases-servico', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/adm-fases-servico.php';  
      include ('php/models/admin/fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });

      
    //LISTA FASES DO SERVICO
    $app->get('/fases-do-servico', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/servicos-fases.php';  
      include ('php/models/admin/servicos-fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
    
    $app->get('/fases-do-servico/:idservico', function ($idservico) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/servicos-fases.php';  
      include ('php/models/admin/servicos-fases.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
    //////////////////////////////////////////////////////////////////
    
    
      
    //LISTA ETAPAS DA FASE DO SERVICO
    $app->get('/etapas/fase/:idfase', function ($idfase) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/servicos-etapas.php';  
      include ('php/models/admin/servicos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //LISTA DE FATURAS DO ADMIN
    $app->get('/pedidos', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/pedidos-admin.php';  
      include ('php/models/admin/pedidos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //LISTA DE FATURAS DO ADMIN
    $app->get('/detalhes-pedido/:idpedido', function ($idpedido) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhes-pedido.php';  
      include ('php/models/admin/pedidos.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //LISTA DE FATURAS DO ADMIN
    $app->get('/faturas', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/faturas-admin.php';  
      include ('php/models/admin/faturas.admin.model.php');  
      include 'views/admin.page.tpl.php';
    });
      
    //DETALHES DE UMA FATURA DO ADMIN
    $app->get('/detalhe-fatura/:idfatura', function ($idfatura) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhe-faturas.php';   
      include ('php/models/admin/faturas.admin.model.php'); 
      include 'views/admin.page.tpl.php';
    });
      
    //FLUXO DE CAIXA DO ADMIN (ENTRADAS)
    $app->get('/lancamentos', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/lancamentos.php';
      include ('php/models/admin/lancamentos.admin.model.php');    
      include 'views/admin.page.tpl.php';
    });
      
    //FLUXO DE CAIXA DO ADMIN (ENTRADAS)
    $app->get('/detalhes-lancamento/:idlancamento', function ($idlancamento) {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/detalhes-lancamento.php';
      include ('php/models/admin/lancamentos.admin.model.php');    
      include 'views/admin.page.tpl.php';
    });

    //CAIXA DE ENTRADA DE MSGs RECEBIDAS E ENVIDAS DO ADMIN
    $app->get('/mensagens', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/mensagens.php';    
      include 'views/admin.page.tpl.php';
    });
      
    //CENTRAL DE TICKET DE SUPORTES DO ADMIN
    $app->get('/tickets-suporte', function () {
      App::chkPerm(decode( sessionVar('_uL') ),'admin');
      $incBody = RESTRITA_ADMIN . 'paginas/suporte-ticket.php';    
      include 'views/admin.page.tpl.php';
    });



?>
