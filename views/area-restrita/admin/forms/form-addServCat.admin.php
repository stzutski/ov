

  
  <?php 
  echo mkCard('header','<h3>Novo serviço</h3>');
  
  echo '<form class="fmr-int" id="servCat" name="servCat" method="POST" action="process">'."\n";
  echo f_Text('Nome serviço:','nomeServico','nomeServico','','','');
  echo f_Text('Modalidade do Serviço','modServico','modServico','');
  echo f_Text('Descrição do Serviço','descServico','descServico','');
  echo f_Text('Preço do Serviço','precoServico','precoServico','','Ex: 1500,00',true, jsMask('valor'));
  echo f_select('Estatus','statusServ','statusServ',array('0'=>'Inativo','1'=>'ativo'),'','status_servico','statusServ');
  if(isSet($idCategoria)){
  echo f_hidden('uidCategoria',$idCategoria);
  }
  echo f_hidden('uid','0');
  echo f_hidden('do','saveService');
  echo f_btn('btn','Salvar Dados','back');
  
  echo '</form>'."\n";
  
  echo mkCard('footer');
  // final do card  
  
  ?>
