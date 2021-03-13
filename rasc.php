    id_usuario
    id_empresa
    nome_usuario
    sobrenome_usuario
email_usuario
telefone_usuario
    pwd_usuario
permissao_usuario
    dt_usuario
lst_login_usuario
    cod_ativacao_usuario
status_usuario


a.email_usuario,
a.telefone_usuario,
a.permissao_usuario,
a.lst_login_usuario,
a.status_usuario,
b.id_cliente,
b.id_usuario,
b.id_empresa,
b.cad_dependente,
b.id_cliente_resp,
b.nome_cliente,
b.sobrenome_cliente,
b.cpf_cliente,
b.uf_cliente,
b.cidade_cliente,
b.dt_cliente,







a.id_usuario,
  a.email_usuario,
  a.telefone_usuario,
  a.permissao_usuario,
a.lst_login_usuario,
a.status_usuario,
  b.id_cliente,
  b.id_usuario,
  b.id_empresa,
b.cad_dependente,
b.id_cliente_resp,
b.nome_cliente,
b.sobrenome_cliente,
b.cpf_cliente,
b.uf_cliente,
b.cidade_cliente,
b.dt_cliente,
b.status_cliente



<?php 

//capos do DB que sera usados na tabela html
$dataCol = array('id_usuario','nome_usuario','sobrenome_usuario','status_usuario');
$con[2] = array('vz'=>'ATIVO','0'=>'INATIVO'); 
$con[3] = array('1'=>'ATIVO','0'=>'INATIVO'); 



$col=array('id_usuario'=>'<a href="{id_usuario}">{nome_usuario} {nome_usuario}</a>');






function mkTable($data=array(),$header=array(),$cols=array()){
  $hf_cols  = '';
  $table    = '';
  $table_hf = false;
  
    //header and footer cols
    if(count($header)>0){
      $table_hf=true;
      for ($i  = 0; $i < count($header); $i++)
      {$hf_cols .= '<td>'.$hf_cols[$i].'</td>';}
    }
    
    
    $table    = '<table class="table table-hover">'."\n";
    
    //monta o header
    if($table_hf){
      $table .= '<thead>'."\n";
      $table .= '<tr>'."\n";
      $table .= $hf_cols."\n";
      $table .= '</tr>'."\n";  
      $table .= '</thead>'."\n";  
    }
  
    //caso dados tenham sido informados
    $tbRow = '';
    $tbCel = '';
    
    if(count($data)>0){
      
      $_rowData = $data[$i];//dados do banco
      
      for ($i = 0; $i < count($cols); $i++)
      { //col[] = array( '<a href="{id_col}">{nome_usuario}</a>', array('id_usuario','nome_usuario') ))
        
        $item      = $cols[$i];
        if(isSet($item[0])){$_tdContent = $item[0];}
        if(isSet($item[1])){$dtindx     = $item[1];}
      
        if(is_array($dtindx)){
          for ($i = 0; $i < count($dtindx); $i++)
          { $di         = $dtindx[$i];
            $_tdContent = str_replace('{'.$di.'}',$_rowData[$di],$_tdContent);
          }
        }
       $tbCel   .= '<td>'.$_tdContent.'</td>'; 
      }
      $tbRow .= '<tr>'.$tbCel.'</tr>'."\n";
    }
    
    $table .= $tbRow;
  
  
    //monta o footer
    if($table_hf){
      $table .= '<tfoot>'."\n";
      $table .= '<tr>'."\n";
      $table .= $hf_cols."\n";
      $table .= '</tr>'."\n";  
      $table .= '</tfoot>'."\n";  
    }
    $table.= '</table>'."\n";
    
    return $table;
  
}





?>




<table class="table table-hover"><thead>
<tr>
  <th scope="col">#</th>
  <th scope="col">Nome</th>
</tr>
</thead>
<tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
    </tr>
  </tbody>
</table>
