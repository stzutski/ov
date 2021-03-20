<div class="row stripe-1">
      <div class="col-md-12 rowDet">
        <h5 class="faklink" data-toggle="collapse" data-target="#row_pedFat"><i class="fas fa-shopping-cart"></i> Pedidos e Faturas</h5>
      </div>
    </div>
        
    <div id="row_pedFat" class="collapse show">
      <?php 
      
      if(count($_pedidosData)>0){
      $stripeRow=0;
        for ($p = 0; $p < count($_pedidosData); $p++)
        {
          $dadosPedido  = $_pedidosData[$p];
          $dadosPedido  = $_pedidosData[$p];
          
          $_detFatura   = perfilFaturaPedido($dadosPedido['id_pedido']);
          if($_detFatura['status_fatura']==0){
            $_classFatura = 'order-unpaid';
            $_titleStatus = 'NÃO PAGA!';
          }else{
            $_classFatura = 'order-paid';
            $_titleStatus = 'NÃO PAGA!';
          }
          ?>
         <div class="row stripe-<?php echo $stripeRow;?>">
           <div class="col-md-2 rowDet"><b>Ped:</b> <a href="#"><?php echo str_pad($dadosPedido['id_pedido'],4,'0',STR_PAD_LEFT);?> <i class="fas fa-external-link-alt fa-xs"></i></a></div>
           <div class="col-md-2 rowDet" title="<?php echo date('d/m/Y H:i:s',$dadosPedido['dt_pedido']);?>"><?php echo date('d/m/Y',$dadosPedido['dt_pedido']);?></div>
           <div class="col-md-2 rowDet"><b>Itens:</b> <?php echo perfilItensPedidosCliente($dadosPedido['id_pedido']);?></div>
           <div class="col-md-2 rowDet"><b>Fat:</b> <a href="#"><?php echo str_pad($_detFatura['id_fatura'],4,'0',STR_PAD_LEFT);?> <i class="fas fa-external-link-alt fa-xs"></i></a></div>
           <div class="col-md-2 rowDet" title="<?php echo $_titleStatus;?>">R$ <?php echo moeda($_detFatura['vlr_fatura']);?> <i class="fas fa-check-double <?php echo $_classFatura;?>"></i></div>
         </div>
         <?php 
         $stripeRow++;
         }
     }?>         
 
    </div>       
