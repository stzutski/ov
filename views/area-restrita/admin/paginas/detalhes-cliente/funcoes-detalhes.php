    <?php 
    if($_uidUsuario>0){
      
      //dados do usuário
      
      function perfilUserData($idUser){
        $res=false;
        $usuario_data = dbf('SELECT * FROM usuarios WHERE id_usuario = :id_usuario AND id_empresa = :id_empresa',
                            array(':id_usuario'=>$idUser,':id_empresa'=>decode( sessionVar('_iE') ) ),'fetch');
        if(count($usuario_data)>0){
            $res = $usuario_data[0];
        }
        return $res;
      }
      
      function perfilClienteData($idUser){
        $res=false;
        $cliente_data = dbf('SELECT * FROM clientes WHERE id_usuario = :id_usuario AND id_empresa = :id_empresa',
                            array(':id_usuario'=>$idUser,':id_empresa'=>decode( sessionVar('_iE') ) ),'fetch');
        if(count($cliente_data)>0){
            $res = $cliente_data[0];
        }
        return $res;        
      }
      
      function perfilClienteDataByIdCliente($idCli){
        $res=false;
        $cliente_data = dbf('SELECT * FROM clientes WHERE id_cliente = :id_cliente AND id_empresa = :id_empresa',
                            array(':id_cliente'=>$idCli,':id_empresa'=>decode( sessionVar('_iE') ) ),'fetch');
        if(count($cliente_data)>0){
            $res = $cliente_data[0];
        }
        return $res;        
      }
      
      function perfilEnderecoCliente($idCliente){
        $res=false;
        $endereco_data = dbf('SELECT * FROM clientes_enderecos WHERE id_cliente = :id_cliente',
                            array(':id_cliente'=>$idCliente),'fetch');
        if(count($endereco_data)>0){
            $res = $endereco_data[0];
        }
        return $res;      
      }
      
      function perfilCidadeCliente($idCidade){
        $res=false;
        $cidade_data = dbf('SELECT * FROM tb_cidades WHERE id_cidade = :id_cidade',
                            array(':id_cidade'=>$idCidade),'fetch');
        if(count($cidade_data)>0){
            $res = $cidade_data[0]['nome_cidade'];
        }
        return $res;
      }
      
      function perfilPedidosCliente($idUser){
        $res=array();
        $pedido_data = dbf('SELECT * FROM pedidos WHERE id_usuario = :id_usuario AND id_empresa = :id_empresa',
                            array(':id_usuario'=>$idUser,':id_empresa'=>decode( sessionVar('_iE') ) ),'fetch');
        if(count($pedido_data)>0){
            $res = $pedido_data;
        }
        return $res;
      }
      
      function perfilItensPedidosCliente($idPedido){
        $res=false;
        $itensPedido_data = dbf('SELECT * FROM pedidos_itens WHERE id_pedido = :id_pedido',
                                array(':id_pedido'=>$idPedido),'num');
        return $itensPedido_data;
      }
      
      function perfilFaturaPedido($idPedido){
        $res=false;
        $fatura_data = dbf('SELECT * FROM faturas WHERE id_pedido = :id_pedido',
                            array(':id_pedido'=>$idPedido),'fetch');
        if(count($fatura_data)>0){
            $res = $fatura_data[0];
        }
        return $res;
      }
      
      function perfilDetServico($idServico){
        $res=false;
        $servico_data = dbf('SELECT * FROM servicos WHERE id_servico = :id_servico AND id_empresa = :id_empresa',
                            array(':id_servico'=>$idServico,':id_empresa'=>decode( sessionVar('_iE') ) ),'fetch');
        logsys("SERVICO DATA:::" . json_encode($servico_data));
        if(count($servico_data)>0){
            $res = $servico_data[0];
        }
        return $res;        
      }
      
      function perfilDependenteById($idCliente){
        $res=false;
        $dependente_data = dbf('SELECT * FROM clientes 
                                WHERE id_cliente = :id_cliente 
                                AND id_empresa = :id_empresa',
                                array(
                                ':id_cliente'=>$idCliente,
                                ':id_empresa'=>decode(sessionVar('_iE'))
                                ),'fetch');
        
        logsys("DEPENDENTE DATA::: ".json_encode($dependente_data));
        if(count($dependente_data)>0){
            $res = $dependente_data[0];
        }
        return $res;
      }
      
      
      /*
       * retorna os itens do pedido já agrupados pelo ID RESPONSAVEL
       * */
      function perfilItensPedCli($idUsuario,$idPedido){
        $res        = false;
        $itens_data = dbf('SELECT DISTINCT(id_item),id_pedido_item,id_cliente,id_cliente_dependente 
                          FROM pedidos_itens WHERE id_empresa = :id_empresa AND id_cliente = :id_cliente AND id_pedido = :id_pedido',
                          array(':id_empresa'=>decode(sessionVar('_iE')),':id_cliente'=>$idUsuario,':id_pedido'=>$idPedido),'fetch');
                          
        if(count($itens_data)>0){
            $res = $itens_data;
        }
        return $res;
      }
      
      
      $_usuarioData   = perfilUserData($_uidUsuario);
      $_clienteData   = perfilClienteData($_uidUsuario);
      $_enderecoData  = perfilEnderecoCliente($_clienteData['id_cliente']);
      $_pedidosData   = perfilPedidosCliente($_uidUsuario);
      
    }
    
    ?>
