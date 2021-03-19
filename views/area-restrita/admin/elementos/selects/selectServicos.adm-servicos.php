<?php 
//require_once(ADMINVIEWS.'elementos/selects/selectServicos.adm-servicos.php');

  $_idItemSelecionado = $_idSelecionado;
  $modoGroup    = false;
  $_legenda     = 'Selecione uma categoria para visualizar os serviços';

  //BUSCA LISTA DE FASES CADASTRADAS
  $_dataSelect  = dbf('SELECT * FROM servicos_categorias WHERE status_categoria_servico = 1 ORDER BY nome_categoria_servico ASC','','fetch');
  
                      
                      
                      
  $_optSel=array();
  $grp    =array();
  $_tagSELECT  = '<select class="form-control jumpTo" id="optIdFase" name="optIdFase" data-go="'.URLAPP.'adm-servicos/servicos?uidcs=">'."\n";
  $_tagSELECT .= '<option value="">Categorias</option>';
  if(count($_dataSelect)>0){
    
      
      for ($i = 0; $i < count($_dataSelect); $i++)
      {
        $_dataROW       = $_dataSelect[$i];
        $id             = $_dataROW['id_categoria'];
        $nmServico      = $_dataROW['nome_categoria_servico'];
        $selected       = '';
        
        if($_idItemSelecionado==$id){$selected = ' selected';}
        
        if(!in_array($nmServico,$grp)&&$modoGroup==true){
          $_tagSELECT .= '<optgroup label="'.$_dataROW['nome_categoria_servico'].'">'."\n";
          $_tagSELECT .= '<option value="'.$id.'"'.$selected.'>'.$_dataROW['nome_categoria_servico'].'</option>'."\n";
          $grp[]  = $_dataROW['nome_servico'];
        }else{
          $_tagSELECT .= '<option value="'.$id.'"'.$selected.'>'.$_dataROW['nome_categoria_servico'].'</option>'."\n";
        }

      }
      
    $_tagSELECT .= '</select>';
    
    if($_legenda!=''){
    $_tagSELECT .= '<small id="optIdFase" class="form-text text-muted">'.$_legenda.'</small>'."\n";
    }
    
  }
  else
  {
    $_tagSELECT .= '</select>';
    
    if($_legenda!=''){
    $_tagSELECT .= '<small id="optIdFase" class="form-text text-muted"><span class="text-danger">Não existem categorias ATIVAS</span></small>'."\n";
    }
    
  }
  
  echo $_tagSELECT;  
  echo '<br />';

?>
