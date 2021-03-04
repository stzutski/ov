<?php 

namespace admin\servicos;

use \db\Sql;
use \db\ProcSql;


class Servicos extends ProcSql {
  

  //retorna lista de SERVICOS DA EMPRESA 
  public static function getService($idservico=''){
      if($idservico!=''){
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM servicos 
                            WHERE id_servico = :id_servico
                            AND id_empresa = :id_empresa',array(':id_servico'=> $idservico,':id_empresa'=> UIDEMPRESA ));
        if(count($res)>0){
          return $res;
        }else{
          return 0;
        }
      }else{
        return false;  
      }
  }

  //retorna lista de SERVICOS DA EMPRESA 
  public static function getListServices(){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos WHERE id_empresa = :id_empresa',array(':id_empresa'=> UIDEMPRESA ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //@@@@@@@@@@@ retorna lista de SERVICOS DA EMPRESA 
  public static function listaServicos(){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos WHERE id_empresa = :id_empresa',array(':id_empresa'=> UIDEMPRESA ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //@@@@@@@@@@@ retorna lista de FASES DE SERVICOS DA EMPRESA 
  public static function listaFases(){
      $sql = new Sql();
      $res = $sql->select('SELECT a.id_servico,b.id_fase,b.nome_fase,b.desc_fase,b.prazo_fase,b.zorder_fase,b.status_fase FROM 
                          servicos as a, servicos_fases as b 
                          WHERE a.id_empresa = :id_empresa
                          AND a.id_servico = b.id_servico
                          ORDER BY b.zorder_fase ASC',array(':id_empresa'=> UIDEMPRESA ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //@@@@@@@@@@@ retorna lista de ETAPAS DAS FASES DE SERVICOS DA EMPRESA 
  public static function listaEtapas(){
      $sql = new Sql();
      $res = $sql->select('SELECT a.id_servico,c.id_etapa,c.id_fase,c.nome_etapa,c.tipo_etapa,c.desc_etapa,c.zorder_etapa,c.status_etapa 
                          FROM servicos as a, servicos_fases as b, servicos_fases_etapas as c 
                          WHERE a.id_empresa  = :id_empresa
                          AND   a.id_servico  = b.id_servico
                          AND   b.id_fase     = c.id_fase
                          ORDER BY c.zorder_etapa ASC',array(':id_empresa'=> UIDEMPRESA ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }


  //retorna lista de FASES CADASTRADAS PARA A EMPRESA
  public static function getListFases($idservico=''){
      
      /*
       * SE SERVICO ($idservico) FOR INFORMADO ENTAO RETORNA TODAS AS FASES DESSE SERVICO
       * CASO CONTRARIO ENTAO: BUSCA POR TODOS O SERVICOS DA EMPRESA E LOCALIZA SUAS FASES
       * */
      
      //CONFIGURAR A QUERY:: CASO ID FOR INFORMADO!
      if($idservico!=''){
        
        //COM BASE NO SERVICO INDICADO (ID_SERVICO) IREMOS LOCALIZAR AS (FASES) E ENTAO RETORNAR
        $query  = 'SELECT * FROM servicos as a, servicos_fases as b 
                  WHERE a.id_servico  = :id_servico
                  AND   a.id_empresa  = :id_empresa
                  AND   a.id_servico  = b.id_servico';
                  
        $prepare= array(':id_servico'=>$idservico,':id_empresa'=> UIDEMPRESA );
      }
      
      
      //CONFIGURAR A QUERY:: CASO ID SERVICO ***NÃO*** FOR INFORMADO!    
      if($idservico==''){    
        
        $sqlFases = new Sql();
        $arrDet   = array();
        
        //lista servicos da empresa
        $srv_empresa = $sqlFases->select( 'SELECT * FROM servicos WHERE id_empresa = :id_empresa' ,array(':id_empresa'=> UIDEMPRESA ));
        $resTeste='';
        if(count($srv_empresa)>0){
          
          for ($i = 0; $i < count($srv_empresa); $i++)
          {
            $dadosServico = $srv_empresa[$i];
            //$resTeste .= "$dadosServico[nome_servico]<br />";
            $arrDet[]     = $dadosServico;
            logsys("IDDOSERVICO: ".$dadosServico['id_servico']);
            $srv_fases = $sqlFases->select( 'SELECT nome_fase FROM servicos_fases WHERE id_servico = :id_servico' ,array(':id_servico'=> $dadosServico['id_servico'] ));
            if(count($srv_fases)>0){
              array_push($arrDet, $srv_fases);
            }
            //$arrDet[] = $dadosServico;
            
            
            
          }
        
        }
    
        return $arrDet;
      }
  }

  //retorna lista de SERVICOS DA EMPRESA 
  public static function getListEtapas($idfase=''){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos_fases_etapas WHERE id_fase = :id_fase',array(':id_fase'=> $idfase ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }
  
  
}


?>
