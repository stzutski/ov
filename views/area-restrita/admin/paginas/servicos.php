lista de servicos333 (<?php echo $titulo;?>)

<?php 

//echo json_encode($listaServicos);

if(count($listaServicos)>0){

  for ($i = 0; $i < count($listaServicos); $i++)
  {
    echo "<hr />\n";
    $srv = $listaServicos[$i];
    foreach ($srv as $key => $value) {
      echo "{$key} => {$value}<br />";
    }
    
  }

}
