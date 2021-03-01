<?php 
//REGISTRA SESSAO
session_start();

//CONFIGURACOES GLOBAIS
define('URLAPP','http://localhost/labs/ov/');

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
