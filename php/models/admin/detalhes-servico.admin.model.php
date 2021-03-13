<?php 
use \db\Sql;
use \db\ProcSql;
use \db\Dbi;
use admin\servicos\Servicos;


if(isSet($idServico)){
  
  $servicos       = new Servicos();
  $listaServicos  = $servicos->getService($idServico);
  
}


?>
