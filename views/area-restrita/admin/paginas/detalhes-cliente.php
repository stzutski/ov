<?php 


echo boxColapse();
foreach ($cli as $key => $value) {
  echo "{$key} => {$value}<br />\n";
}

echo boxColapse('footer');

?>


<div class="row">

  <div class="col-md-12">




    <div class="card">
    <div class="card-header">
        <h3>#<?php echo naNd($cli['id_usuario']);?> - <?php echo naNd($cli['nome_usuario']);?>  <?php echo naNd($cli['sobrenome_usuario']);?></h3>

        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" href="#">Resumo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pedidos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Faturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Arquivos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Dependentes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Status</a>
          </li>

        </ul>    
    
    
    </div>
    <div class="card-body">




<div class="row row-det-cli">

  <div class="col-md-3">
    <div class="card bxCli">
    <div class="card-header detCli">Informações</div>
    <div class="card-body iprof">
      <?php echo boxProfInfo('nome',naNd($cli['nome_usuario']));?>
      <?php echo boxProfInfo('Sobrenome',$cli['sobrenome_usuario']);?>
      <?php echo boxProfInfo('Email','<a href="mailto:'.naNd($cli['email_usuario']).'">'.naNd($cli['email_usuario']).'</a>');?>
      <?php echo boxProfInfo('End',naNd($end['endereco_cliente']));?>
      <?php echo boxProfInfo('Cidade',naNd($cli['nome_cidade']));?>
      <?php echo boxProfInfo('UF',naNd($end['uf_endereco_cliente']));?>
      <?php echo boxProfInfo('CEP',naNd($end['cep_endereco_cliente']));?>
      <?php echo boxProfInfo('País',naNd($end['pais_endereco_cliente']));?>
      <?php echo boxProfInfo('Cel.',$cli['telefone_usuario']);?>
    </div>
    </div>    
  </div>

  <div class="col-md-3">
    <div class="card bxCli">
    <div class="card-header detCli">
    Pedidos/Faturas
    </div>
    <div class="card-body iprof">
    <?php 
    logsys("TOTAIS DO CLIENTE: ".json_encode($_pedidosCli));
    ?>
    <?php echo boxProfInfo('Pedidos',arrayVar($_pedidosCli,'totalDePedidos'));?>
    <?php echo boxProfInfo('Pago','R$ '.moeda(arrayVar($_pedidosCli,'totalRecebido')));?>
    <?php echo boxProfInfo('Em Aberto','R$ '.moeda(arrayVar($_pedidosCli,'totalEmAberto')));?>
    </div>
    </div> 
    
    <div class="card bxCli">
    <div class="card-header detCli">
    Dependentes
    </div>
    <div class="card-body iprof">
    <?php 
    if(isSet($_dependentesCli) && count($_dependentesCli)>0){
      
      for ($i = 0; $i < count($_dependentesCli); $i++)
      {
        $_depData = $_dependentesCli[$i];
        logsys("dependentes: ".json_encode($_depData));
        echo boxProfInfo('',naNd($_depData['nome_cliente']).' '.naNd($_depData['sobrenome_cliente']));
      }
    }else{
      boxProfInfo('','N/D');
    }
    ?>
    </div>
    </div>     
       
  </div>


  <div class="col-md-3">
    <div class="card bxCli">
    <div class="card-header detCli">
    Produtos/Serviços
    </div>
    <div class="card-body iprof">
      
    <?php 
    logsys("Total de servicos contratados: ".json_encode($serv));
    for ($s = 0; $s < count($_servicosCli); $s++)
    {
      $iSrv = $_servicosCli[$s];
      echo boxProfInfo($iSrv['nome_servico'],$iSrv['modalidade_servico']);
    }
    ?>
    </div>
    </div>   
    
    <div class="card bxCli">
    <div class="card-header detCli">
    Arquivos
    </div>
    <div class="card-body iprof">
    <?php echo boxProfInfo('','<a href="#">Ficha Cadastral</a>');?>
    <?php echo boxProfInfo('','<a href="#">Cópia passaporte</a>');?>
    <?php echo boxProfInfo('','<a href="#">CNH</a>');?>
    </div>
    </div>   
    
    <div class="card bxCli">
    <div class="card-header detCli">
    Emails Recentes
    </div>
    <div class="card-body iprof">
    <?php echo boxProfInfo('','09/03/21 <a href="#">Pgto Confirmado</a>');?>
    <?php echo boxProfInfo('','08/03/21 <a href="#">Novo pedido</a>');?>
    <?php echo boxProfInfo('','07/03/21 <a href="#">Cadastro Confirmado</a>');?>
    </div>
    </div>   
    
    
     
  </div>


  <div class="col-md-3">
    <div class="card bxCli">
    <div class="card-header detCli">
    AÇÕES
    </div>
    <div class="card-body iprof">
    <?php echo boxProfInfo('','<a href="#">Ver mensagens</a>');?>
    <?php echo boxProfInfo('','<a href="#">Abrir ticket</a>');?>
    <?php echo boxProfInfo('','<a href="#">Adicionar Dependente</a>');?>
    <?php echo boxProfInfo('','<a href="#">Mesclar conta</a>');?>
    <?php echo boxProfInfo('','<a href="#">Encerrar conta</a>');?>
    </div>
    </div> 
    
    <div class="card bxCli">
    <div class="card-header detCli">
    Enviar Notificação de Tela
    </div>
    <div class="card-body iprof">

    <form>
    
      <div class="form-group">
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>    
    
    </form>
    <?php echo boxProfInfo('','&nbsp;&nbsp;Notificação 001<i class="fas fa-check-double" style="color:green;"></i>');?>
    <?php echo boxProfInfo('','&nbsp;&nbsp;Notificação 002<i class="fas fa-check-double" style="color:green;"></i>');?>
    <?php echo boxProfInfo('','&nbsp;&nbsp;Notificação 003<i class="fas fa-check-double" style="color:gray;"></i>');?>
    </div>
    </div>     
       
  </div>




</div>




    </div>
    </div> 

</div>
</div>
