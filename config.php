<?php 
session_start();

// funcao que carrega as classes automaticamente
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', "php/classes/$class.php"));
});





?>
