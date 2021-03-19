<?php 
/*
id_servico 
id_empresa
id_categoria
modalidade_servico
nome_servico
desc_servico
nomeplano_servico
preco_servico
status_servico 
*/

//listamos todos os servicos disponiveis na empresa
if(!isSet($idServico)&&!isSet($idFase)&&!isSet($idEtapa)){
  
  //include tabela com a lista de servicos com fases
  include_once('views/area-restrita/admin/tab-list/lista-servicos-fases.php');

}
//caso servico selecionado exibe fases do servico 
elseif(!isSet($idFase) && !isSet($idEtapa) && isSet($idServico) && $idServico!=''){

  //include FORM PARA CADASTRO DE NOVA FASE para o servico selecionado
  //include_once('views/area-restrita/admin/forms/form-add-fase-servico.php');

  //espacamento
  //echo '<br /><br />';

  //include com a lista de fases do servico selecionado
  include_once('views/area-restrita/admin/tab-list/lista-fases-servico.php');
  
}
//SE ID FASE INFORMADO E MAIOR QUE ZERO carrega formulario para edicao da fase do servico selecionada
elseif(isSet($idFase)&&$idFase>0){

  //include para FORMULARIO DE EDICAO da FASE SELECIONADA
  include_once('views/area-restrita/admin/forms/form-fase-servico.php');

  //espacamento
  echo '<br /><br />';
  
  //include com a lista de ETAPAS DA FASE selecionada
  include_once('views/area-restrita/admin/tab-list/lista-estapas-fase.php');  
  
}
//SE ID ETAPA INFORMADO E MAIOR QUE ZERO carrega formulario para edicao da etapa da fase selecionada
elseif(isSet($idEtapa)&&$idEtapa>0){


  //include para FORMULARIO DE EDICAO da ETAPA SELECIONADA
  include_once('views/area-restrita/admin/forms/form-etapa-fase.php');
  
  
}

?>
<h1>asd</h1>
