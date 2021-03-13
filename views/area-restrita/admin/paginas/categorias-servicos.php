<?php 
if(isSet($cats) && !isSet($catData)){

echo boxColapse();
echo reList($cats);
echo boxColapse('footer');

/*
 * funcao para gerar tabelas HTML
 * recebe array de argumentos:::
 * $argsTb['data']  (array feech mysql)
 * $argsTb['hf']    (linha com o header e footer)
 * $argsTb['idx']   (indices da tabela usadas na tabela html)
 * $argsTb['tpl']   (template das linhas da tabela)
 * */
$btn            = btn(URLAPP.'cat-servicos/0','<i class="far fa-plus-square"></i> Categoria de serviços');
 
$tbargs['data'] = $cats;
$tbargs['hf']   = '<tr><th style="width:50px;text-align:center;">ID</th><th>NOME</th><th style="width:50px;text-align:center;">STATUS</th></tr>';
$tbargs['idx']  = array('id_categoria','nome_categoria_servico','status_categoria_servico');
$tbargs['tpl']  = '<tr><td>{id_categoria}</td><td><a href="cat-servicos/{id_categoria}">{nome_categoria_servico}</a></td><td>{status_categoria_servico}</td></tr>';
$tbargs['zreg'] = '<tr><td colspan="3" class="text-center">Nenhum Registro Encontrado!</td></tr>';


echo mkTable($tbargs);

echo $btn;


}
elseif(isSet($idCategoria) && isSet($catData) && $catData==0){
  
  echo mkCard('header','<h4>Nova Categoria</h4>');
  
  echo '<form class="fmr-int" id="catServ" name="catServ" method="POST" action="process">'."\n";
  echo f_Text('Nome categoria','nomeCat','nomeCat','','Ex: Visto Turismo USA',true);
  echo f_Text('Descrição categoria','descCat','descCat','','Ex: Visto destinado ao...',true);
  echo f_Text('Img Categoria','imgCat','imgCat','','Imagem');
  echo f_select('Estatus','statusCat','statusCat',array('1'=>'ATIVO','0'=>'INATIVO'),'',true);
  echo f_hidden('uid',$idCategoria);
  echo f_hidden('do','saveCat');
  echo f_btn('btn','<i class="far fa-save"></i> Salvar Dados','back');
  echo '</form>'."\n";

  echo mkCard('footer');
  // final do form da categoria
  
  
}elseif(isSet($idCategoria) && isSet($catData) && $catData>0){
    
  echo boxColapse();
  echo reList($catData);
  echo boxColapse('footer');
  
  
  
  echo mkCard('header','<h4><a href="cat-servicos">Categorias</a> / '.$catData[0]['nome_categoria_servico'].''.btnRemove('','servico').'</h4>');


  echo '<form class="fmr-int" id="catServ" name="catServ" method="POST" action="process">'."\n";
  echo swbtn('Ativar form.','text-right','catServ');
  echo '<fieldset id="catServ_onoff" disabled="disabled">'."\n";
  echo f_Text('Nome categoria','nomeCat','nomeCat',popform($catData[0],'nome_categoria_servico','nomeCat'));
  echo f_Text('Descrição categoria','descCat','descCat',popform($catData[0],'desc_categoria_servico','descCat'));
  echo f_Text('Img Categoria','imgCat','imgCat',popform($catData[0],'img_categoria_servico','imgCat'));
  echo f_select('Estatus','statusCat','statusCat',array('1'=>'ATIVO','0'=>'INATIVO'),popform($catData[0],'status_categoria_servico','statusCat'));
  echo f_hidden('uid',$idCategoria);
  echo f_hidden('do','saveCat');
  echo f_btn('btn','Salvar Dados','back');
  echo '</fieldset>'."\n";
  echo '</form>'."\n";
  
  
  echo mkCard('footer');
  // final do form da categoria
  
  

echo '<br />';
echo '<br />';

  //lista de servicos da categoria
  echo mkCard('header','<h4>Serviços desta Categoria '.btn(URLAPP.'add-servico/categoria/'.$idCategoria.'','+Servico para esta categoria').'</h4>');


  if(isSet($srvCats)){
    if(is_array($srvCats)){
      echo '<ul class="list-group">';
      for ($i = 0; $i < count($srvCats); $i++)
      {
        $srvData      = $srvCats[$i];
        $uidServico   = $srvData['id_servico'];
        $nomeServico  = $srvData['nome_servico'];
        $modServico   = $srvData['modalidade_servico'];
        $strSrv       = "$nomeServico - $modServico";
        echo '<li class="list-group-item"><a href="detalhes-servico\\'.$uidServico.'">'.$strSrv.'</a></li>';
      }
      echo '</ul>';
    }
  }

  echo mkCard('footer');
  //final da lista de categorias

}
?>
