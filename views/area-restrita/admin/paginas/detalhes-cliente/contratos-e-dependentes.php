        
    <div class="row stripe-1">
    <div class="col-md-12 rowDet">
      <h5 class="faklink" data-toggle="collapse" data-target="#row_contratos"><i class="fas fa-business-time"></i> Contratos & Dependentes</h5>
    </div>
    </div>   
    
    
    <div id="row_contratos" class="collapse show">
    <?php 
    
    //busca pedidos do usuario
    $uidITEM         = array();
    $uidRESPONSAVEL  = array();    
    $_usuario_pedidos = dbf('SELECT * FROM pedidos WHERE id_usuario = :id_usuario',array(':id_usuario'=>$_uidUsuario),'fetch');
    if($_usuario_pedidos){//caso existam pedidos para este usuario
      if(is_array($_usuario_pedidos)&&count($_usuario_pedidos)>0){
        

        
        for ($pd = 0; $pd < count($_usuario_pedidos); $pd++)
        {
          
          $dadosPedido  = $_usuario_pedidos[$pd];
          $idPEDIDO     = $dadosPedido['id_pedido'];
          if($pd%2==0){$rCLASS='0';}else{$rCLASS='1';}
          ?>
          <!-- <?php echo $rCLASS; ?> -->
          <div class="row stripe-<?php echo $rCLASS;?>">
            <div class="col-md-12">

            <?php 
            $itens_data = dbf('SELECT DISTINCT(id_item),id_usuario,id_cliente_dependente FROM pedidos_itens 
                              WHERE id_empresa = :id_empresa AND id_usuario = :id_usuario AND id_pedido = :id_pedido',
                              array(':id_empresa'=>decode(sessionVar('_iE')),':id_usuario'=>$_uidUsuario,':id_pedido'=>$idPEDIDO),'fetch');            
            
            
            if(is_array($itens_data) && count($itens_data)>0){
              $lastItem='';
              for ($ip = 0; $ip < count($itens_data); $ip++)
              { 
                if($ip%2==0){$rcClass='0';}else{$rcClass='1';}
                
                $dadosITEMPEDIDO  = $itens_data[$ip];
                $idITEM = $dadosITEMPEDIDO['id_item'];
                $idUSER = $dadosITEMPEDIDO['id_usuario'];
                $idCLI  = $dadosITEMPEDIDO['id_cliente_dependente'];
                $dtCLI  = perfilDependenteById($idCLI);
                
                if($lastItem!='' && $lastItem!=$idITEM){echo '</div>'."\n";}
                
                if(!in_array($idITEM,$uidITEM)){
                  $dt_ITEM = perfilDetServico($idITEM);
                  echo '<div class="row stripe-'.$rcClass.'">'."\n";
                  echo '<div class="col-md-6 rowDet"><b>'.$dt_ITEM['nome_servico'].'</b></div>'."\n";
                  $uidITEM[]=$idITEM;
                }
                if(!in_array($idUSER,$uidRESPONSAVEL)){
                  echo '<div class="col-md-6 rowDet"><i class="fas fa-star" style="color:#FFDA00;"></i>'.$dtCLI['nome_cliente'].' '.$dtCLI['sobrenome_cliente'].'</div>'."\n";
                  $uidRESPONSAVEL[]=$idUSER;
                }else{
                  echo '<div class="col-md-6 rowDet">'.$dtCLI['nome_cliente'].' '.$dtCLI['sobrenome_cliente'].'</div>'."\n";
                }
                
                $lastItem = $dadosITEMPEDIDO['id_item'];
              }
              
            }elseif(!is_array($itens_data)){
            ?>
                <div class="col-md-12 rowDet">Nenhum item para este pedido!!!</div>
            <?php
            }
            
            ?>

            </div>
          </div>
          </div><!-- HR -->
          <?php
        }
        
      }
    }
    ?>
