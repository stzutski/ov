<?php 
use \db\Sql;
use \db\ProcSql;
use admin\servicos\Servicos;

if(postVar('do')=='saveEtapa'){//caso seja operacao de insercao ou alteracao
  
  if(isSet($_POST)){//recebe dados
    
    $res = Servicos::saveEtapa( postVar('uid') );
    if(!is_array($res)){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      if(postVar('bkt')!=''){$backTo = postVar('bkt').postVar('id_fase');}else{$backTo = URLAPP;}
      $app->redirect(URLAPP . $backTo);
    }    
  }  

}
else
{
  
  //ID ETAPA INFORMADO E MAIOR QUE ZERO entao carrega os dados da etapa selecionada
  if(isSet($idEtapa)&&$idEtapa>0){
    
    //obter dados do etapa selecionada
    $dataEtapa  = Servicos::getEtapa($idEtapa);
    
    $arr_fases  = Servicos::listaFases();
    $ar_fases   = mkSelFDB($arr_fases,array('indice'=>'id_fase','coluna'=>'nome_fase'));
    
    
  }
  
}

?>
