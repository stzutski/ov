<?php 
use \db\Sql;
use \db\ProcSql;
use admin\servicos\Servicos;

if(postVar('do')=='saveFase'){//caso seja operacao de insercao ou alteracao
  
  if(isSet($_POST)){//recebe dados

    $res = Servicos::saveFase();
    
    if($res>0){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      $app->redirect(URLAPP .'cat-servicos/' . postVar('uid'));
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
    
    //lista ETAPAS da FASE selecionada
    $lista_etapaFase    = Servicos::getListEtapas($idFase);
    
  }

}

?>
