<?php 
use \db\Sql;
use \db\ProcSql;
use \db\Dbi;
use admin\servicos\Servicos;

  $_servicos      = new Servicos();
  $_dbi           = new Dbi();
  $dbi_serv       = $_dbi->dbi_servicos();
  logsys("array servicos: ".json_encode($dbi_serv));
  
  $listaServicos  = $_servicos->getListServices();

  $titulo_servicos = 'eita';









?>
