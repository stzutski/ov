<?php 
use \db\Sql;
use \db\ProcSql;
use admin\servicos\Servicos;

$lista_ul_fases='';

if(!isSet($idservico)){$idservico='';}



//SE O ID FOR INFORMADO
if($idservico!=''){
  
  $lst_serv_empresa = '';
  $dataService      = array();
  //dados do servico selecionado (ID SERVICO)
  $dataServ         = Servicos::getService($idservico);
  $dataService      = dbRet($dataServ);
  
  //fases do servico
  $lst_fases        = 'Nenhuma fase localizada';
  $fse_srv          = Servicos::getListFases($idservico);
  $dataFase         = dbRet($fse_srv);
  
  //MONTA TAG UL COM A LISTA DE FASES DO SERVICO SELECIONADO
  $lista_ul_fases   = listaForeach($dataFase,'LISTA-TMP');
  
  
  //CASO NENHUM SERVICO SELECIONADO ENTAO PRECISAMOS LISTAR 
  //TODAS AS FASES CADASTRADAS PARA ESTA EMPRESA
}else{
  
  //SUBTITULO DA PAGINA
  $dataService['nome_servico'] = 'Serviço Não informado!';
  
  $listar_fse_empresa = Servicos::getListFases();//LISTA TODAS AS FASES CADASTRADAS PARA ESTA EMPRESA
  
  $ttt = $listar_fse_empresa;
  
  //$lista_ul_fases     = listaForeach($listar_fse_empresa,'LISTA-TMP');
  if($lista_ul_fases==false){
    $lista_ul_fases = "<ul><li>Nada encontrado</li></ul>";
  }
  
  
}


$lst_servicos   = Servicos::listaServicos();
$lst_fases      = Servicos::listaFases();
$lst_etapas     = Servicos::listaEtapas();


function mkGrid($a,$b,$c){

    $_tag ='<ul class="ligrid">';
    //$_tag .='<li>Servicos</li>';

      //foreach SERVICOS
      foreach ($a as $valueServico) {
        
        $servico = $valueServico;
        $_tag .= '<li><h4><a href="#'.$servico['id_servico'].'">'.$servico['nome_servico'].'</a></h4></li>';
        
          //foreach FASES
          $_tagF='';
          foreach ($b as $valueFase) {
            $fase = $valueFase;
            if($fase['id_servico']==$servico['id_servico']){
            $_tagF .= '<li><h5><a href="'.$fase['id_fase'].'">'.$fase['nome_fase'].'</a></h5></li>';
           

          
                //foreach ETAPAS
                $_tagE='';
                foreach ($c as $valueEtapa) {
                  $etapa = $valueEtapa;
                        
                  if($etapa['id_fase']==$fase['id_fase']){
                  $_tagE .= '<li><a href="'.$etapa['id_etapa'].'">'.$etapa['nome_etapa'].'</a></li>';
                  }
               
                }//final foreach ETAPAS  
                if($_tagE!=''){
                $_tagF .= '<ul class="mgl-20">'.$_tagE.'</ul>';
                $_tagE='';
                } 
                
                
            }//caso tenha etapas para o ID SERVICO
          
        
          }//final foreach FASES
          if($_tagF!=''){
          $_tag .= '<ul class="mgl-20">'.$_tagF.'</ul>';
          }
        
        
      }//final foreach SERVICOS
    
    
    $_tag .='</ul>';
    
    return $_tag;
  
}

$_res_tag = mkGrid($lst_servicos,$lst_fases,$lst_etapas);




?>
