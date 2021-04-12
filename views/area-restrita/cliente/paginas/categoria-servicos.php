<h1>Categorias de serviços disponiveis</h1>



<div class="container-fluid">
  <div class="row">
    

<?php 
  foreach ($lista_categorias as $value) {
    $item = $value;
    $cardS='';
    //verificas se a categoria possui algum servico cadastrado para ela
    //SOMENTE IREMOS IMPRIMIR NA TELA CARDS QUE POSSUAM ALGUM SERVICO CADASTRADO
    $resSRVcat  = dbf('SELECT * FROM servicos WHERE id_categoria = :id_categoria',array(':id_categoria'=>$item['id_categoria']),'fetch');
    
    //caso possua algum servico(modalidade) cadastrado entao anotamos as modalidades para depois preencher o form
    if(is_array($resSRVcat)&&count($resSRVcat)>0){
      //localiza os servicos cadastrados
      $dt_serv    = '';
      $tag_srv    = '';
      $idSRVH     = '';
      for ($s = 0; $s < count($resSRVcat); $s++)
      {
        $dt_serv  = $resSRVcat[$s];
        $tag_srv .= '<div class="form-group col-md-4">';
        $tag_srv .= '<label for="4">'.$dt_serv['modalidade_servico'].'</label>';
        $tag_srv .= '<input class="form-control" type="number" id="cat_'.$item['id_categoria'].'_srv_'.$dt_serv['id_servico'].'" name="servico_'.$dt_serv['id_servico'].'" min="0" />';
        $tag_srv .= '</div>'."\n";
        $sep      = ($s == 0) ? '' : ';';
        $idSRVH  .= $sep.$dt_serv['id_servico'];
      }
      
      if($tag_srv!=''){
              
        $cardS .= '<div class="col-md-6">';
        $cardS .= '<div class="card">';
        $cardS .= '<div class="card-body">';
        $cardS .= '<h5 class="card-title">'.$item['nome_categoria_servico'].'</h5>';
        $cardS .= '<p class="card-text">'.$item['desc_categoria_servico'].'</p>';
        $cardS .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cat_'.$item['id_categoria'].'">Contratar</button>';
        $cardS .= '</div>';     
        
        $cardS .= modalPop(array('opt'=>'header','id'=>'modal_cat_'.$item['id_categoria'].'','title'=>''.$item['nome_categoria_servico'].''));
        $cardS .= '<div><center style="color:blue;"><strong>Você precisa do visto para quantas pessoas?</strong></center><br />';
        $cardS .= '<form id="cnfPed" method="post" action="configurar/pedido"><div class="form-row">';      
        
        $cardS .= $tag_srv;     
             
        $cardS .= '</div><input type="hidden" name="uidcat" value="'.$item['id_categoria'].'" /><input type="hidden" name="uidservices" value="'.$idSRVH.'" /><input type="hidden" name="do" value="configorder" />';
        $cardS .= '</form></div>';
        $cardS .= modalPop(array('opt'=>'footer','btn'=>'<button type="button" id="sb2conf" class="btn btn-primary">Avançar</button>'));;
        
        $cardS .= '</div>';
        $cardS .= '</div>'."\n\n";      
      }
      
    }
    
    echo $cardS;
  
  
  }
  
?>
      
  
  </div>
</div>
