
    <div class="row stripe-1">
      <div class="col-md-12 rowDet">
        <h5 class="faklink" data-toggle="collapse" data-target="#row_dataCli"><i class="fas fa-id-card"></i> Dados Cadastrais</h5>
      </div>
    </div>
     
    <div id="row_dataCli" class="collapse show">
     <div class="row stripe-0">
       <div class="col-md-6 rowDet"><b>Nome:</b> <?php echo $_usuarioData['nome_usuario'];?> <?php echo $_usuarioData['sobrenome_usuario'];?></div>
       <div class="col-md-6 rowDet"><b>Cpf:</b> <?php echo $_clienteData['cpf_cliente'];?></div>
     </div>
     
     <div class="row stripe-1">
       <div class="col-md-6 rowDet"><b>E-mail:</b> <?php echo $_usuarioData['email_usuario'];?></div>
       <div class="col-md-6 rowDet"><b>Tel:</b> <?php echo $_usuarioData['telefone_usuario'];?></div>
     </div>
     
     <div class="row stripe-0">
       <div class="col-md-6 rowDet" title="Endereço: <?php echo $_enderecoData['tipo_endereco_cliente'];?>"><b>End:</b> <?php echo $_enderecoData['endereco_cliente'];?>, <?php echo $_enderecoData['numeroendereco_cliente'];?></div>
       <div class="col-md-6 rowDet"><b>Comp:</b> <?php echo $_enderecoData['complemento_endereco_cliente'];?></div>
     </div>        
        
     <div class="row stripe-1">
       <div class="col-md-4 rowDet"><b>Bairro:</b> <?php echo $_enderecoData['bairro_endereco_cliente'];?></div>
       <div class="col-md-4 rowDet"><b>Cep:</b> <?php echo $_enderecoData['cep_endereco_cliente'];?></div>
       <div class="col-md-4 rowDet"><b>Cx.P.:</b> <?php echo $_enderecoData['cx_postal_endereco_cliente'];?></div>
     </div>
        
     <div class="row stripe-0">
       <div class="col-md-4 rowDet"><b>Cidade:</b> <?php echo perfilCidadeCliente($_enderecoData['cidade_endereco_cliente']);?></div>
       <div class="col-md-4 rowDet"><b>UF:</b> <?php echo $_enderecoData['uf_endereco_cliente'];?></div>
       <div class="col-md-4 rowDet"><b>País:</b> <?php echo $_enderecoData['pais_endereco_cliente'];?></div>
     </div>
    </div>
