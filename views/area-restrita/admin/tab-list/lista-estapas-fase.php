<?php 


  //btn(URLAPP.'add-servico/categoria/'.$idCategoria.'','+Servico para esta categoria')
  
  //lista ETAPAS DA FASE do servico
  echo mkCard('header','<h4><a href="adm-fases-servico">Etapas</a> '.btn(URLAPP.'add-servico/categoria/'.$idFase.'','+etapa','btn btn-primary').'</h4>');

  /*
  id_etapa
  id_fase
  id_empresa
  tipo_etapa
  nome_etapa
  desc_etapa
  zorder_etapa
  status_etapa 
  */
  echo '<div class="alert alert-success" role="alert">Clique e arraste para ordenar as Etapas, clique no nome para alterar os dados</div>';

  if(isSet($lista_etapaFase)){
    if(is_array($lista_etapaFase)){
      echo '<ul id="listaEtapas" data-table="etapaServ" data-ids="'.$idFase.'" data-url="'.URLAPP.'ajx" class="list-group zorder">';
      for ($i = 0; $i < count($lista_etapaFase); $i++)
      {
        $srvData      = $lista_etapaFase[$i];
        $uidEtapa     = $srvData['id_etapa'];
        $tipoEtapa    = $srvData['tipo_etapa'];
        $nomeEtapa    = $srvData['nome_etapa'];
        $strSrv       = "$nomeEtapa";
        echo '<li id="etapaServ_'.$uidEtapa.'" class="list-group-item"><i class="fas fa-arrows-alt text-secondary"></i> <a href="adm-fases-servico/etapa/'.$uidEtapa.'">'.$strSrv.'</a></li>';
      }
      echo '</ul>';
    }
  }

  echo mkCard('footer');
  //final da lista de fases  

?>
