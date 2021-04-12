<?php 
$tbarr=array();
if(getVar('opt')!=''){
  $tbActive[ getVar('opt') ]  = ' active';
}else{
  $tbActive['resumo']  = ' active';  
}

$url_tab = URLAPP . 'detalhes-cliente?uidu=' . getVar('uidu');

?>

    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'resumo');?>" href="<?php echo $url_tab;?>&opt=resumo">Resumo</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'processos');?>" href="<?php echo $url_tab;?>&opt=processos">Processo(s)  <span class="badge badge-secondary">3</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'pedidos');?>" href="<?php echo $url_tab;?>&opt=pedidos">Pedidos <span class="badge badge-secondary">2</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'faturas');?>" href="<?php echo $url_tab;?>&opt=faturas">Faturas <span class="badge badge-secondary">2</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'mensagens');?>" href="<?php echo $url_tab;?>&opt=mensagens">Mensagens <span class="badge badge-pill badge-warning">2 novas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link<?php echo arrayVar($tbActive,'arquivos');?>" href="<?php echo $url_tab;?>&opt=arquivos">Arquivos <span class="badge badge-pill badge-warning">6 arquivos</span></a>
      </li>
    </ul>     
