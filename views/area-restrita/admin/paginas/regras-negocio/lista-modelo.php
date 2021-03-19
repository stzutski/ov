<?php 
  $_idCat_selecionada = getVar('uidcs');

require_once(ADMINVIEWS.'elementos/selects/selectModelos.adm-servicos.php');

if($_idCat_selecionada==''){
  
  echo alertBox('Selecione uma categoria para visualizar os modelos','warning');
  
}
else
{
  
  $_idCat_selecionada = getVar('uidcs');
  $uid_categoria      = 1;
  $uid_empresa        = decode( sessionVar('_iE') ) ;

  $cats = dbf('SELECT * FROM servicos_categorias 
              WHERE id_categoria = :id_categoria AND id_empresa = :id_empresa',
              array(':id_categoria'=>$_idCat_selecionada,':id_empresa'=>$uid_empresa) ,'fetch');

  //LISTA CATEGORIAS CADASTRADAS
  for ($c = 0; $c < count($cats); $c++)
  {
    echo "<div class=\"card\">\n";
    echo "<ul class=\"lista-modelo-regra\">\n";    
    
    $data     = $cats[$c];
    $id_cat   = $data['id_categoria'];
    $nome_cat = $data['nome_categoria_servico'];
    
    
    echo "<li><h3><i class=\"fa fa-box fa-xs\"></i> <a href=\"adm-servicos/cat-serv?opt=edit-cat-serv&uidcs=$id_cat\">$nome_cat</a></h3></li>\n";

    
    $serv = dbf('SELECT * FROM servicos WHERE id_categoria = :id_categoria AND id_empresa = :id_empresa ORDER BY id_categoria ASC',
                array(':id_categoria'=>$id_cat,':id_empresa'=>$uid_empresa),'fetch');

      if(count($serv)>0){
        
      echo "<ul class='indent-20'>\n";

        //LISTA SERVICOS
        for ($s = 0; $s < count($serv); $s++)
        {
          $data_s     = $serv[$s];
          $id_serv    = $data_s['id_servico'];
          $nome_serv  = $data_s['nome_servico'];
          echo "<li style=\"color:#036;\"><h4><i class=\"fas fa-cube fa-xs\"></i> <a href=\"adm-servicos/servicos?uidcs=$id_cat&opt=edit-servico&uids=$id_serv\">$nome_serv</a></h4></li>\n";
          
          
          $fases = dbf('SELECT * FROM servicos_fases WHERE id_servico = :id_servico AND id_empresa = :id_empresa ORDER BY zorder_fase ASC',
                      array(':id_servico'=>$id_serv,':id_empresa'=>$uid_empresa) ,'fetch');
          
          if(count($fases)>0){
          echo "<ul class='indent-20'>\n";
          
          
            //LISTA FASES
            for ($f = 0; $f < count($fases); $f++)
            {
              
              $data_f     = $fases[$f];
              $id_fase    = $data_f['id_fase'];
              $nome_fase  = $data_f['nome_fase'];
              echo "<li><h5><i class=\"far fa-square fa-xs\"></i> <a href=\"adm-servicos/fases?uidf=$id_fase&opt=edit-fase&uids=$id_serv\">$nome_fase</a></h5></li>\n";        
              
              
                $etapas = dbf('SELECT * FROM servicos_fases_etapas WHERE id_fase = :id_fase AND id_empresa = :id_empresa ORDER BY zorder_etapa ASC',
                          array(':id_fase'=>$id_fase,':id_empresa'=>$uid_empresa) ,'fetch');
              
                if(count($etapas)>0){
                echo "<ul class='indent-20'>\n";
                
                  //LISTA ETAPAS
                  for ($e = 0; $e < count($etapas); $e++)
                  {
                    
                    $data_e      = $etapas[$e];
                    $id_etapa    = $data_e['id_etapa'];
                    $nome_etapa  = $data_e['nome_etapa'];
                    echo "<li><h6><i class=\"fas fa-circle fa-xs\"></i> <a href=\"adm-servicos/etapas?uide=$id_etapa&opt=edit-etapa&uidf=$id_fase\">$nome_etapa</a></h6></li>\n"; 
                    
                  }
                
                echo "</ul>\n";
                }
                
            }
          echo "</ul>\n";
          }
      
        }
      echo "</ul>\n";
      
      }
    
    echo "</ul>\n";
    echo "</div>\n";
  }

}
?>
