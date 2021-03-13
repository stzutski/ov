<?php 

namespace admin\usuarios;

use \db\Sql;
use \db\ProcSql;


class Usuarios extends ProcSql {
  
  //retorna lista de USUARIOS/CLIENTES 
  public static function getListUserCli(){
    
    $sql = new Sql();
    $res = $sql->select('SELECT 
                        a.id_usuario,
                        a.email_usuario,
                        a.telefone_usuario,
                        a.permissao_usuario,
                        a.lst_login_usuario,
                        a.status_usuario,
                        b.id_cliente,
                        b.id_usuario,
                        b.id_empresa,
                        b.cad_dependente,
                        b.id_cliente_resp,
                        b.nome_cliente,
                        b.sobrenome_cliente,
                        b.cpf_cliente,
                        b.uf_cliente,
                        b.cidade_cliente,
                        b.dt_cliente,
                        b.status_cliente,
                        c.id_cidade,
                        c.nome_cidade    
                        FROM usuarios AS a, clientes AS b, tb_cidades AS c
                        WHERE a.id_usuario = b.id_usuario
                        AND b.cidade_cliente = c.id_cidade');
    return $res;
  
  }
  
  
  //metodo :: retorna todos os cad dependentes do (id_cliente)
  public static function getDependentes($id_cliente=''){
    $res = array();
    if($id_cliente!=''){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM 
                          clientes AS a,
                          tb_cidades AS b 
                          WHERE id_cliente_resp = :id_cliente_resp
                          AND a.cidade_cliente = b.id_cidade',array(':id_cliente_resp'=>$id_cliente));
      if(count($res)>0){
        return $res;
      }
    }else{
    return $res;
    }
  }
  
  //metodo :: retorna endereco do (id_cliente)
  public static function getEndereco($id_cliente=''){
    $res = array();
    if($id_cliente!=''){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM 
                          clientes_enderecos AS a,
                          tb_cidades AS b 
                          WHERE id_cliente = :id_cliente
                          AND a.cidade_endereco_cliente = b.id_cidade',array(':id_cliente'=>$id_cliente));
      if(count($res)>0){
        return $res;
      }
    }else{
    return $res;
    }
  }
  
  
  
  //retorna dados de um USUARIO/CLIENTE selecionado
  public static function getUserCli($uid='',$type='user'){
    if($uid!=''){
    $sql = new Sql();
    if($type=='user') {$query=' AND a.id_usuario = :uid';}
    if($type=='cli')  {$query=' AND a.id_cliente = :uid';}
    $res = $sql->select('SELECT * FROM 
                        usuarios AS a, clientes AS b, tb_cidades AS c
                        WHERE a.id_usuario = b.id_usuario
                        AND b.cidade_cliente = c.id_cidade'.$query,array(':uid'=>$uid));
      return $res; 
    
    }else{
    
      return false;  
    
    }   
    
  }
  
  
  //retorna dados de um USUARIO/CLIENTE selecionado
  public static function getPedidos($idUsuario=''){
    if($idUsuario!=''){
    $sql        = new Sql();
    $res        = $sql->select('SELECT * FROM pedidos WHERE id_usuario = :id_usuario',array(':id_usuario'=>$idUsuario));
    $tot_pedidos= 0;
    $vlr_aberto = 0;
    $vlr_pagos  = 0;
    $dataRes=array();
    //total de pedidos realizados
    $tot_pedidos = count($res);
          
      if(count($res)>0){
        for ($i = 0; $i < count($res); $i++)
        {
          $pedData = $res[$i];
          
          //pedidos em aberto
          $pa = $sql->select('SELECT SUM(precototal_item) AS total FROM pedidos_itens 
                              WHERE id_pedido = :id_pedido
                              AND status_pedido_item = 0',array(':id_pedido'=>$pedData['id_pedido']));
          $vlr_aberto =  $vlr_aberto+$pa[0]['total'];  
          
          //pedidos pagos
          $pp = $sql->select('SELECT SUM(precototal_item) AS total FROM pedidos_itens 
                              WHERE id_pedido = :id_pedido
                              AND status_pedido_item = 1',array(':id_pedido'=>$pedData['id_pedido']));
          $vlr_pagos =  $vlr_pagos+$pp[0]['total'];
        }
      }
      
      $dataRes['totalDePedidos'] = $tot_pedidos;
      $dataRes['totalEmAberto'] = $vlr_aberto;
      $dataRes['totalRecebido'] = $vlr_pagos;
      
      return $dataRes;
    }else{
      return false;  
    }   
  }
  
  
  



  //retorna a lista de itens do pedido de um ID USUARIO
  public static function getItensPedido($idUsuario){
    if($idUsuario!=''){
      $sql    = new Sql();
      $arServ = array();//array com os dados de servicos
      
      $resSrv = $sql->select('SELECT * FROM servicos WHERE status_servico = 1');
      if(count($resSrv)>0){
        for ($i = 0; $i < count($resSrv); $i++)
        {
          $servico  = $resSrv[$i];
          $uidSrv   = $servico['id_servico'];
          $arServ[$uidSrv]['id_servico']         = $servico['id_servico'];
          $arServ[$uidSrv]['nome_servico']       = $servico['nome_servico'];
          $arServ[$uidSrv]['modalidade_servico'] = $servico['modalidade_servico'];           
        }
      }
      
      //lista os pedidos do usuario
      $lstPuser = $sql->select('SELECT * FROM pedidos WHERE id_usuario = :id_usuario',array(':id_usuario'=>$idUsuario));
      
      if(count($lstPuser)>0){
      
        $groupIdItem=array();
        //loop pedidos do usuario
        for ($p = 0; $p < count($lstPuser); $p++)
        {
          $dtPed      = $lstPuser[$p];
          $uid_pedido = $dtPed['id_pedido'];
          
          $itensPedido= $sql->select('SELECT * FROM pedidos_itens WHERE id_pedido = :id_pedido',array(':id_pedido'=>$uid_pedido));
          
          if(count($itensPedido)>0){
            for ($n = 0; $n < count($itensPedido); $n++)
            {
              $itp      = $itensPedido[$n];
              $idDoSrv  = $itp['id_item'];
              $groupIdItem[$idDoSrv]['qtd']                 = $groupIdItem[$idDoSrv]['qtd']+1;
              $groupIdItem[$idDoSrv]['id_servico']          = $arServ[$idDoSrv]['id_servico'];
              $groupIdItem[$idDoSrv]['nome_servico']        = $arServ[$idDoSrv]['nome_servico'];
              $groupIdItem[$idDoSrv]['modalidade_servico']  = $arServ[$idDoSrv]['modalidade_servico'];
            }
          }
        }
        
      }
    
      if(count($groupIdItem)>0){
        return $groupIdItem;
      }else{
        return false;
      }
    
    }else{
    
      return false;  
    
    }   
    
  }


  
  
}

?>
