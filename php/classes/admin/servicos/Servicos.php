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
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT a.id_servico,b.id_fase,b.nome_fase,b.desc_fase,b.prazo_fase,b.zorder_fase,b.status_fase FROM 
                          servicos as a, servicos_fases as b 
                          WHERE a.id_empresa = :id_empresa
                          AND a.id_servico = b.id_servico
                          ORDER BY b.zorder_fase ASC',array(':id_empresa'=> $id_empresa ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //@@@@@@@@@@@ retorna lista de FASES DE SERVICOS DA EMPRESA 
  public static function listaFasesById($idServico){
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT a.id_servico,b.id_fase,b.nome_fase,b.desc_fase,b.prazo_fase,b.zorder_fase,b.status_fase FROM 
                          servicos as a, servicos_fases as b 
                          WHERE a.id_empresa = :id_empresa
                          AND a.id_servico = :id_servico
                          AND a.id_servico = b.id_servico
                          ORDER BY b.zorder_fase ASC',array(':id_empresa'=> $id_empresa, ':id_servico'=> $idServico));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //ATUALIZA A ORDEM DE UMA FASE DO SERVICO
  public static function updFaseServico($idFase='',$idSrv='',$zOrder=''){
    if($idFase!='' && $idSrv!='' && $zOrder!=''){
      
      $sql = new Sql();
      $upd = $sql->query('UPDATE servicos_fases SET
                        zorder_fase = :z_order
                        WHERE id_servico = :id_servico
                        AND id_fase = :id_fase',array(
                        ':z_order'=>$zOrder,
                        ':id_servico'=>$idSrv,
                        ':id_fase'=>$idFase));
    }
    
  }

  //ATUALIZA A ORDEM DE UMA FASE DO SERVICO
  public static function updEtapaServico($idEtapa='',$idFse='',$zOrder=''){
    if($idEtapa!='' && $idFse!='' && $zOrder!=''){
      
      $sql = new Sql();
      $upd = $sql->query('UPDATE servicos_fases_etapas SET
                        zorder_etapa = :z_order
                        WHERE id_fase = :id_fase
                        AND id_etapa = :id_etapa',array(
                        ':z_order'=>$zOrder,
                        ':id_fase'=>$idFse,
                        ':id_etapa'=>$idEtapa));
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
        $id_empresa = decode( sessionVar('_iE') );
        
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

  //retorna DETALHES DA FASE SELECIONADA (idFase)
  public static function getFase($idFase=''){
    if($idFase!=''){
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos_fases 
                          WHERE id_fase       = :id_fase
                          AND id_empresa  = :id_empresa',array(
                          ':id_empresa'=> $id_empresa, ':id_fase'=>$idFase ));
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
  public static function getListEtapas($idfase=''){
  /*
  id_etapa
  id_fase
  id_empresa
  tipo_etapa
  nome_etapa
  desc_etapa
  zorder_etapa
  status_etapa 
  */    
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos_fases_etapas 
                          WHERE id_fase = :id_fase
                          AND id_empresa = :id_empresa ORDER BY zorder_etapa ASC',array(
                          ':id_fase'=> $idfase, 
                          ':id_empresa'=> $id_empresa 
                          ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //retorna CATEGORIAS DE SERVICOS DA EMPRESA 
  public static function getCatServicos(){
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos_categorias 
                          WHERE id_empresa = :id_empresa',array(':id_empresa'=> $id_empresa ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }

  //retorna DETALHES DA CATEGORIA SELECIONADA (idCategoria)
  public static function getCatData($idCategoria=''){
    if($idCategoria!=''){
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos_categorias 
                          WHERE id_empresa = :id_empresa
                          AND id_categoria = :id_categoria',array(':id_empresa'=> $id_empresa, ':id_categoria'=>$idCategoria ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
    }else{
      return false;
    }
  }
  
  //@@@@@@@@@@@ lista de SERVICOS POR CATEGORIA 
  public static function servByCats($idCategoria=''){
    if($idCategoria!=''){
      $id_empresa = decode( sessionVar('_iE') );
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos 
                          WHERE id_empresa = :id_empresa
                          AND id_categoria = :id_categoria',array(':id_empresa'=> $id_empresa, ':id_categoria'=> $idCategoria ));
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
  public static function getListFasess(){
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM servicos WHERE id_empresa = :id_empresa',array(':id_empresa'=> UIDEMPRESA ));
      if(count($res)>0){
        return $res;
      }else{
        return 0;
      }
  }  

  //funcao para CADASTRO OU ALTERACAO DE FASES do servico
  public static function saveFase(){
    
    $res = false;
    logsys("DADOS PARA SALVAR NA FASE:::" . json_encode($_POST));

    $sql  = new Sql();
    if($uid==''){//caso ID FASE não informado entao e um cadastro
    logsys("INICIANDO INSERCAO DE NOVOS DADOS....");
    
    $res  = $sql->query('INSERT INTO servicos_fases (
                        id_servico,id_empresa,nome_fase,desc_fase,prazo_fase,status_fase
                        ) VALUES (
                        :id_servico,:id_empresa,:nome_fase,:desc_fase,:prazo_fase,:status_fase)',
                        array(
                        ':id_servico'  =>  postVar('uidServico'),
                        ':id_empresa'  =>  decode( sessionVar('_iE') ), 
                        ':nome_fase'   =>  postVar('nomeFase'),  
                        ':desc_fase'   =>  postVar('descFase'),  
                        ':prazo_fase'  =>  postVar('prazoFase'), 
                        ':status_fase' =>  postVar('statsFase')));
    }
    
    
    if($uid!=''){//caso ID FASE INFORMADO entao e uma atualizacao de cadastro
    logsys("INICIANDO ALTERACAO DO CADASTRO IDFASE(".postVar('uid').")....");
    
    $res  = $sql->query('UPDATE servicos_fases SET
                      id_servico=:id_servico,id_empresa=:id_empresa,nome_fase=:nome_fase,
                      desc_fase=:desc_fase,prazo_fase=:prazo_fase,status_fase=:status_fase
                      WHERE id_fase=:id_fase',array(
                                    ':id_fase'    =>  postVar('uid'),
                                    ':id_servico' =>  postVar('uidServico'),
                                    ':id_empresa' =>  decode( sessionVar('_iE') ), 
                                    ':nome_fase'  =>  postVar('nomeFase'),  
                                    ':desc_fase'  =>  postVar('descFase'),  
                                    ':prazo_fase' =>  postVar('prazoFase'), 
                                    ':status_fase'=>  postVar('statsFase')));
    }
    
    return $res; 
  }



  
  
}


?>
