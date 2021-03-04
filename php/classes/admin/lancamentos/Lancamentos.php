<?php 

namespace admin\lancamentos;

use \db\Sql;
use \db\ProcSql;


class Lancamentos extends ProcSql {
  

  //retorna lista de LANÇAMENTOS DA EMPRESA
  public static function listaLancamentos($idempresa=''){
      if($idempresa!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM lancamentos
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
  public static function dadosLancamento($idlancamento=''){
      if($idlancamento!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM 
                            lancamentos as a, faturas as b
                            WHERE a.id_fatura = b.id_fatura
                            AND a.id_lancamento = :id_lancamento',array(':id_lancamento'=>$idlancamento));
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
