<?php 

$argsTb['data'] = $lista_srv_empresa;
$argsTb['hf']   = '<tr><th width="50">ID</th><th>Nome / Modalidade</th></tr>';
$argsTb['idx']  = array('id_servico','nome_servico','modalidade_servico');
$argsTb['tpl']  = '<tr><td>{id_servico}</td><td><a href="adm-fases-servico/servico/{id_servico}">{nome_servico} ({modalidade_servico})</a></td></tr>';
$argsTb['zreg'] = '<tr><td colspan="2" class="text-center">Nenhum Registro Encontrado!</td></tr>';


echo mkCard('header','<h4>Administrar Fases</h4>');
echo '<div class="alert alert-success" role="alert">Clique sobre um serviço para administrar suas fases</div>';

$tbSrvs         = mkTable($argsTb);
echo '<div class="table-responsive">';
echo $tbSrvs;
echo '</div>';

echo mkCard('footer');
//rodape card

?>
