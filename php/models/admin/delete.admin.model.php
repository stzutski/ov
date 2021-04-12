<?php 
use \db\Sql;
use \db\ProcSql;

//delete.admin.model.php


//REMOVE CATEGORIA DE SERVICO
if($tipoItem=='removeCatServ'&&$id2Remove!=''){
  
  
  $res = dbf('DELETE FROM servicos_categorias WHERE id_categoria = '.$id2Remove.'');
  
  logsys("status remocao catserv:: " . json_encode($res));
  
  if($res){
    if(postVar('bkt')!=''){
    $app->redirect(URLAPP .postVar('bkt'));
    }else{
    $app->redirect(URLAPP);
    }
  }
  else
  {
  $app->redirect(URLAPP . '?e=rem&i='.$tipoItem);   
  }
}

//###### ATUALIZADO - REMOCAO EM CASCATA COM CONFERECIA DE USO
//REMOVE SERVICO
if($tipoItem=='removeServ'&&$id2Remove!=''){
  
  $error=false;
  
  //CONSULTAMOS PARA VER SE O SERVICO EM QUESTÃO NÃO ESTA EM USO POR ALGUM PEDIDO
  $chk = dbf('SELECT * FROM pedidos_itens WHERE id_item = :id_item AND id_empresa = :id_empresa',
            array(':id_item'=>$id2Remove,':id_empresa'=>decode( sessionVar('_iE')) ),'num');
  
  if($chk>0){
      echo 'alert("Remoção não permitida pois: existem\npedidos associados a este serviço!");';
  }
  else
  {
    //caso remocao autorizada entao remove de tras para frente ( primeiro removendo as etapas > fases e por fim o servico )
    
    //pesquisamos as fases envolvidas no servico
    $get_fases = dbf('SELECT * FROM servicos_fases WHERE id_servico = :id_servico AND id_empresa = :id_empresa',
                    array(':id_servico'=>$id2Remove,':id_empresa'=>decode( sessionVar('_iE')) ),'fetch');
    
    if(is_array($get_fases)&&count($get_fases)>0){
      
      logsys("encontradas (".count($get_fases).") para remocao das suas etapas ref serv($id2Remove)");
      
      for ($f = 0; $f < count($get_fases); $f++)
      { $fase_data  = $get_fases[$f];
        $idFse      = $fase_data['id_fase'];
        
        logsys("preparando para remover etapas da fase($idFse) do servico($id2Remove)");
        
        $rem_etapa  = dbf('DELETE FROM servicos_fases_etapas WHERE id_fase = :id_fase AND id_empresa = :id_empresa',
                          array(':id_fase'=>$idFse,':id_empresa'=>decode(sessionVar('_iE'))));
        
        if($rem_etapa>0){
          logsys("removida ETAPA DA FASE($idFse) do servico($id2Remove)");
        }
        
      }
      
      logsys("preparando para remover a fase($idFse) do servico($id2Remove)");
      $rem_fase  = dbf('DELETE FROM servicos_fases WHERE id_servico = :id_servico AND id_empresa = :id_empresa',
                      array(':id_servico'=>$id2Remove,':id_empresa'=>decode( sessionVar('_iE'))));
      
      if($rem_fase>0){
          logsys("removido ($rem_fase) ( FASE($idFse) do SERVICO($id2Remove) )");

          logsys("preparando para remover o SERVICO($id2Remove)");
          $rem_fase  = dbf('DELETE FROM servicos WHERE id_servico = :id_servico AND id_empresa = :id_empresa',
                          array(':id_servico'=>$id2Remove,':id_empresa'=>decode( sessionVar('_iE')) ));
                          
          if($rem_fase>0){
          logsys("removido o SERVICO($id2Remove)");
          }
      }
      
      if($error==false){
        
         echo 'alert("O servico e suas fases e etapas\nforam removidos com sucesso!");';
         
      }
      
    }
    
  }
  
  $res = dbf('DELETE FROM servicos 
                    WHERE id_servico = :id_servico',array(':id_servico'=>$id2Remove));
  if($res){
    if(postVar('bkt')!=''){
    $app->redirect(URLAPP .postVar('bkt'));
    }else{
    $app->redirect(URLAPP);
    }
  }
  else
  {
  $app->redirect(URLAPP . '?e=rem&i='.$tipoItem);   
  }  
}





//REMOVE SERVICO
if($tipoItem=='removeServ'&&$id2Remove!=''){
  $res = dbf('DELETE FROM servicos 
                    WHERE id_servico = :id_servico',array(':id_servico'=>$id2Remove));
  if($res){
    if(postVar('bkt')!=''){
    $app->redirect(URLAPP .postVar('bkt'));
    }else{
    $app->redirect(URLAPP);
    }
  }
  else
  {
  $app->redirect(URLAPP . '?e=rem&i='.$tipoItem);   
  }  
}






//REMOVE ETAPA DA FASE
if($tipoItem=='removeEtapa'&&$id2Remove!=''){
  $res = dbf('DELETE FROM servicos_fases_etapas 
                    WHERE id_etapa = :id_etapa',array(':id_etapa'=>$id2Remove));
  if($res){
    if(postVar('bkt')!=''){
    $app->redirect(URLAPP .postVar('bkt'));
    }else{
    $app->redirect(URLAPP);
    }
  }
  else
  {
  $app->redirect(URLAPP . '?e=rem&i='.$tipoItem);   
  }
}


//REMOVE FASE DO SERVICO
if($tipoItem=='removeFase'&&$id2Remove!=''){
  $res = dbf('DELETE FROM servicos_fases 
                    WHERE id_fase = :id_fase',array(':id_fase'=>$id2Remove));
  if($res){
    if(postVar('bkt')!=''){
    $app->redirect(URLAPP .postVar('bkt'));
    }else{
    $app->redirect(URLAPP);
    }
  }
  else
  {
  $app->redirect(URLAPP . '?e=rem&i='.$tipoItem);   
  }  
}















?>
