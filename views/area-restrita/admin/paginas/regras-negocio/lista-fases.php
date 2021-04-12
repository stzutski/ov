<br />
<?php 
$_idServicoSelecionado = getVar('uids');

    if($_idServicoSelecionado!=''){
    $btnADD = '<a href="adm-servicos/fases?uidf=0&opt=edit-fase&uids='.getVar('uids').'" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="far fa-plus-square"></i> Nova fase</a>';
    echo alertBox(''.$btnADD.'','info');
    }


    $args['query']  = 'SELECT id_servico,nome_servico,modalidade_servico FROM servicos ORDER BY nome_servico ASC';






  //BUSCA LISTA DE SERVICOS CADASTRADOS
  $_dataServicos  = dbf('SELECT id_servico,nome_servico,modalidade_servico,status_servico 
                        FROM servicos WHERE status_servico = 1 ORDER BY nome_servico ASC','','fetch');
  $_optSrv=array();
  if(count($_dataServicos)>0){
      for ($i = 0; $i < count($_dataServicos); $i++)
      {
        $_dataS         = $_dataServicos[$i];
        $idS            = $_dataS['id_servico'];
        $nmS            = $_dataS['nome_servico'].' ('.$_dataS['modalidade_servico'].')';
        $_optSrv[$idS]  = $nmS;
      }
      $_lgSelect = 'Selecione um serviços para visualizar suas fases';
  }
  else
  {
      $_lgSelect = '<span class="text-danger">Não existem servicos ATIVOS</span>';
  }
  
  $selectServicos = f_select('',
                            'optIdService',
                            'optIdService',
                            $_optSrv,
                            $_idServicoSelecionado,
                            false,
                            $_lgSelect,
                            'jumpTo',
                            'data-go="'.URLAPP.'adm-servicos/fases?uids="');
  echo $selectServicos;
  
  


if($_idServicoSelecionado==''){
  
  echo alertBox('Selecione um serviço para ver suas fases','warning');
  
}
else
{

  $_data_listaFases = dbf('SELECT * FROM servicos_fases WHERE id_servico = :id_servico ORDER BY zorder_fase ASC',array(':id_servico'=>$_idServicoSelecionado),'fetch');

  if(count($_data_listaFases)==0){
  
    echo 'Nenhuma fase encontrada para o servico selecionado!';
    
  }
  else
  {

  //echo alertBox('Clique e arraste para alterar a ordem, clique em <i class="fas fa-stream"></i> para as suas etapas da fase. Clique em <i class="fas fa-pencil-alt"></i> para alterar.','info');
  echo '<small><i class="fas fa-stream text-primary"></i> Visualiza Etapas &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fas fa-pencil-alt text-primary"></i> Edita serviço &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#940000;"><i class="fas fa-square"></i> Inativo</span> - <span style="color:#333333;"><i class="fas fa-square"></i> Ativo</span></small>';
  
  $_dUteis=0;
  $_tagLF  = '';
  $_tagLF .= '<ul class="list-group zorder" id="listaFases" data-table="faseServ" data-url="'.URLAPP.'ajx" data-ids="'.$_idServicoSelecionado.'">'."\n";

  for ($i = 0; $i < count($_data_listaFases); $i++)
  {
    $_data    = $_data_listaFases[$i];
    $_dUteis  = $_dUteis+$_data['prazo_fase'];
    $_tagLF  .= '<li id="faseServ_'.$_data['id_fase'].'" class="list-group-item" title="Prazo em dia(s): '.$_data['prazo_fase'].'">
    <a href="adm-servicos/etapas?uidf='.$_data['id_fase'].'" title="Ver Etapas">
    <i class="fas fa-stream"></i>
    </a>
    &nbsp;|&nbsp;
    '.$_data['nome_fase'].'
    <span style="float:right">
    <a href="adm-servicos/fases?uidf='.$_data['id_fase'].'&opt=edit-fase&uids='.getVar('uids').'">
    <i class="fas fa-pencil-alt"></i>
    </a>
    </span>
    </li>'."\n";
  }

  $_tagLF .= '<li class="list-group-item"><b>Prazo Total:</b> '.$_dUteis.' dia(s)</li>'."\n";
  $_tagLF .= '</ul>'."\n";
  
  echo $_tagLF;
  }


}
?>
