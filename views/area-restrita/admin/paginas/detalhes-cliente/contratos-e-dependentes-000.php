        
    <div class="row stripe-1">
    <div class="col-md-12 rowDet">
      <h5 class="faklink" data-toggle="collapse" data-target="#row_contratos"><i class="fas fa-business-time"></i> Contratos & Dependentes</h5>
    </div>
    </div>   
    
    
    <div id="row_contratos" class="collapse show">
    <?php 
    
    //busca pedidos do usuario
    $_usuario_pedidos = dbf('SELECT * FROM pedidos WHERE id_usuario = :id_usuario',array(':id_usuario'=>$_uidUsuario),'fetch');
    
    if(count($_usuario_pedidos)==0){
      
      echo 'Não existem pedidos!';
      
    }else{//caso existam pedidos
      
      for ($pp = 0; $pp < count($_usuario_pedidos); $pp++)
      {
        $_pedido_dados = $_usuario_pedidos[$pp];
        
        if($pp%2==0){$stripeRow=0;}else{$stripeRow=1;}
        echo '<div class="row stripe-'.$stripeRow.'">';  
        
        $_id_pedido = $_pedido_dados['id_pedido'];
        
        //busca itens do pedido
        $_pedido_itens = perfilItensPedCli($_uidUsuario,$_pedido_dados['id_pedido']);
        
        if($_pedido_itens==false){
          echo '<div class="col-md-12 rowDet">Nenhum item para este pedido!</div>';
        }
        else
        {
          if(count($_pedido_itens)==0){
            echo '<div class="col-md-12 rowDet">Nenhum item para este pedido!!</div>';
          }else{
            
            for ($ip = 0; $ip < count($_pedido_itens); $ip++)
            {
              $_dados_itens_pedido = $_pedido_itens[$ip];
              
              //dados do item do servico(id_item)
              $_dados_do_servico  = perfilDetServico($_dados_itens_pedido['id_item']);
              $_id_cli_dependente = $_dados_itens_pedido['id_cliente_dependente'];
              $_dados_dependente  = perfilDependenteById($_id_cli_dependente);
              
              if($ip==0){
                echo '<div class="col-md-6 rowDet"><b>('.count($_pedido_itens).')'.$_dados_do_servico['nome_servico'].' '.$_dados_do_servico['modalidade_servico'].'</b></div>';
                if(count($_pedido_itens)>1){
                  echo '<div class="col-md-6 rowDet"><i class="fas fa-star" style="color:#FFDA00;"></i>'.$_usuarioData['nome_usuario'].' '.$_usuarioData['sobrenome_usuario'].'</div>';
                }else{
                  echo '<div class="col-md-6 rowDet"><a href="#'.$_id_cli_dependente.'">'.$_dados_dependente['nome_cliente'].' '.$_dados_dependente['sobrenome_cliente'].'</a></div>';
                }
              }else{
                echo '<div class="col-md-6 rowDet"><a href="#'.$_id_cli_dependente.'">'.$_dados_dependente['nome_cliente'].' '.$_dados_dependente['sobrenome_cliente'].'</a></div>';
              }
              
            }

          }
        
        }
        
        echo '</div>';      
      }
    }
    ?>
    
    </div>





    <div id="row_contratos" class="collapse show">
      <div class="row stripe-0">
        <div class="col-md-6 rowDet"><b>(3)VISTO TURISMO EUA B-2  Adulto(s) +18 anos</b></div>
        <div class="col-md-6 rowDet"><i class="fas fa-star" style="color:#FFDA00;"></i>Roberto Stzutski</div>
        <div class="col-md-6 rowDet"><a href="#92">Bianca Souza</a></div>
        <div class="col-md-6 rowDet"><a href="#93">Manuela Souza</a></div>
      </div>
      <div class="row stripe-1">
        <div class="col-md-6 rowDet"><b>(1)VISTO TURISMO EUA B-2 Menores(s) até 17 anos</b></div>
        <div class="col-md-6 rowDet"><a href="#116">Bruna Ribeiro</a></div>
      </div>    
    </div>
     <hr />
