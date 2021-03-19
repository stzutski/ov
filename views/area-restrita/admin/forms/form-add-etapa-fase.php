<?php 
  /*
   * FORM PARA INCLUSAO DE "NOVAS" ETAPAS DA FASE DO SERVICO
   * */
  echo mkCard('header','<h4><a href="adm-fases-servico/fase/'.$idFase.'">Fase</a> / Nova Etapa da Fase do Serviço '.btnRemove('','faseserv').'</h4>');
  
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
  
  echo '<form class="fmr-int" id="faseServ" name="faseServ" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','faseServ');
  echo '<fieldset id="faseServ_onoff" disabled="disabled">'."\n";
  echo f_select('Tipo','tpEtapa','tpEtapa',$tiposEtapa,'',true,'O tipo de etapa tem impacto nos alertas dos clientes','',true);
  echo f_Text('Nome etapa:','nomeEtapa','nomeEtapa','','','');
  echo f_Text('Descrição da Etapa','descEtapa','descEtapa','');
  echo f_select('Status','statsEtapa','statsEtapa',array('0'=>'Inativo','1'=>'ativo'),'',true,'');
  if(isSet($idFase)){
  echo f_hidden('uidFase',$idFase);
  }
  echo f_hidden('uid','0');
  echo f_hidden('do','saveEtapa');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  echo mkCard('footer');















?>
