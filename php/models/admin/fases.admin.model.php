<?php 
use \db\Sql;
use \db\ProcSql;
use admin\servicos\Servicos;

$arr_servicos       = Servicos::formSelectServicos();




if(postVar('do')=='saveFase'){//caso seja operacao de insercao ou alteracao
  if(isSet($_POST)){//recebe dados
    $res = Servicos::saveFase( postVar('uid') );
    if(!is_array($res)){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      if(postVar('bkt')!=''){$backTo = postVar('bkt').postVar('id_servico');}else{$backTo = URLAPP;}
      $app->redirect(URLAPP . $backTo );
    }    
  }
}



elseif(postVar('do')=='saveCat'){
  if(isSet($_POST)){//recebe dados
    $res = Servicos::saveCat();
    if(!is_array($res)){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      if(postVar('bkt')!=''){$backTo = postVar('bkt');}else{$backTo = URLAPP;}
      $app->redirect(URLAPP . $backTo);
    }    
  }  
}



else
{
  
  //caso nenhum fase selecionada então lista todas
  if(!isSet($idServico)){
    
    //primeiro listamos todas os servicos da empresa para depois o admin selecionar qual servico quer administrar
    $lista_srv_empresa  = Servicos::getListServices();
    
  }
  if(!isSet($idFase)&&isSet($idServico)&&$idServico!=''){//caso servico selecionado lista fases do servico
    
    //obter dados do servico selecionado
    $_data_srv = Servicos::getService($idServico);  
    
    //lista de fases do servico selecionado
    $lista_srv_empresa  = Servicos::listaFasesById($idServico);
    
  }
  if(isSet($idFase)&&$idFase>0){//caso fase selecionada retorna dados da fase

    
    $faseData           = Servicos::getFase($idFase);
    //$arr_fases          = Servicos::listaFasesById($faseData[0]['id_servico']);
    //$ar_fases           = mkSelFDB($arr_fases,array('indice'=>'id_fase','coluna'=>'nome_fase'));
    
    //lista ETAPAS da FASE selecionada
    $lista_etapaFase    = Servicos::getListEtapas($idFase);
    
    //ARRAY DATA PARA COMBO DOS SERVICOS
    $arr_servicos       = Servicos::formSelectServicos();
    
  }

}

?>
