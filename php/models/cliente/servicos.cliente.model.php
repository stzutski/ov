<?php 
use \db\Sql;
use \db\ProcSql;
use cliente\servicos\Servicos;

if(!isSet($idCategoriaServico) && !isSet($idPedido)){
    //$ress = Servicos::listaCats();
    $lista_categorias = Servicos::listaDados('servicos_categorias',
                                  'WHERE status_categoria_servico = :status_categoria_servico',
                                  array(':status_categoria_servico'=>1));//ProcSql
    
}

if(isSet($idCategoriaServico) && !isSet($idPedido))
{
      
    //categoria informada:: recuperar os servicos compativeis com a categoria selecionada
    $dadosCategoria             = Servicos::dadosCategoria($idCategoriaServico);
    $_nomeCategoriaSelecionada  = $dadosCategoria[0]['nome_categoria_servico'];
    $servicosCategoria          = Servicos::servicosCategoria($idCategoriaServico);

    if(is_array($servicosCategoria) && count($servicosCategoria)>0){

      //$listaOpcoes = count($servicosCategoria);
      
      $form = '';
      foreach ($servicosCategoria as $value) {
        $item  = $value;
        $idSrv = $item['id_servico'];
        $form .= '<div class="form-group col-md-4">'."\n";
        $form .= '<label for="'.$idSrv.'">'.$item['modalidade_servico'].'</label>'."\n";
        $form .= '<input class="form-control" type="number" id="idsrv" name="qt_'.$idSrv.'" value="0" min="0" />'."\n";
        $form .= '</div>'."\n";
      }
      

    }

}


if(isSet($novo_pedido) && is_array($novo_pedido)){
  
  $cat_pedido       = $novo_pedido['categoria'];
  $itens_do_pedido  = $novo_pedido['itens'];
  
  //insere pedido
  $sql = new Sql();
  $res = $sql->query('INSERT INTO pedidos ( 
                    id_empresa,
                    id_usuario,
                    dt_pedido,
                    status_pedido 
                    ) VALUES ( 
                    :id_empresa,
                    :id_usuario,
                    :dt_pedido,
                    :status_pedido  
                    )',array(
                    ':id_empresa'=>UIDEMPRESA,
                    ':id_usuario'=>UIDUSER,
                    ':dt_pedido'=>time(),
                    ':status_pedido'=>0));
  
  if($res>0){
    
    //insere itens do pedido
    foreach ($itens_do_pedido as $key => $value) {
      
      $id_servico = $key;
      
      //recupera dados do servico (ex: preco)
      $dataItem   = $sql->select('SELECT * FROM servicos WHERE id_servico = :id_servico',array(':id_servico'=>$id_servico));
      
      $idPedido   = $res;
      $idItem     = $dataItem[0]['id_servico'];
      $precoItem  = $dataItem[0]['preco_servico'];
      $qtd_item   = $value;
      if($qtd_item>0){
      
      $totalItem  = round(($qtd_item * $precoItem),2);
      
      //insere item na tabela de itens do pedido
      $insertItem = $sql->query('INSERT INTO pedidos_itens ( 
                                id_pedido,id_item,preco_item,qtd_item,precototal_item,obs_item,status_pedido_item) 
                                VALUES 
                                (:id_pedido,:id_item,:preco_item,:qtd_item,:precototal_item,:obs_item,:status_pedido_item)',
                                array(
                                ':id_pedido'=>$idPedido,
                                ':id_item'=>$idItem,
                                ':preco_item'=>$precoItem,
                                ':qtd_item'=>$qtd_item,
                                ':precototal_item'=>$totalItem,
                                ':obs_item'=>'',
                                ':status_pedido_item'=>0));
                                
      }
      
    }
  
  
  }
  
  
}




if(!isSet($idCategoriaServico) && isSet($idPedido))
{
  
  
  $dadosPedido = array();
  $dadosPedido[] = array('item'=>1,'descricao'=>'Visto XXXX','modalidade'=>'Adulto(s) +18 anos','qtd'=>2,'preco'=>1205.30,'total'=>1205.30);
  $dadosPedido[] = array('item'=>2,'descricao'=>'Visto XXXX','modalidade'=>'Menore(s) 13~17 anos','qtd'=>1,'preco'=>480.00,'total'=>480.00);
  $dadosPedido[] = array('item'=>3,'descricao'=>'Visto XXXX','modalidade'=>'Crianca(s) 0~12 anos','qtd'=>1,'preco'=>0.00,'total'=>0.00);
  

  $_table = '<table class="table tb-carrinho">';
  $_table.= '<thead class="thead-dark">';
  $_table.= '<tr>';
  $_table.= '<th>Item</th>';
  $_table.= '<th>Desc.</th>';
  $_table.= '<th>Tipo</th>';
  $_table.= '<th>Qtd.</th>';
  $_table.= '<th>Unit.</th>';
  $_table.= '<th>Total</th>';
  $_table.= '</tr>';
  $_table.= '</thead>';
  $_table.= '<tbody>';
  
  foreach ($dadosPedido as $value) {
    
    $item    = $value;
    $_table .= '<tr>';
    
    $_table .= '<td>'.$item['item'].'</td>';
    $_table .= '<td>'.$item['descricao'].'</td>';
    $_table .= '<td>'.$item['modalidade'].'</td>';
    $_table .= '<td>'.$item['qtd'].'</td>';
    $_table .= '<td>'.$item['preco'].'</td>';
    $_table .= '<td>'.$item['total'].'</td>';
    
    $_table .= '</tr>';
    
  }

  $_table .= '</tbody>';
  $_table .= '</table>';
  
  
}

?>
