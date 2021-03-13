<?php 
use \db\Sql;
use \db\ProcSql;
use \db\Dbi;
use admin\servicos\Servicos;


//rotinas de processamento de servicos
if(postVar('do')=='saveCat'){
  
  if(postVar('uid')!='' && postVar('uid')!='0'){
    $sql = new Sql();
    $res = $sql->query('UPDATE servicos_categorias SET
                        nome_categoria_servico = :nome_categoria_servico,
                        desc_categoria_servico = :desc_categoria_servico,
                        img_categoria_servico = :img_categoria_servico,
                        status_categoria_servico = :status_categoria_servico
                        WHERE id_categoria = :id_categoria
                        AND id_empresa = :id_empresa',array(
                        ':nome_categoria_servico'   =>  postVar('nomeCat'),
                        ':desc_categoria_servico'   =>  postVar('descCat'),
                        ':img_categoria_servico'    =>  postVar('imgCat'),
                        ':status_categoria_servico' =>  postVar('statusCat'),
                        ':id_categoria'             =>  postVar('uid'),
                        ':id_empresa'               =>  decode(sessionVar('_iE'))));
    
    if($res>0){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      $app->redirect(URLAPP .'cat-servicos/' . postVar('uid'));
    }
    
  }elseif(postVar('uid')=='0'){
    
    
    $sql = new Sql();
    $res = $sql->query('INSERT servicos_categorias SET
                        nome_categoria_servico = :nome_categoria_servico,
                        desc_categoria_servico = :desc_categoria_servico,
                        img_categoria_servico = :img_categoria_servico,
                        status_categoria_servico = :status_categoria_servico,
                        id_empresa = :id_empresa',array(
                        ':nome_categoria_servico'   =>  postVar('nomeCat'),
                        ':desc_categoria_servico'   =>  postVar('descCat'),
                        ':img_categoria_servico'    =>  postVar('imgCat'),
                        ':status_categoria_servico' =>  postVar('statusCat'),
                        ':id_empresa'               =>  decode(sessionVar('_iE'))));
    
    if($res>0){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      $app->redirect(URLAPP .'cat-servicos/' . $res);
    }
    
  }
  
  
}elseif(postVar('do')=='saveService'){
  
  if(postVar('uid')!='' && postVar('uid')!='0'){
    $sql = new Sql();
    $res = $sql->query('UPDATE servicos SET
                        nome_servico        = :nome_servico,
                        modalidade_servico  = :modalidade_servico,
                        desc_servico        = :desc_servico,
                        preco_servico       = :preco_servico,
                        status_servico      = :status_servico
                        WHERE id_servico    = :id_servico',array(
                        ':nome_servico'=>postVar('nomeServico'),
                        ':modalidade_servico'=>postVar('modServico'),
                        ':desc_servico'=>postVar('descServico'),
                        ':preco_servico'=>toFloat(postVar('precoServico')),
                        ':status_servico'=>postVar('statusServ'),
                        ':id_servico'=>postVar('uid')));
    
    if($res>=0){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      $app->redirect(URLAPP .'cat-servicos/' . postVar('uidCategoria'));//cat-servicos/
    }
  
  }elseif(postVar('uid')!='' && postVar('uid')=='0'){
    
    logsys("CADASTRANDO NOVO SERVICO :::");
    logsys("CADASTRAR DADOS DO NOVO SERVICO ::: ".json_encode($_POST));
    
    $sql = new Sql();
    $res = $sql->query('INSERT servicos SET
                        id_empresa          = :id_empresa,
                        id_categoria        = :id_categoria,
                        modalidade_servico  = :modalidade_servico,
                        nome_servico        = :nome_servico,
                        desc_servico        = :desc_servico,
                        preco_servico       = :preco_servico,
                        status_servico      = :status_servico',array(
                        ':id_empresa'         =>decode(sessionVar('_iE')),
                        ':id_categoria'       =>postVar('uidCategoria'),
                        ':modalidade_servico' =>postVar('modServico'),
                        ':nome_servico'       =>postVar('nomeServico'),
                        ':desc_servico'       =>postVar('descServico'),
                        ':preco_servico'      =>toFloat(postVar('precoServico')),
                        ':status_servico'     =>postVar('statusServ')));
    
    if($res>0){
      $_SESSION['_msg'] = 'Processado Com Sucesso';
      $app->redirect(URLAPP .'cat-servicos/' . postVar('uidCategoria'));
    }
    
  }
  
}else{

  $_servicos      = new Servicos();
  $_dbi           = new Dbi();
  $dbi_serv       = $_dbi->dbi_servicos();
  logsys("array servicos: ".json_encode($dbi_serv));
  
  $listaServicos  = $_servicos->getListServices();

  $titulo_servicos = 'eita';





}
?>
