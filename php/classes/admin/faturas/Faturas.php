<?php 

namespace admin\faturas;

use \db\Sql;
use \db\ProcSql;


class Faturas extends ProcSql {
  

  //retorna lista de FATURAS DA EMPRESA
  public static function listaFaturas($idempresa=''){
      if($idempresa!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM faturas
                            WHERE id_empresa = :id_empresa',array(':id_empresa'=>$idempresa));
        if(count($res)>0){
          return $res;
        }else{
          return 0;
        }
      }else{
        return false;
      }
  }

  //retorna dados da FATURA
  public static function dadosFatura($idfatura=''){
      if($idfatura!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM faturas
                            WHERE id_fatura = :id_fatura',array(':id_fatura'=>$idfatura));
        if(count($res)>0){
          return $res;
        }else{
          return 0;
        }
      }else{
        return false;
      }
  }
  
  
}



?>
