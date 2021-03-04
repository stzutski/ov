lista clientes
<b><?php echo $legenda;?></b>
<br />
Usuarios cadastrados<br />
<?php 

for ($i = 0; $i < count($_listaUsers); $i++)
{
  
  $users = $_listaUsers[$i];

  foreach ($users as $key => $value) {
    echo "Campo($key) => {$value}<br />\n";
  }  
    
  echo "<hr />\n";
  
}







?>
