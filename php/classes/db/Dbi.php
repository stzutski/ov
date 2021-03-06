<?php
/*
 * classe com metodos estaticos para retonar dados das tabelas do banco 
 * de dados em arrays que possuem o ID DO REGISTRO como sua chave 
 * primaria para os registros ex: $arr[(id_do_registro)] = DATA
 * */
namespace db;

use db\Sql;
use db\Model;

class Dbi {
  

  public static function dbi($query,$colId){
    $arr = array();
    $sql = new Sql();
    $res = $sql->select($query);
    if(count($res)>0){
      for ($i = 0; $i < count($res); $i++)
      {
        $dataRow=$res[$i];
        $id = $dataRow[$colId];
        $arr[$id] = $dataRow;
      }
    }
    return $arr;
  }

  public static function dbi_usuarios(){
    $res = self::dbi('SELECT * FROM usuarios','id_usuario');
    return $res;
  }

  public static function dbi_clientes(){
    $res = self::dbi('SELECT * FROM clientes','id_cliente');
    return $res;
  }

  public static function dbi_servicos(){
    $res = self::dbi('SELECT * FROM servicos','id_servico');
    return $res;
  }

  public static function dbi_servicos_categorias(){
    $res = self::dbi('SELECT * FROM servicos_categorias','id_categoria');
    return $res;
  }

  
  
  
}


?>
