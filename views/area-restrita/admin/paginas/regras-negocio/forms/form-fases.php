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
  /*
   * FORMULÁRIO DE CADASTRO E ALTERACAO DE DADOS DA FASE DO SERVICO
   * */
  

  
  //DATA ARRAY COM OS SERVICOS CADASTRADOS
  $_arrServices = dbf('SELECT id_servico,nome_servico FROM servicos','','fetch');
  for ($i = 0; $i < count($_arrServices); $i++)
  {
    $rd = $_arrServices[$i];
    $id = $rd['id_servico'];
    $nm = $rd['nome_servico'];
    $_dataArrServicos[$id] = $nm;
  }  
  
  
  if(getVar('uidf')==0){

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

  echo '<br />'; 
  
  //echo mkCard('header','<h5><a href="adm-servicos/fases?uids='.getVar('uids').'">Servico</a> > Fase > Nova fase</h5>');
 

  echo "\n".'<form class="fmr-int" id="faServ" name="faServ" method="POST" action="process">'."\n";
  echo f_select('Servico','id_servico','id_servico',$_dataArrServicos,getVar('uids'));
  echo f_Text('Nome fase','nomeFase','nomeFase','');
  echo f_Text('Descrição fase','descFase','descFase','','',true,'','');
  echo f_Number('Prazo fase (DIAS)','prazoFase','prazoFase','','somente números',true,jsMask('inteiro'),'Informe o número em DIAS');
  echo f_select('Estatus','statsFase','statsFase',array('1'=>'ATIVO','0'=>'INATIVO'),'');
  echo f_hidden('uid',getVar('uidf'));
  echo f_hidden('do','saveFase');
  echo f_hidden('bkt','adm-servicos/fases?uids=');
  echo f_btn('btn','Salvar Dados','back');
  echo '</form>'."\n";
  
  
  //echo mkCard('footer');
  // final do form da categoria

  }
  elseif(getVar('uidf')>0)
  {
  
  
  //DADOS DA FASE SELECIONADA
  $faseData = dbf('SELECT * FROM servicos_fases WHERE id_fase = :id_fase',array(':id_fase'=>getVar('uidf')),'fetch');
  
  
  echo '<br />'; 
  
  //echo mkCard('header','<h5><a href="adm-servicos/fases?uids='.getVar('uids').'">Servico</a> > Fase > '.$faseData[0]['nome_fase'].''.btnRemove(getVar('uidf'),'removeFase','adm-servicos/fases?uids='.getVar('uids').'').'</h5>');
 
  $_btn_removeFooterForm = btnRemove(getVar('uidf'),'removeFase','adm-servicos/fases?uids='.getVar('uids').'');

  echo "\n".'<form class="fmr-int" id="faServ" name="faServ" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','catServ');
  echo '<fieldset id="catServ_onoff" disabled="disabled">'."\n";
  echo f_select('Servico','id_servico','id_servico',$_dataArrServicos,popform($faseData[0],'id_servico','id_servico'));
  echo f_Text('Nome fase','nomeFase','nomeFase',popform($faseData[0],'nome_fase','nomeFase'));
  echo f_Text('Descrição fase','descFase','descFase',popform($faseData[0],'desc_fase','descFase'));
  //   f_Number($label='',$id='',$name='',$value='',$placeholder='',$req=false,$mask='',$help='')
  echo f_Number('Prazo fase (DIAS)','prazoFase','prazoFase',popform($faseData[0],'prazo_fase','prazoFase'),'somente números',true,jsMask('inteiro'),'Informe o número em DIAS');
  echo f_select('Estatus','statsFase','statsFase',array('1'=>'ATIVO','0'=>'INATIVO'),popform($faseData[0],'status_fase','statsFase'));
  echo f_hidden('uid',getVar('uidf'));
  echo f_hidden('uidServico',$faseData[0]['id_servico']);
  echo f_hidden('do','saveFase');
  echo f_hidden('bkt','adm-servicos/fases?uids=');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  //echo mkCard('footer');
  // final do form da categoria
  
}  
?>
