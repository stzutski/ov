<?php
/*
 * ESTA CLASSE DEVE ou DEVERIA SER UM ATALHO PARA A MAIORIA DAS FUNCOES
 * DE UM CRUD DEVE CONSEGUIR TRABALHAR COM QUASE TODAS AS TABELAS PARA
 * ACOES DE CADASTRO, UPDATE E LISTAGEM
 * */

namespace db;

use db\Sql;
use db\Model;

class ProcSql extends Model {


    public function save($campos=array(),$table='',$uid=array()){
    //ex: ADD CADASTRO: save($campos,'clientes')
    //ex: UPDATE CADASTRO: save($campos,'clientes',array('id_cliente',123))

		$sql = new Sql();
		$res = false;
		$strQuery   = $this->queryBuilder($campos);
		$columns    = arrayVar($strQuery,'columns');
		$values     = arrayVar($strQuery,'values');
		$update     = arrayVar($strQuery,'update');
		$bindValues = arrayVar($strQuery,'bindArray');

  		if(count($uid)==0)
  		{
        //add novo cadastro
        $queryStr = "INSERT INTO $table ( $columns ) VALUES ( $values )";
  			$res = $sql->query($queryStr,$bindValues);
  		}
  		if(count($uid)>0)
  		{
        $columnId                   = $uid[0];
        $_uid                       = $uid[1];
        $bindValues[":$columnId"]   = $_uid;
        //atualiza cadastro
  			$queryStr                   = "UPDATE $table SET$update WHERE $columnId = :$columnId";
        $res = $sql->query($queryStr,$bindValues);
  		}
      return $res;

    }

    //deleteById('usuarios',array('id_usuario',123))
    public function deleteById($table='',$args=array()){
		$sql = new Sql();
		$res = 'false';
		if($table!='' && count($args)>0 ){
			$column     = $args[0];
			$uidReg     = $args[1];
			$queryStr   = "DELETE FROM $table WHERE $column = :$column";
			$bindValues = array(":$column"=>$uidReg);

			$res = $sql->query($queryStr,array(
			  ":$column"=>$uidReg
			));
		}
		return $res;
    }

    //getItemById('',array('id_usuario',123))
    public function getItemById($table='',$args=array()) {
		$sql = new Sql();
		$res = false;
		if($table!='' && count($args)>0 ){
			$column     = $args[0];
			$uidReg     = $args[1];
			$queryStr   = "SELECT * FROM $table WHERE $column = :$column";
			$bindValues = array(":$column"=>$uidReg);

			$res = $sql->select($queryStr,array(
			  ":$column"=>$uidReg
			));

		}
		return $res;
    }

    //getList('usuarios',' ORDER BY id_usuario')
    public static function getList($table='',$orderBy='') {
    	$sql = new Sql();
    	$res = false;
    	if($table!=''){
        $queryStr   = "SELECT * FROM $table $orderBy";
        $res = $sql->select($queryStr);
    	}
    	return $res;
    }

    //getList('usuarios',' ORDER BY id_usuario')
    public static function listaDados($table='',$exp='',$args=array()) {
    	$sql = new Sql();
    	$res = false;
    	if($table!=''){
        $queryStr   = "SELECT * FROM $table $exp";
        $res = $sql->select($queryStr,$args);
    	}
    	return $res;
    }



}
