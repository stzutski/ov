<?php 


//CONFIGURACOES GLOBAIS
define('URLAPP','http://localhost/labs/ov/');
define('UIDEMPRESA',1);//ID PROVISORIO DA EMPRESA
define('UIDUSER',1);//ID PROVISORIO DO USUARIO
define('MAILSUPORTE','suporte@obavisto.com.br');
//define('MAILFROM','obv2@actoweb.com.br');
define('MAILFROM','website.demonstracao@gmail.com');
define('LOGOMAIL','https://obavisto2.actoweb.com.br/assets/images/logo/logo-login.png');
define('ADMINVIEWS','views/area-restrita/admin/');
define('CLIENTEVIEWS','views/area-restrita/cliente/');
define('MASTERVIEWS','views/area-restrita/master/');

if(isSet($_GET['u'])&&$_GET['u']=='logout'){
    session_destroy();
    session_start();
    header('Location:'.URLAPP);
}


//FUNCOES DO APP
require_once('php/functions/functions.php');
require_once('php/functions/functions.email.php');
require_once('php/functions/functions.html.php');

if(!isSet($_SESSION['_uL'])){
    $_SESSION['_uL']='';
    header('location:'.URLAPP . '/logout');
    exit;
}





?>
