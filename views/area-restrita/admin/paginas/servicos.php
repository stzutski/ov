<?php 

//echo json_encode($listaServicos);

if(is_array($listaServicos)){

  if(count($listaServicos)>0){

    for ($i = 0; $i < count($listaServicos); $i++)
    {
      echo "<hr />\n";
      $srv = $listaServicos[$i];
      $nome_servico='';
      foreach ($srv as $key => $value) {
        if($key=='id_servico'){$nome_servico = $dbi_serv[$value]['nome_servico'];}else{$nome_servico='';}
        echo "{$key} => {$value} ($nome_servico)<br />";
      }
      
    }

  }

}
