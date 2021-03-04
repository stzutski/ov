<?php 

namespace admin\pedidos;

use \db\Sql;
use \db\ProcSql;


class Pedidos extends ProcSql {
  

  //retorna lista de PEDIDOS DA EMPRESA
  public static function listaPedidos($idempresa=''){
      if($idempresa!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM pedidos
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
  
  //retorna dados do PEDIDO
  public static function dadosPedido($idpedido='',$idempresa=''){
      if($idpedido!=''&&$idempresa!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT a.id_pedido, a.dt_pedido, b.razao_empresa, c.id_usuario, c.nome_usuario FROM 
                            pedidos as a,
                            empresas as b,
                            usuarios as c
                            WHERE
                            a.id_pedido = :id_pedido AND
                            a.id_empresa = :id_empresa AND
                            a.id_empresa = b.id_empresa AND
                            a.id_usuario = c.id_usuario ',array(':id_empresa'=>$idempresa,':id_pedido'=>$idpedido));
        if(count($res)>0){
          return $res;
        }else{
          return 0;
        }
      }else{
        return false;
      }
  }
  
  
  //retorna os itens do PEDIDO
  public static function itensPedido($idpedido=''){
      if($idpedido!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM 
                            pedidos_itens as a,
                            servicos as b
                            WHERE 
                            a.id_pedido = :id_pedido
                            AND a.id_item = b.id_servico',array(':id_pedido'=>$idpedido)); 
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
