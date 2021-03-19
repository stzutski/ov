    <?php 
    if(getVar('opt')=='edit-cat-serv'&&getVar('uidcs')=='0'){
      
      echo '<form class="fmr-int" id="catServ" name="catServ" method="POST" action="process">'."\n";
      echo f_Text('Nome categoria','nomeCat','nomeCat','','Ex: Visto Turismo USA',true);
      echo f_Text('Descrição categoria','descCat','descCat','','Ex: Visto destinado ao...',true);
      echo f_Text('Img Categoria','imgCat','imgCat','','Imagem');
      echo f_select('Estatus','statusCat','statusCat',array('1'=>'ATIVO','0'=>'INATIVO'),'',true);
      echo f_hidden('uid',getVar('uidcs'));
      echo f_hidden('bkt','adm-servicos/cat-serv');
      echo f_hidden('do','saveCat');
      echo f_btn('btn','<i class="far fa-save"></i> Salvar Dados','back');
      echo '</form>'."\n";      
      
      
    }
    if(getVar('opt')=='edit-cat-serv'&&getVar('uidcs')!='0'){
      
      $dataCat =  dbf('SELECT * FROM servicos_categorias WHERE id_categoria = :id_categoria',
                  array(':id_categoria'=>getVar('uidcs')),'fetch');
      
      
      //echo mkCard('header','<h5>Categoria : '.$dataCat[0]['nome_categoria_servico'].''.btnRemove( getVar('uidcs'),'removeCatServ','adm-servicos/cat-serv').'</h5>');
      
      $_btn_removeFooterForm = btnRemove( getVar('uidcs'),'removeCatServ','adm-servicos/cat-serv');
      
      //FORM EDITAR CATEGORIA DO SERVICO
      echo '<br />';
      echo '<form class="fmr-int" id="servCat" name="servCat" method="POST" action="process">'."\n";
      echo swbtn('Ativar form.','text-right','faseServ');
      echo '<fieldset id="faseServ_onoff" disabled="disabled">'."\n";   
      echo f_Text('Nome categoria:','nomeCat','nomeCat',$dataCat[0]['nome_categoria_servico'],'','');
      echo f_Text('Descrição da categoria','descCat','descCat',$dataCat[0]['desc_categoria_servico']);
      echo f_Text('Imagem cat','imgCat','imgCat',$dataCat[0]['img_categoria_servico'],'',false,'');
      echo f_select('Status','statusCat','statusCat',array('0'=>'INATIVO','1'=>'ATIVO'),$dataCat[0]['status_categoria_servico'],'status_categoria');
      echo f_hidden('uid',getVar('uidcs'));
      echo f_hidden('bkt','adm-servicos/cat-serv?opt=edit-cat-serv');
      echo f_hidden('do','saveCat');
      echo f_btn('btn','Salvar Dados','back');
      echo '</fieldset>'."\n";
      echo '</form>'."\n";  
      
      //echo mkCard('footer');
      // final do card        
      
    }
    ?>
