categorias de serviços disponiveis

<?php 

$tag  ='<ul class="lista-cat-servicos">';

  foreach ($lista_categorias as $value) {
    $item = $value;
    $tag .= "<li><a href=\"contratar/servico/$item[id_categoria]\">$item[nome_categoria_servico]</a></li>";
  }

$tag  .='</ul>';


echo $tag;

?>
