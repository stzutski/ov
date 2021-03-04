<?php 

namespace admin\usuarios;

use \db\Sql;
use \db\ProcSql;


class Usuarios extends ProcSql {
  
  //retorna lista de USUARIOS/CLIENTES 
  public static function getListUserCli(){
    
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM 
                        usuarios as a, clientes as b
                        WHERE a.id_usuario = b.id_usuario');
    return $res;
  
  }
  
  
  //retorna dados de um USUARIO/CLIENTE selecionado
  public static function getUserCli($uid='',$type='user'){
    if($uid!=''){
    $sql = new Sql();
    if($type=='user') {$query=' AND a.id_usuario = :uid';}
    if($type=='cli')  {$query=' AND a.id_cliente = :uid';}
    $res = $sql->select('SELECT * FROM 
                        usuarios as a, clientes as b
                        WHERE a.id_usuario = b.id_usuario'.$query,array(':uid'=>$uid));
      return $res; 
    
    }else{
    
      return false;  
    
    }   
    
  }
  
  
  
  
  
}

?>
