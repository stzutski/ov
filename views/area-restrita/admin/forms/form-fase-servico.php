<?php 

/*
id_fase
id_servico
nome_fase
desc_fase
prazo_fase
zorder_fase
status_fase 
*/
  
  echo mkCard('header','<h4><a href="adm-fases-servico/servico/'.$faseData[0]['id_servico'].'">Fases</a> / '.$faseData[0]['nome_fase'].''.btnRemove('','servico').'</h4>');


  echo '<form class="fmr-int" id="faServ" name="faServ" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','catServ');
  echo '<fieldset id="catServ_onoff" disabled="disabled">'."\n";
  echo f_Text('Nome fase','nomeFase','nomeFase',popform($faseData[0],'nome_fase','nomeFase'));
  echo f_Text('Descrição fase','descFase','descFase',popform($faseData[0],'desc_fase','descFase'));
  echo f_Text('Prazo fase (DIAS)','prazoFase','prazoFase',popform($faseData[0],'prazo_fase','prazoFase'),'',true,'','Informe o número em DIAS');
  echo f_select('Estatus','statusFase','statusFase',array('1'=>'ATIVO','0'=>'INATIVO'),popform($faseData[0],'status_fase','statusFase'));
  echo f_hidden('uid',$idFase);
  echo f_hidden('do','saveCat');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  echo mkCard('footer');
  // final do form da categoria  
?>
