<?php 
//require_once(ADMINVIEWS.'elementos/selects/select-lista-etapas.adm-servicos.php');


  //BUSCA LISTA DE FASES CADASTRADAS
  $_dataFases  = dbf('SELECT 
                      a.id_fase,
                      a.id_servico,
                      a.nome_fase,
                      a.zorder_fase,
                      b.id_servico,
                      b.nome_servico,
                      b.modalidade_servico
                      FROM 
                      servicos_fases AS a,
                      servicos AS b
                      WHERE
                      a.id_servico = b.id_servico
                      ORDER BY b.nome_servico,a.zorder_fase ASC','','fetch');
                      
                      
                      
  $_optFse=array();
  $grp    =array();
  $_tagSF  = '<select class="form-control jumpTo" id="optIdFase" name="optIdFase" data-go="'.URLAPP.'adm-servicos/etapas?uidf=">'."\n";
  $_tagSF .= '<option value="">Servicos >> Fases</option>';
  if(count($_dataFases)>0){
    
      
      for ($i = 0; $i < count($_dataFases); $i++)
      {
        $_dataF         = $_dataFases[$i];
        $idF            = $_dataF['id_fase'];
        $nmServico      = $_dataF['nome_servico'];
        $selected       = '';
        
        if($_idFaseSelecionada==$idF){$selected = ' selected';}
        
        if(!in_array($nmServico,$grp)){
          $_tagSF .= '<optgroup label="'.$_dataF['nome_servico'].'">'."\n";
          $_tagSF .= '<option value="'.$idF.'"'.$selected.'>'.$_dataF['nome_fase'].'</option>'."\n";
          $grp[]  = $_dataF['nome_servico'];
        }else{
          $_tagSF .= '<option value="'.$idF.'"'.$selected.'>'.$_dataF['nome_fase'].'</option>'."\n";
        }

      }
      
  $_tagSF .= '</select>';
  $_tagSF .= '<small id="optIdFase" class="form-text text-muted">Selecione uma fase para visualizar suas etapas</small>'."\n";
  }
  
  echo '<br />';
  echo $_tagSF;  
  echo '<br />';


?>
