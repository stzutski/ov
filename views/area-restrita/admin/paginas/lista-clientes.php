<h1>Clientes</h1>
<!--
lista clientes
<b><?php echo $legenda;?></b>
<br />
Usuarios cadastrados<br />
-->
<?php 
/*
for ($i = 0; $i < count($_listaUsers); $i++)
{
  
  $users = $_listaUsers[$i];

  foreach ($users as $key => $value) {
    echo "Campo($key) => {$value}<br />\n";
  }  
    
  echo "<hr />\n";
  http://localhost/labs/ov/detalhes-cliente/84
}*/


$argsTb['data'] = $_listaUsers;
$argsTb['hf']   = '<tr><th width="50" align="center">ID</th><th>Nome</th><th width="400">Telefone</th><th width="400">Email</th></tr>';
$argsTb['idx']  = array('id_usuario','id_cliente','nome_cliente','sobrenome_cliente','email_usuario','telefone_usuario');
$argsTb['tpl']  = '<tr><td align="center">{id_cliente}</td><td><a href="detalhes-cliente?uidu={id_usuario}">{nome_cliente} {sobrenome_cliente}</a></td><td>{telefone_usuario}</td><td>{email_usuario}</td></tr>';

$tbcli          = mkTable($argsTb);

echo '<div class="table-responsive"></div>';
echo $tbcli;
echo '</div>';
?>
