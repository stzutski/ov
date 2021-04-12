  <?php 
  
  //DATA ARRAY COM AS CATEGORIAS DE SERVICOS CADASTRADAS
  $_arrServices = dbf('SELECT id_categoria,nome_categoria_servico FROM servicos_categorias','','fetch');
  for ($i = 0; $i < count($_arrServices); $i++)
  {
    $rd = $_arrServices[$i];
    $id = $rd['id_categoria'];
    $nm = $rd['nome_categoria_servico'];
    $_dataArrCategorias[$id] = $nm;
  }  
  
  
  $formV['id_categoria']  = '';
  $formV['nomeServico']   = '';
  $formV['modServico']    = '';
  $formV['descServico']   = '';
  $formV['precoServico']  = '';
  $formV['statusServ']    = '';
  
  
  if(getVar('uids')>0){
    
  //DADOS DO SERVICO SELECIONADO
  $dataServ = dbf('SELECT * FROM servicos WHERE id_servico = :id_servico',array(':id_servico'=>getVar('uids')),'fetch');

  /*    
  id_servico
  id_empresa
  id_categoria
  modalidade_servico
  nome_servico
  desc_servico
  nomeplano_servico
  preco_servico
  status_servico     
  */    

  $formV['id_categoria']  = $dataServ[0]['id_categoria'];
  $formV['nomeServico']   = $dataServ[0]['nome_servico'];
  $formV['modServico']    = $dataServ[0]['modalidade_servico'];
  $formV['descServico']   = $dataServ[0]['desc_servico'];
  $formV['precoServico']  = moeda( $dataServ[0]['preco_servico'] );
  $formV['statusServ']    = $dataServ[0]['status_servico'];
  }
  
  echo '<br />';
  
  //echo mkCard('header','<h5><a href="adm-servicos/servicos?uidcs='.getVar('uidcs').'">Categoria</a> > '.arrayVar($formV,'nomeServico').''.btnRemove(getVar('uids'),'removeServ','adm-servicos/servicos?uidcs='.getVar('uidcs').'').'</h5>');
  
  $_btn_removeFooterForm = btnRemove(getVar('uids'),'removeServ','adm-servicos/servicos?uidcs='.getVar('uidcs').'');
  
  echo '<form class="fmr-int" id="servCat" name="servCat" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','catServ');
  echo '<fieldset id="catServ_onoff" disabled="disabled">'."\n";
  echo f_select('Servico','id_categoria','id_categoria',$_dataArrCategorias,getVar('uidcs'),arrayVar($formV,'id_categoria'))."\n";
  echo f_Text('Nome serviço:','nomeServico','nomeServico',arrayVar($formV,'nomeServico'),'','');
  echo f_Text('Modalidade do Serviço','modServico','modServico',arrayVar($formV,'modServico'));
  echo f_Text('Descrição do Serviço','descServico','descServico',arrayVar($formV,'descServico'));
  echo f_Text('Preço do Serviço','precoServico','precoServico',arrayVar($formV,'precoServico'),'Ex: 1500,00',true, jsMask('valor'));
  //f_select($label='',$id='',$name='',$opts=array(),$selected='',$req=false,$help='',$class='',$atts='')
  echo f_select('Ficha de Cadastro','uidform','uidform',array('0'=>'18+','1'=>'até 17 anos','2'=>'até 13 anos'),arrayVar($formV,'uidserv'),true,'Formulário da ficha de cadastro');
  echo f_select('Status','statusServ','statusServ',array('0'=>'INATIVO','1'=>'ATIVO'),arrayVar($formV,'statusServ'),'status_servico','statusServ');
  echo f_hidden('bkt','adm-servicos/servicos?uidcs=');
  echo f_hidden('uid',getVar('uids'));
  echo f_hidden('do','saveService');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";  
  echo '</form>'."\n";
  
  
  
  //echo mkCard('footer');
  // final do card  
  
  ?>
