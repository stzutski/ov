<div class="card">
    <div class="card-header">
    <h3>Nome do cliente</h3>
      
      <?php $_uidUsuario = getVar('uidu');?>
      
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/nav-tabs.php');?>
    
    </div>
    
    <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/funcoes-detalhes.php');?>
    
    <div class="card-body">
     <div class="detcli">

    <?php if(getVar('opt')=='' || getVar('opt')=='resumo'){?>


      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/dados-cadastrais.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/pedidos-e-faturas.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/contratos-e-dependentes.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/arquivos-recentes.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/mensagens-recentes.php');?>
        
    <?php }else{
    
    $pg_detalhes = ADMINVIEWS.'paginas/detalhes-cliente/' . getVar('opt') . '-detcli.php';
    
    if(file_exists($pg_detalhes)){
      //echo getVar('opt');
      include_once($pg_detalhes);
    }
      
    }
    ?>
        
        
     </div>
    </div>
    <div class="card-footer">
    Rodape
    </div>
</div>
