<br />
    <?php 
    
      $btnADD = '<a href="adm-servicos/cat-serv?opt=edit-cat-serv&uidcs=0" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="far fa-plus-square"></i> Nova Categoria</a>';
      echo alertBox(''.$btnADD.'','info');

      echo '<small><i class="fas fa-stream text-primary"></i> Visualiza Servicos &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fas fa-pencil-alt text-primary"></i>Edita categoria &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#940000;"><i class="fas fa-square"></i> Inativo</span> - <span style="color:#333333;"><i class="fas fa-square"></i> Ativo</span></small>';

      $_data_catserv  = dbf('SELECT * FROM servicos_categorias ORDER BY id_categoria','','fetch');
      $_tagLCAT = '<ul class="list-group" id="listaCategorias">'."\n";
      
      for ($i = 0; $i < count($_data_catserv); $i++)
      {
        $_data      = $_data_catserv[$i];
        if($_data['status_categoria_servico']=='0'){$_rowStyle=' liNativo';}else{$_rowStyle=' liAtivo';}
        $_tagLCAT  .= '<li class="list-group-item'.$_rowStyle.'">
                      <a href="adm-servicos/servicos?uidcs='.$_data['id_categoria'].'"><i class="fas fa-stream"></i></a>&nbsp;|&nbsp;
                      '.$_data['nome_categoria_servico'].'
                      <span style="float:right">
                      <a href="adm-servicos/cat-serv?opt=edit-cat-serv&uidcs='.$_data['id_categoria'].'">
                      <i class="fas fa-pencil-alt"></i>
                      </a>
                      </span>
                    </li>'."\n";
      }
      
      $_tagLCAT .= '</ul>'."\n";
      

      echo $_tagLCAT;

    ?>
