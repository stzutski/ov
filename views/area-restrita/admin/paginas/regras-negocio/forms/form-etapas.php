<?php 
  $_idEtapaSelecionada = getVar('uide');

/*
id_fase
id_servico
id_empresa
nome_fase
desc_fase
prazo_fase
zorder_fase
status_fase 
*/

  //DATA ARRAY COM OS SERVICOS CADASTRADOS
  $_arrFases = dbf('SELECT id_fase,nome_fase FROM servicos_fases WHERE id_empresa = :id_empresa',array(':id_empresa'=>decode( sessionVar('_iE') )),'fetch');
  for ($i = 0; $i < count($_arrFases); $i++)
  {
    $rd = $_arrFases[$i];
    $id = $rd['id_fase'];
    $nm = $rd['nome_fase'];
    $_dataArrFases[$id] = $nm;
  } 



  /*
   * FORM PARA CADASTRO OU ALTERACAO DE ETAPAS DA FASE DO SERVICO
   * */
  if(getVar('uide')=='0'){
    
      echo '<br />'; 
      //echo mkCard('header','<h5><a href="adm-servicos/etapas?uidf='.getVar('uidf').'">Etapas</a> > Nova etapa </h5>');
      
      $tiposEtapa = array( 
      1=>'Ação da Equipe',
      2=>'Ação do Usuário',
      3=>'Envio de docs',
      4=>'Rcbto de docs (upload)',
      5=>'Envio de dados',
      6=>'Rcbto de dados (form)',
      7=>'Process. Interno Diverso',
      8=>'Process. Externo Diverso',
      9=>'Aguardar Prazo regulamentar',
      10=>'Outros');  
      
      echo "\n".'<form class="fmr-int" id="faseServ" name="faseServ" method="POST" action="process">'."\n";
      echo f_select('Fase','id_fase','id_fase',$_dataArrFases,getVar('uidf'),true,'<b>NOTA:</b> A alteração da fase em etapas <b>ATIVAS E EM USO</b> pode causar conflitos nos registros!');
      echo f_select('Tipo','tpEtapa','tpEtapa',$tiposEtapa,true,'O tipo de etapa tem impacto nos alertas dos clientes','',true);
      echo f_Text('Nome etapa:','nomeEtapa','nomeEtapa','','','');
      echo f_Text('Descrição da Etapa','descEtapa','descEtapa','');
      echo f_select('Status','statsEtapa','statsEtapa',array('0'=>'INATIVO','1'=>'ATIVO'),'',true,'');
      echo f_hidden('uid','0');
      echo f_hidden('bkt','adm-servicos/etapas?uidf=');
      echo f_hidden('do','saveEtapa');
      echo f_btn('btn','Salvar Dados','back');
      echo '</form>'."\n";
      
      //echo mkCard('footer');
    
    
  }
  elseif(getVar('uide')>0)
  {


      //DADOS DA ETAPA SELECIONADA
      $dataEtapa = dbf('SELECT * FROM servicos_fases_etapas WHERE id_etapa = :id_etapa',array(':id_etapa'=>$_idEtapaSelecionada),'fetch');


      echo '<br />'; 
      //echo mkCard('header','<h5><a href="adm-servicos/etapas?uidf='.$dataEtapa[0]['id_fase'].'">Etapas</a> > '.$dataEtapa[0]['nome_etapa'].' '.btnRemove($_idEtapaSelecionada,'removeEtapa','adm-servicos/etapas?uidf='.getVar('uidf').'').'</h5>');
      
      $tiposEtapa = array( 
      1=>'Ação da Equipe',
      2=>'Ação do Usuário',
      3=>'Envio de docs',
      4=>'Rcbto de docs (upload)',
      5=>'Envio de dados',
      6=>'Rcbto de dados (form)',
      7=>'Process. Interno Diverso',
      8=>'Process. Externo Diverso',
      9=>'Aguardar Prazo regulamentar',
      10=>'Outros');  
      
      $_btn_removeFooterForm = btnRemove($_idEtapaSelecionada,'removeEtapa','adm-servicos/etapas?uidf='.getVar('uidf').'');
      
      echo "\n".'<form class="fmr-int" id="faseServ" name="faseServ" method="POST" action="process">'."\n";
      echo swbtn('Ativar form.','text-right','faseServ');
      echo '<fieldset id="faseServ_onoff" disabled="disabled">'."\n";
      //echo f_select('Fase:','id_fase','id_fase',$ar_fases,$dataEtapa[0]['id_fase'],true,'');
      echo f_select('Tipo','tpEtapa','tpEtapa',$tiposEtapa,$dataEtapa[0]['tipo_etapa'],true,'O tipo de etapa tem impacto nos alertas dos clientes','',true);
      echo f_Text('Nome etapa:','nomeEtapa','nomeEtapa',$dataEtapa[0]['nome_etapa'],'','');
      echo f_Text('Descrição da Etapa','descEtapa','descEtapa',$dataEtapa[0]['desc_etapa']);
      echo f_select('Status','statsEtapa','statsEtapa',array('0'=>'Inativo','1'=>'ativo'),$dataEtapa[0]['status_etapa'],true,'');
      if(isSet($dataEtapa[0]['id_fase'])){
      echo f_hidden('uidFase',$dataEtapa[0]['id_fase']);
      }
      if(isSet($_idEtapaSelecionada)){
      echo f_hidden('uid',$_idEtapaSelecionada);
      }
      echo f_hidden('bkt','adm-servicos/etapas?uidf='.getVar('uidf'));
      echo f_hidden('do','saveEtapa');
      echo f_btn('btn','Salvar Dados','back');
      echo '</fieldset>'."\n";
      echo '</form>'."\n";
      //echo mkCard('footer');
     
 }
   
   
?>
