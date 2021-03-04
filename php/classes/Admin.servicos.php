<?php 

namespace classes;

use \db\Sql;
use \db\ProcSql;


class Usuarios extends ProcSql {
  

  //retorna lista de SERVICOS DA EMPRESA 
  public static function getListServices(){
    
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM 
                        servicos_empresas as a, servicos as b
                        WHERE a.id_empresa = b.id_empresa');
    return $res;
  
  }

  
  
  
}



?>
