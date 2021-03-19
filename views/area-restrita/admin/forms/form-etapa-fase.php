<?php 
  echo boxColapse();
  echo reList($ar_fases);
  echo boxColapse('footer');


  /*
   * FORM PARA ALTERACAO DE ETAPAS DA FASE DO SERVICO
   * */
  echo mkCard('header','<h4><a href="adm-fases-servico/fase/'.$dataEtapa[0]['id_fase'].'">Fase</a> / '.$dataEtapa[0]['nome_etapa'].' '.btnRemove('','faseserv').'</h4>');
  
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
  echo swbtn('Ativar form.','text-right','faseServ');
  echo '<fieldset id="faseServ_onoff" disabled="disabled">'."\n";
  echo f_select('Fase:','id_fase','id_fase',$ar_fases,$dataEtapa[0]['id_fase'],true,'');
  echo f_select('Tipo','tpEtapa','tpEtapa',$tiposEtapa,$dataEtapa[0]['tipo_etapa'],true,'O tipo de etapa tem impacto nos alertas dos clientes','',true);
  echo f_Text('Nome etapa:','nomeEtapa','nomeEtapa',$dataEtapa[0]['nome_etapa'],'','');
  echo f_Text('Descrição da Etapa','descEtapa','descEtapa',$dataEtapa[0]['desc_etapa']);
  echo f_select('Status','statsEtapa','statsEtapa',array('0'=>'Inativo','1'=>'ativo'),$dataEtapa[0]['status_etapa'],true,'');
  if(isSet($dataEtapa[0]['id_fase'])){
  echo f_hidden('uidFase',$dataEtapa[0]['id_fase']);
  }
  if(isSet($idEtapa)){
  echo f_hidden('uid',$idEtapa);
  }
  echo f_hidden('do','saveEtapa');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  echo mkCard('footer');















?>
