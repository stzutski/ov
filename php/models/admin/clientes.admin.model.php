<?php 
use \db\Sql;
use \db\ProcSql;

$legenda = '<h2>Legenda 2</h2>';

$sql = new Sql();

$lista = $sql->select('SELECT * FROM usuarios');

$lista_usuarios = json_encode($lista);

?>
