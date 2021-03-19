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
