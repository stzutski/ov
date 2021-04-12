<?php
$m_item_cli = array();
$m_item_cli[] = '|Dashboard';
$m_item_cli[] = 'perfil-usuario|Meu Perfil';
$m_item_cli[] = 'categorias-servicos|Cat. Serviços';
$m_item_cli[] = 'servicos-disponiveis|Servicos';
$m_item_cli[] = 'servicos-detalhes/x|Det. Serv. X';
$m_item_cli[] = 'servicos-contratados|Meus Serviços';
$m_item_cli[] = 'minhas-faturas|Minhas Faturas';
$m_item_cli[] = 'pagar-fatura/xxxx|Pagar Fatura';
$m_item_cli[] = 'meus-arquivos|Meus Arquivos';
$m_item_cli[] = 'mensagens|Mensagens';
$m_item_cli[] = 'suporte-chat|Suporte';
$m_item_cli[] = 'suporte-videochat|Suporte Vídeo';
$m_item_cli[] = 'suporte-ticket|Suporte Ticket';
$m_item_cli[] =  URLAPP.'?u=logout|LOGOUT';


include('views/include-html/headers/cliente-header.php');?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
  <a class="navbar-brand" href="<?php echo URLAPP;?>">OBAVISTO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php echo mk_liMenu('<li class="nav-item"><a class="nav-link" href="{link}">{desc}</a></li>',$m_item_cli);?>
    </ul>
  </div>
</nav>

<div class="container-fluid">

  <div class="row">
  <div class="col-12">
  
  </div>
  </div>


  <div class="row">

      <div class="col-md-2 mainNav-admin d-none d-lg-block">

        <?php include('views/include-html/menus/cliente-menu-lateral.php');?>  
      
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">

        <div>
        <?php 
          if(isSet($incBody)){
            if(file_exists($incBody)){
              include ($incBody);
            }else{
              echo "<center><h5>Page body não LOCALIZADO<br />$incBody</h5></center>";
            }
          }else{
            echo "<center><h2>Page body não definido</h2></center>";
          } 
        ?>
        </div>

      </div>

  </div>

</div>

<?php include('views/include-html/footers/cliente-footer.php');?>
