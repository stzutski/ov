<?php 

  echo mkCard('header','<h4><a href="adm-fases-servico">Serviços</a> / Nova fase '.btnRemove('','faseserv').'</h4>');
  
  echo '<form class="fmr-int" id="faseServ" name="faseServ" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','faseServ');
  echo '<fieldset id="faseServ_onoff" disabled="disabled">'."\n";
  echo f_Text('Nome fase:','nomeFase','nomeFase','','','');
  echo f_Text('Descrição da Fase','descFase','descFase','');
  echo f_Text('Prazo fase','prazoFase','prazoFase','','Ex: 1500,00',true, jsMask('valor'),'Prazo estimado em dias para conclusão');
  echo f_select('Estatus','statsFase','statsFase',array('0'=>'Inativo','1'=>'ativo'),'','status_fase','statsFase');
  if(isSet($idServico)){
  echo f_hidden('uidServico',$idServico);
  }
  echo f_hidden('uid','0');
  echo f_hidden('do','saveFase');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  echo mkCard('footer');

?>
