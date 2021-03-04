<?php 

namespace cliente\servicos;

use \db\Sql;
use \db\ProcSql;


class Servicos extends ProcSql {
  

  //retorna lista de SERVICOS DA EMPRESA 
  public static function getListServices(){
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM servicos');
    return $res;
  }

  //retorna DADOS DA CATEGORIA SELECIONADA
  public static function dadosCategoria($idCategoriaServico){
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM servicos_categorias WHERE id_categoria = :id_categoria',array(':id_categoria'=>$idCategoriaServico));
    return $res;
  }


  //retorna lista de SERVICOS DA EMPRESA 
  public static function servicosCategoria($idCategoriaServico){
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM servicos WHERE id_categoria = :id_categoria',array(':id_categoria'=>$idCategoriaServico));
    return $res;
  }
  
  
}



?>
