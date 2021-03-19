<br />
<div class="card">
  <div class="card-body">
<?php 
  
$_idFaseSelecionada = getVar('uidf');

    if($_idFaseSelecionada!=''){
    $btnADD = '<a href="adm-servicos/etapas?uide=0&opt=edit-etapa&uidf='.getVar('uidf').'" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="far fa-plus-square"></i> Nova etapa</a>';
    echo alertBox(''.$btnADD.'','info');
    }

  

  //campo select com a lista de etapas
  require_once(ADMINVIEWS.'elementos/selects/selectEtapas.adm-servicos.php');
  
  

if($_idFaseSelecionada==''){
  
  echo alertBox('Selecione um FASE para visualizar suas ETAPAS','warning');

}
else
{

$_data_listaEtapas = dbf('SELECT * FROM servicos_fases_etapas WHERE id_fase = :id_fase ORDER BY zorder_etapa ASC',array(':id_fase'=>$_idFaseSelecionada),'fetch');





  if(count($_data_listaEtapas)==0){
  
    echo 'Nenhuma etapa encontrada para a fase selecionado!';
    
  }
  else
  {

  //echo alertBox('Clique e arraste para alterar a ordem. Clique em <i class="fas fa-pencil-alt"></i> para alterar.','info');
  echo '<small><i class="fas fa-pencil-alt text-primary"></i>Edita serviço &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#940000;"><i class="fas fa-square"></i> Inativo</span> - <span style="color:#333333;"><i class="fas fa-square"></i> Ativo</span></small>';

  $_tagLE  = '';
  $_tagLE .= '<ul class="list-group zorder" id="listaEtapas" data-table="etapasServ" data-url="'.URLAPP.'ajx" data-ids="'.$_idFaseSelecionada.'">'."\n";

  for ($i = 0; $i < count($_data_listaEtapas); $i++)
  {
    
    $_data    = $_data_listaEtapas[$i];
    
    $_tagLE  .= '<li id="etapasServ_'.$_data['id_etapa'].'" class="list-group-item">'.$_data['nome_etapa'].'
    <span style="float:right">
    <a href="adm-servicos/etapas?uide='.$_data['id_etapa'].'&opt=edit-etapa&uidf='.getVar('uidf').'">
    <i class="fas fa-pencil-alt"></i>
    </a>
    </span>
    </li>'."\n";    
  }

  $_tagLE .= '</ul>'."\n";
  
  echo $_tagLE;
  }

}

?>

  </div>
</div>
