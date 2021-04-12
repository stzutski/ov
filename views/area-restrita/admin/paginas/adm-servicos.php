<?php 
$_title='';
if(isSet($moduloregra)&&$moduloregra=='cat-serv') {$_title = ' - Categorias de serviço';}
if(isSet($moduloregra)&&$moduloregra=='servicos') {$_title = ' - Serviços';}
if(isSet($moduloregra)&&$moduloregra=='fases')    {$_title = ' - Fases do serviço';}
if(isSet($moduloregra)&&$moduloregra=='etapas')   {$_title = ' - Etapas da fase';}
if(isSet($moduloregra)&&$moduloregra=='modelos')   {$_title = ' - Modelos';}

echo mkCard('header','<h4>Regras do Negócio'.$_title.'</h4>');
?>


<?php require( ADMINVIEWS.'paginas/regras-negocio/nav-tabs.php');?>


  <?php 
  //LISTA COM AS FASES DE SERVICOS
  if(getVar('opt')==''){
      
      //TABELA COM A LISTA DE SERVICOS
      if(isSet($moduloregra)&&$moduloregra=='cat-serv'){
        require( ADMINVIEWS . 'paginas/regras-negocio/lista-categorias-servicos.php');
      }  
      
      //TABELA COM A LISTA DE SERVICOS
      if(isSet($moduloregra)&&$moduloregra=='servicos'){
        require( ADMINVIEWS . 'paginas/regras-negocio/lista-servicos.php');
      }  
   
      //LISTA COM AS FASES DO SERVICO
      if(isSet($moduloregra)&&$moduloregra=='fases'){
        require( ADMINVIEWS . 'paginas/regras-negocio/lista-fases.php');
      }
      
      //LISTA COM AS ETAPAS DAS FASES DE SERVICOS
      if(isSet($moduloregra)&&$moduloregra=='etapas'){
        require( ADMINVIEWS . 'paginas/regras-negocio/lista-etapas.php');
      }

      //LISTA ESTRUTURADA COM O MODELO DE UM NEGOCIO
      if(isSet($moduloregra)&&$moduloregra=='modelos'){
        require( ADMINVIEWS . 'paginas/regras-negocio/lista-modelo.php');
      }      
  
  }
  if(getVar('opt')=='edit-cat-serv'){
    
    require( ADMINVIEWS . 'paginas/regras-negocio/forms/form-categoria-servico.php');
    
  }
  if(getVar('opt')=='edit-servico'){
    
    require( ADMINVIEWS . 'paginas/regras-negocio/forms/form-servico.php');
    
  }
  if(getVar('opt')=='edit-fase'){
    
    require( ADMINVIEWS . 'paginas/regras-negocio/forms/form-fases.php');
    
  }
  if(getVar('opt')=='edit-etapa'){
    
    require( ADMINVIEWS . 'paginas/regras-negocio/forms/form-etapas.php');
  
  }
  


?>


<?php 

function servOrf($tb1,$tb2,$idRow,$vaRow,$url,$textAlert='Registros órfãos'){
  $_tagAlert=false;
  $res      = dbf('SELECT id_servico,id_categoria,nome_servico,modalidade_servico
                  FROM   servicos
                  WHERE  id_empresa = :id_empresa
                  AND id_categoria NOT IN (
                  SELECT DISTINCT id_categoria
                  FROM   servicos_categorias)',
                  array(
                  ':id_empresa'=>decode( sessionVar('_iE') ) ) ,'fetch');
  
  $_tagAlert='';
  if(count($res)>0){
    $_tagAlert .= boxColapse('header',' Registros órfãos');
    $_tagAlert .= alertBox($textAlert,'warning');
    $_tagAlert .= '<ul  class="list-group list-group-flush">'."\n";
      for ($i = 0; $i < count($res); $i++)
      {
        $data = $res[$i];
        $id = $data[$idRow];
        $nm = $data[$vaRow];
        $_tagAlert .= '<li class="list-group-item"><i class="fas fa-unlink"></i> <a href="'.$url.$id.'">'.$nm.'</a></li>'."\n";
      }
    $_tagAlert .= '</ul>'."\n";
    $_tagAlert .= boxColapse('footer');
  }
  return $_tagAlert;
}


//Alguns serviços não possuem categoria, clique sobre o item para associá-lo a uma categoria


echo servOrf('clientes',' servicos_categorias','id_servico','nome_servico','adm-servicos/servicos','Alguns serviços não possuem categoria, clique sobre o item para associá-lo a uma categoria');

//botao clonar servico
$btn_clonar = '';
if(getVar('opt')=='edit-servico' && getVar('uids')!=''){
$btn_clonar = '<button class="btn btn-default btn-clone" data-procurl="'.URLAPP.'ajx?ids='.getVar('uids').'"><i class="far fa-clone fa-xs"></i></button>';
}

if(!isSet($_btn_removeFooterForm)){$_btn_removeFooterForm='&nbsp;';}
echo mkCard('footer','','<div class="card-footer text-muted">'.$btn_clonar.$_btn_removeFooterForm.'</div>');
?>
