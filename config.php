<?php 
//REGISTRA SESSAO
session_start();

//CONFIGURACOES GLOBAIS
define('URLAPP','http://localhost/labs/ov/');
define('UIDEMPRESA',1);//ID PROVISORIO DA EMPRESA
define('UIDUSER',1);//ID PROVISORIO DO USUARIO
define('MAILSUPORTE','suporte@obavisto.com.br');
//define('MAILFROM','obv2@actoweb.com.br');
define('MAILFROM','website.demonstracao@gmail.com');
define('LOGOMAIL','https://obavisto2.actoweb.com.br/assets/images/logo/logo-login.png');

if(isSet($_GET['u'])&&$_GET['u']=='logout'){
    session_destroy();
    session_start();
    header('Location:'.URLAPP);
}


//FUNCOES DO APP
require_once('php/functions/functions.php');
require_once('php/functions/functions.html.php');

if(!isSet($_SESSION['_uL'])){
    $_SESSION['_uL']='';
    header('location:'.URLAPP . '/logout');
    logsys('redir configurado');
    exit;
}





?>
