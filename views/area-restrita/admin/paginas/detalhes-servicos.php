<?php 
if(isSet($idServico)){

echo boxColapse();
echo reList($listaServicos);
echo boxColapse('footer');  
}
?>


  
  <?php 
  echo mkCard('header','<h4><a href="cat-servicos/'.$listaServicos[0]['id_categoria'].'">Serviços</a> / '.$listaServicos[0]['nome_servico'].btnRemove($idServico,'servico').'</h4>');
  
  echo '<form class="fmr-int" id="servCat" name="servCat" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','servCat');
  echo '<fieldset id="servCat_onoff" disabled="disabled">'."\n";
  echo f_Text('Nome serviço','nomeServico','nomeServico',$listaServicos[0]['nome_servico'],'','');
  echo f_Text('Modalidade do Serviço','modServico','modServico',$listaServicos[0]['modalidade_servico']);
  echo f_Text('Descrição do Serviço','descServico','descServico',$listaServicos[0]['desc_servico']);
  echo f_Text('Preço do Serviço','precoServico','precoServico',moeda($listaServicos[0]['preco_servico']),'Ex: 1500,00',true, jsMask('valor'));
  echo f_select('Estatus','statusServ','statusServ',array('0'=>'Inativo','1'=>'ativo'),popform($listaServicos[0],'status_servico','statusServ'));
  echo f_hidden('uid',$idServico);
  if(isSet($listaServicos[0]['id_categoria'])){
  echo f_hidden('uidCategoria',$listaServicos[0]['id_categoria']);
  }
  echo f_hidden('do','saveService');
  echo f_btn('btn','Salvar Dados','back');
  
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  
  echo mkCard('footer');
  // final do form de servicos  
  ?>
