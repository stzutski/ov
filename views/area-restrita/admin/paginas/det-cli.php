<div class="card">
    <div class="card-header">
    <h3>Nome do cliente</h3>
      
      <?php $_uidUsuario = getVar('uidu');?>
      
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/nav-tabs.php');?>
    
    </div>
    
    <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/funcoes-detalhes.php');?>
    
    <div class="card-body">
     <div class="detcli">

      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/dados-cadastrais.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/pedidos-e-faturas.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/contratos-e-dependentes.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/arquivos-recentes.php');?>
     <hr />
      <?php include_once(ADMINVIEWS.'paginas/detalhes-cliente/mensagens-recentes.php');?>
        
     </div>
    </div>
    <div class="card-footer">
    Rodape
    </div>
</div>
