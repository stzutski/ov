<?php 





  //lista FASES do servico
  echo mkCard('header','<h4><a href="adm-fases-servico">Serviços</a> / '.$_data_srv[0]['nome_servico'].'&nbsp;&nbsp;'.btn(URLAPP.'add-fases-servico/servico/'.$idServico.'','+fase').'</h4>');

  echo '<div class="alert alert-success" role="alert">Clique e arraste para ordenar as Fases, clique no nome para alterar os dados</div>';

  if(isSet($lista_srv_empresa)){
    if(is_array($lista_srv_empresa)){
      echo '<ul id="listaFases" data-table="faseServ" data-ids="'.$idServico.'" data-url="'.URLAPP.'ajx" class="list-group zorder">';
      for ($i = 0; $i < count($lista_srv_empresa); $i++)
      {
        $srvData      = $lista_srv_empresa[$i];
        $uidFase      = $srvData['id_fase'];
        $uidServico   = $srvData['id_servico'];
        $nomeFase     = $srvData['nome_fase'];
        $strSrv       = "$nomeFase";
        echo '<li id="faseServ_'.$uidFase.'" class="list-group-item"><i class="fas fa-arrows-alt text-secondary"></i> <a href="adm-fases-servico/fase/'.$uidFase.'">'.$strSrv.'</a></li>';
      }
      echo '</ul>';
    }
  }


  echo mkCard('footer');
  //final da lista de fases
?>
