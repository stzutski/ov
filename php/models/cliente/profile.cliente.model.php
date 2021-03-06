<?php 
//rotinas para o perfil do cliente ex: view, update
use \db\Sql;
use \db\ProcSql;
use cliente\usuarios\Usuarios;


  $profile      = new Usuarios();
  $dataProfile  = $profile->getUserCli(decode( sessionVar('_iU') ),'user');

  




?>
