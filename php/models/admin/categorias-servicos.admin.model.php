<?php 
use \db\Sql;
use \db\ProcSql;
use \db\Dbi;
use admin\servicos\Servicos;


if(!isSet($idCategoria)){

    $servicos = new Servicos();
    $cats     = $servicos->getCatServicos();
  
}elseif(isSet($idCategoria) && $idCategoria!=''){
    
    $servicos = new Servicos();
    $catData  = $servicos->getCatData($idCategoria);
    $srvCats  = $servicos->servByCats($idCategoria);
  
}



?>
