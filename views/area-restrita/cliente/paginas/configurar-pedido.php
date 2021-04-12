<?php 
/*
 * inicio da contratacao (pedido) pagina onde o usuario ira informar o nome e a data de nascimento de cada
 * uma das pessoas que necessita do servico de emissao do visto
 * */


//caso uma categoria tenha sido informada e o campo uidServices tb esteja informado
if(postVar('uidcat')!='' && postVar('uidservices')!=''){
  
  //confirmamos quais modalidades do servico foram solicitadas ex adultos, criancas etc...
  $mods = postVar('uidservices');
  $lm   = explode(';',$mods);
  
  $mods_pedido = array();//array com o UID das modalidade solicitadas ex adultos, criancas etc...
  $tot_serv    = 0;//total de servicos requisitados
  for ($m = 0; $m < count($lm); $m++)
  {
    $v  = $lm[$m];              //anotamos o ID da modalidade
    $vc = (int)postVar("servico_$v");//anotamos o valor do campo (no formulario) para pegar o total de itens desta modalidade
    //echo "servico_$v (".postVar("servico_$v").")<br />";
    if(is_int($vc) && $vc>0){   //verificamos se valor eh um inteiro e maior que zero
      $mods_pedido[$v] = $vc;   //anotamos em um array somente  os UIDs da modalidade requeridas e suas quantidades
      $tot_serv += $vc;       //atualizamo o total de servicos requisitados
    }
  }

  /*
   * se a quantidade de servicos for ZERO entao o cliente nao especificou as quantidades desejas de vistos
   * talvez o JS tenha falhado e nao tenha impedido o usuario de submeter o formulario sem essa informacao
   * O backend deve fazer a verificacao
   * */  
  if($tot_serv==0){
    echo '<div class="alert alert-warning" role="alert"><strong>VOCÊ NÃO ESPECIFICOU QUANTOS VISTOS DESEJA!<br />Por favor volte e informe as quantidades.</strong></div>';
  }
  
  /*
   * se o total de servicos requisitados for maior que ZERO entao exibe os campos 
   * do formulario para configura o pedido
   * */
  if($tot_serv>0){
    $tags='';
    
    echo '<form id="frmconf" name="frmconf" method="post" action="process">'."\n";
    
    foreach ($mods_pedido as $key => $value) {
      
      $idServico  = $key;
      $dt_serv    = getDataService($idServico,1);
      
      echo '<div class="container">'."\n";
      echo '<div class="card">'."\n";
      echo '<div class="card-header">'.$dt_serv[0]['modalidade_servico'].'</div>'."\n";
      echo '<div class="card-body">'."\n";
      //echo '<fieldset>'."\n";
      //echo '<legend>'.$dt_serv[0]['nome_servico'].' - <small>'.$dt_serv[0]['modalidade_servico'].'</small></legend>'."\n";
      
      for ($f = 1; $f <= $value; $f++)
      {
      ?>
        
        <div class="row">
          <div class="col-md-9">
          <div class="form-group">
            <label for="dependente_sx_<?php echo $f;?>">Nome</label>
            <input type="email" class="form-control" id="dependente_sx_<?php echo $f;?>" name="Nomex">
          </div>
          </div>
          <div class="col-md-3">
          <div class="form-group">
            <label for="dependente_sx_<?php echo $f;?>">Dt.Nasc.</label>
            <input type="email" class="form-control dtpicker" id="nasc_x_<?php echo $f;?>" name="idade">
          </div>
          </div>
          <div class="col-md-12">
          <hr />
          </div>
        </div>

      <?php
      }
      
      //echo '</fieldset>'."\n";
      echo '</div>'."\n";
      echo '</div>'."\n";
      echo '</div>'."\n";
      
    }
    
    echo '</form>'."\n";
  
  }
  
  
  
  
  
  
}

?>
