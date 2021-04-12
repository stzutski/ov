<?php 
//php/models/admin/cloneserv.admin.model.php

if(postVar('go')=='cloneserv3'){

    if(getVar('ids')!=''){
    
    echo 'alert("Clonar ID: '.getVar('ids').'");';
    
    }
}
if(postVar('go')=='cloneserv'){

/*
 * clonagem de servicos
 * 1 recuperamos dados do servico ALVO
 * 2 recuperamos os dados de todas as fases do servico
 * 3 recuperamos todas as etapas das fases do servico alvo
 * 
 * 4 inserimos a copia do servico ALVO
 *  recuperamos o ID do servico recem cadastrado
 * 5 cadastramos as novas fases usando o ID do servico clonado
 * 6 cadastramos todas as etapas usando os IDs das fases cadastradas
 * 
 * */

$servico_clonado      = 0;
$servico_clonado_erro = 0;
$fase_clonada         = 0;
$fase_clonada_erro    = 0;
$etapa_clonada        = 0;
$etapa_clonada_erro   = 0;

//id_empresa
$idEMPRESA = decode(sessionVar('_iE'));

//id do servico alvo da clonagem
$id_clonar = getVar('ids');

//obter dados do servico a ser clonado
$servico_origem = dbf('SELECT * FROM servicos 
                      WHERE id_servico = :id_servico
                      AND id_empresa = :id_empresa',
                      array(':id_servico'=>$id_clonar,':id_empresa'=>$idEMPRESA),'fetch');

logsys("CLONE: dados do servico para clonar($id_clonar)::: ".json_encode($servico_origem));


if(is_array($servico_origem)){

//dados do servico de origem
$dt_serv = $servico_origem[0];

$clone_id_categoria       = $dt_serv['id_categoria'];
$clone_modalidade_servico = $dt_serv['modalidade_servico'];
$clone_nome_servico       = $dt_serv['nome_servico'] . ' - (CÓPIA '.date('dmyHis').')';
$clone_desc_servico       = $dt_serv['desc_servico'];
$clone_nomeplano_servico  = $dt_serv['nomeplano_servico'];
$clone_preco_servico      = $dt_serv['preco_servico'];
$clone_status_servico     = $dt_serv['status_servico'];


//cadastramos o servico clone e obtemos o ID dele
$add_clone_serv = dbf('INSERT INTO servicos (
                      id_empresa,id_categoria,modalidade_servico,nome_servico,desc_servico,nomeplano_servico,preco_servico,status_servico 
                      ) VALUES (
                      :id_empresa,:id_categoria,:modalidade_servico,:nome_servico,:desc_servico,:nomeplano_servico,:preco_servico,:status_servico
                      )',array(
                      ':id_empresa'=>$idEMPRESA,
                      ':id_categoria'=>$clone_id_categoria,
                      ':modalidade_servico'=>$clone_modalidade_servico,
                      ':nome_servico'=>$clone_nome_servico,
                      ':desc_servico'=>$clone_desc_servico,
                      ':nomeplano_servico'=>$clone_nomeplano_servico,
                      ':preco_servico'=>$clone_preco_servico,
                      ':status_servico'=>$clone_status_servico));

}//final clonar servico

//caso servico tenha sido clonado com sucesso                      
if($add_clone_serv>0){
  logsys("CLONE: SERVICO ID($id_clonar) CLONADO COM SUCESSO::: novo ID(".$add_clone_serv.")");
  $servico_clonado++;
  
  //id do clone(servico)
  $id_clone_servico = $add_clone_serv;
  
  //lista todas fases do servico de origem
  $fases_origem = dbf('SELECT * FROM servicos_fases 
                        WHERE id_servico = :id_servico
                        AND id_empresa = :id_empresa',
                        array(
                        ':id_servico'=>$id_clonar,
                        ':id_empresa'=>$idEMPRESA),'fetch');


  
  $tot_fases = count($fases_origem);

  logsys("CLONE: Total de Fases para Clonar::: (".$tot_fases.")");
  logsys("CLONE: dados das fases para clonar::: ".json_encode($fases_origem));
  
  if(is_array($fases_origem) && count($fases_origem)>0){
    
    //laco com as fases do servico de origem
    for ($f = 0; $f < count($fases_origem); $f++)
    {
      //dados da fase
      $dados_fase         = $fases_origem[$f];
      
      $id_fase_para_clonar=$dados_fase['id_fase'];
      
      $clone_id_servico   = $id_clone_servico;
      $clone_id_empresa   = $dados_fase['id_empresa'];
      $clone_nome_fase    = $dados_fase['nome_fase'];
      $clone_desc_fase    = $dados_fase['desc_fase'];
      $clone_prazo_fase   = $dados_fase['prazo_fase'];
      $clone_zorder_fase  = $dados_fase['zorder_fase'];
      $clone_status_fase  = $dados_fase['status_fase'];


      //cadastro da fase clone
      $add_clone_fase = dbf('INSERT INTO servicos_fases 
      (id_servico, id_empresa, nome_fase, desc_fase, prazo_fase, zorder_fase, status_fase) 
      VALUES 
      (:id_servico, :id_empresa, :nome_fase, :desc_fase, :prazo_fase, :zorder_fase, :status_fase)',
      array(
      ':id_servico'=>$id_clone_servico,
      ':id_empresa'=>$clone_id_empresa,
      ':nome_fase'=>$clone_nome_fase,
      ':desc_fase'=>$clone_desc_fase,
      ':prazo_fase'=>$clone_prazo_fase,
      ':zorder_fase'=>$clone_zorder_fase,
      ':status_fase'=>$clone_status_fase));
      
      //caso fase clonada com sucesso
      if($add_clone_fase>0){//id da fase recem cadastrada
        logsys("CLONE: FASE ID($id_fase_para_clonar) CLONADA COM SUCESSO::: novo ID(".$add_clone_fase.")");
        $fase_clonada++;
        
        //id da clone(fase)
        $id_clone_fase = $add_clone_fase;//id da fase recem cadastrada
        
        
        //listamos todas etapas da fase de origem
        //$id_fase_para_clonar
        $etapas_origem = dbf('SELECT * FROM servicos_fases_etapas
                          WHERE id_fase = :id_fase AND id_empresa = :id_empresa',
                          array(':id_fase'=>$id_fase_para_clonar,':id_empresa'=>$idEMPRESA),'fetch');

        $tot_etapas = count($etapas_origem);
        logsys("CLONE: Total de Etapas para Clonar::: (".$tot_etapas.")");
        logsys("CLONE: dados das Etapas para clonar::: ".json_encode($etapas_origem));
                          
        if(is_array($etapas_origem) && count($etapas_origem)>0){
        //laco com as estapa da fase de origem
        
          //laco clonagem etapas
          for ($e = 0; $e < count($etapas_origem); $e++)
          {
            //dados da etapa
            $dados_etapa        = $etapas_origem[$e];
            //$clone_id_fase      = $id_clone_fase;
            $id_etapa_origem    = $dados_etapa['id_etapa'];
            $clone_id_empresa   = $dados_etapa['id_empresa'];
            $clone_tipo_etapa   = $dados_etapa['tipo_etapa'];
            $clone_nome_etapa   = $dados_etapa['nome_etapa'];
            $clone_desc_etapa   = $dados_etapa['desc_etapa'];
            $clone_zorder_etapa = $dados_etapa['zorder_etapa'];
            $clone_status_etapa = $dados_etapa['status_etapa'];

            //cadastro da etapa clone
            $add_clone_etapa = dbf('INSERT INTO servicos_fases_etapas 
            (id_fase, id_empresa, tipo_etapa, nome_etapa, desc_etapa, zorder_etapa, status_etapa)
            VALUES
            (:id_fase, :id_empresa, :tipo_etapa, :nome_etapa, :desc_etapa, :zorder_etapa, :status_etapa)',
            array(
            ':id_fase'      =>  $id_clone_fase,
            ':id_empresa'   =>  $clone_id_empresa,
            ':tipo_etapa'   =>  $clone_tipo_etapa,
            ':nome_etapa'   =>  $clone_nome_etapa,
            ':desc_etapa'   =>  $clone_desc_etapa,
            ':zorder_etapa' =>  $clone_zorder_etapa,
            ':status_etapa' =>  $clone_status_etapa));
            
            if($add_clone_etapa>0){
              logsys("CLONE: ETAPA ID($id_etapa_origem) CLONADA COM SUCESSO::: novo ID(".$add_clone_etapa.")");
              $etapa_clonada++;
            }
            else
            {
              $etapa_clonada_erro++;
            }
            
          }//final do loop clonar etapas
        
        }//fim laco de etapas da fase de origem
        
      }else{$fase_clonada_erro++;}//fim (IF fase clonada) com sucesso
      /*fase clonada*/
      
    }//final do loop clonar fases
  
  }//final lista de fases
  
}else{$servico_clonado_erro++;}//final clonar fases                      
/*servico clonado*/

}//final if post

/*
$resalert =  "Servicos: $servico_clonado
              Servicos: $servico_clonado_erro
              Fases: $fase_clonada
              Servicos: $fase_clonada_erro
              Etapas: $etapa_clonada
              Servicos: $etapa_clonada_erro"
*/


$resAlert =  "(1) Srvs Clonados: $servico_clonado\n
              ($tot_fases) Fases Clonadas: $fase_clonada\n
              ($tot_etapas) Etapas Clonadas: $etapa_clonada";


echo 'alert("'.$resAlert.'");location.reload();';






?>
