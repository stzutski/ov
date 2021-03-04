<?php if(chkVar($_nomeCategoriaSelecionada)){
    echo "<center><h3><b>Contratando:</b> $_nomeCategoriaSelecionada</h3></center>";
  }
  
  
  if(isSet($form)){
    
    echo '<form method="post" action="process"><div class="form-row">';
    echo $form;
      echo '<div class="form-group col-md-12">';
        echo '<button type="button" onclick="history.back();" class="btn btn-warning">Voltar</button> &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-primary">Avançar</button>';
      echo '</div>';
    echo '</div>';
    echo '<input type="hidden" name="idc" value="'.$idCategoriaServico.'" />';
    echo '<input type="hidden" name="do" value="saveorder" />';
    echo '</form>';
    
    
  }else{echo "false";}
?>
