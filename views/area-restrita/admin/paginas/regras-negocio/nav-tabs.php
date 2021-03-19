<?php 
$tab[$moduloregra] = 'active';
?>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo arrayVar($tab,'cat-serv');?>" href="adm-servicos/cat-serv">Categorias</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo arrayVar($tab,'servicos');?>" href="adm-servicos/servicos">Serviços</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo arrayVar($tab,'fases');?>" href="adm-servicos/fases">Fases</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo arrayVar($tab,'etapas');?>" href="adm-servicos/etapas">Etapas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo arrayVar($tab,'modelos');?>" href="adm-servicos/modelos">Modelo</a>
  </li>
</ul>
