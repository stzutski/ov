<?php 
/*
 * usage:
 * require_once(ADMINVIEWS.'elementos/selects/selectModelos.adm-servicos.php');
 * */
  

  //BUSCA LISTA DE FASES CADASTRADAS
  $_dataCats  = dbf('SELECT * FROM servicos_categorias WHERE id_empresa = :id_empresa',array(':id_empresa'=>decode(sessionVar('_iE'))),'fetch');
      
                      
  $_optFse=array();
  $grp    =array();
  $_tagCS  = '<select class="form-control jumpTo" id="optIdCat" name="optIdCat" data-go="'.URLAPP.'adm-servicos/modelos?uidcs=">'."\n";
  $_tagCS .= '<option value="">Categorias de Serviços</option>';
  if(count($_dataCats)>0){
    
      
      for ($i = 0; $i < count($_dataCats); $i++)
      {
        $_dataCS  = $_dataCats[$i];
        $idCS     = $_dataCS['id_categoria'];
        $nmCS     = $_dataCS['nome_categoria_servico'];
        $selected = '';
        
        if($_idCat_selecionada==$idCS){$selected = ' selected';}

          $_tagCS .= '<option value="'.$idCS.'"'.$selected.'>'.$nmCS.'</option>'."\n";

      }
      
  $_tagCS .= '</select>';
  $_tagCS .= '<small id="optIdCat" class="form-text text-muted">Selecione uma categoria para visualizar os modelos</small>'."\n";
  }
  
  echo '<br />';
  echo $_tagCS;  
  echo '<br />';
?>
