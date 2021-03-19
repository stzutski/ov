<br />
    <?php 
    $_idCatServicoSelecionada = getVar('uidcs');

    if($_idCatServicoSelecionada!=''){
    $btnADD = '<a href="adm-servicos/servicos?opt=edit-servico&uids=0&uidcs='.getVar('uidcs').'" class="btn btn-primary btn-sm" role="button" aria-pressed="true"><i class="far fa-plus-square"></i> Novo Serviço</a>';
    echo alertBox(''.$btnADD.'','info');
    }

    $_idSelecionado = $_idCatServicoSelecionada;
    
    //CAMPO SELECT COM A LISTA DE CATEGORIAS DE SERVIÇOS
    require_once(ADMINVIEWS.'elementos/selects/selectServicos.adm-servicos.php');




    if($_idCatServicoSelecionada==''){
      
      
    //NADA SELECIONADO
    echo alertBox('Selecione uma CATEGORIA para visualizar os SERVIÇOS','warning');
    
      
    }else{
      echo '<small><i class="fas fa-stream text-primary"></i> Visualiza Fases &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fas fa-pencil-alt text-primary"></i> Edita serviço &nbsp;&nbsp;|&nbsp;&nbsp; <span style="color:#940000;"><i class="fas fa-square"></i> Inativo</span> - <span style="color:#333333;"><i class="fas fa-square"></i> Ativo</span></small>';


      $_data_serv  = dbf('SELECT * FROM servicos WHERE id_categoria = :id_categoria AND id_empresa = :id_empresa ORDER BY id_servico',
                        array(':id_categoria'=>$_idCatServicoSelecionada,':id_empresa'=> decode( sessionVar('_iE') ) ),'fetch');
                            
                            
      $_tagLSRV = '<ul class="list-group" id="listaServicos">'."\n";
      
      for ($i = 0; $i < count($_data_serv); $i++)
      {
        $_data      = $_data_serv[$i];
        if($_data['status_servico']=='0'){$_rowStyle=' liNativo';}else{$_rowStyle=' liAtivo';}
        $_tagLSRV  .= '<li class="list-group-item'.$_rowStyle.'">
                      <a href="adm-servicos/fases?uids='.$_data['id_servico'].'"><i class="fas fa-stream"></i></a>&nbsp;|&nbsp;
                      '.$_data['nome_servico'].' ( <b>'.$_data['modalidade_servico'].'</b> )
                      <span style="float:right">
                      <a href="adm-servicos/cat-serv?opt=edit-cat-serv&uidcs='.$_data['id_categoria'].'&opt=edit-servico&uids='.$_data['id_servico'].'">
                      <i class="fas fa-pencil-alt"></i>
                      </a>
                      </span>
                    </li>'."\n";
      }
      
      $_tagLSRV .= '</ul>'."\n";
      

      echo $_tagLSRV;


      }
      
    ?>
