<?php 
/*
 * rotinas envolvidas no cadastro
 * */

//retorna lista de cidades via AJAX para formulario de cadastro
if(postVar('go')=='lstcidades'){
  if(postVar('uf')!=''){
      $res = listaCidades(postVar('uf'),true);
      if($res!=''){
      $res = addslashes($res);
      $tag = "<select required=\"true\" id=\"campoCidade\" name=\"campoCidade\" class=\"form-control\"><option value=\"\">(".strtoupper(postVar('uf')).") Selecione a Cidade</option>$res</select>";
      echo "$( \"#cidAjx\" ).html('$tag');";
    }
    else
    {
      $tag = "<select required=\"true\" id=\"campoCidade\" name=\"campoCidade\" class=\"form-control\"><option value=\"\">Selecione o Estado</option></select>";
      echo "$( \"#cidAjx\" ).html('$tag');";
    }
  }
}


if(postVar('do')=='newuser'){
  
  //recebe dados do form
  $nome       = postVar('campoNome');
  $sobrenome  = postVar('campoSobrenome');
  $email      = postVar('campoEmail');
  $telefone   = postVar('campoTelefone');
  $cpf        = postVar('campoCpf');
  $uf         = postVar('campoUf');
  $cidade     = postVar('campoCidade');
  $senha      = postVar('campoSenha');
  $confirme   = postVar('campoConfSenha');
  
  $error=false;
  $msge='';
  ////####### (uidEmpresa)
  if(strlen($nome)<4)             {$error=true; $msge .= "- Informe corretamente o campo nome<br />";}
  if(strlen($sobrenome)<4)        {$error=true; $msge .= "- Informe corretamente o campo sobrenome<br />";}
  if(validaEmail($email)==false)  {$error=true; $msge .= "- Informe corretamente o campo email<br />";}
  if(strlen($telefone)<4)         {$error=true; $msge .= "- Informe corretamente o campo telefone<br />";}
  if(validaCPF($cpf)==false)      {$error=true; $msge .= "- Informe corretamente o campo CPF<br />";}
  if(strlen($uf)<2)               {$error=true; $msge .= "- Selecione o estado<br />";}
  if(strlen($cidade)<4)           {$error=true; $msge .= "- Selecione a cidade<br />";}
  if(strlen($senha)<6)            {$error=true; $msge .= "- Sua senha deve ter pelo menos 6 caracteres!<br />";}
  if($confirme!=$senha)           {$error=true; $msge .= "- O campo senha e confirme não são idênticos!<br />";}
  
  
  if($error===true){//caso exista algum erro...envia mensagem de erro para a pagina
    $msge = "<small>$msge</small>";
  }
  
  if($error===false){//caso nao exista erro algum
    
    $id_empresa = postVar('uidEmpresa');
    if(postVar('uidEmpresa')==''){
    $id_empresa = 1;  
    }
    
    $dth_Cad                  = time(); //TIME(data e hora do cadastro)
    $args                     = array();
    $argsCad['nome']          = $nome;
    $argsCad['sobrenome']     = $sobrenome;
    $argsCad['email']         = $email;
    $argsCad['telefone']      = $telefone;
    $argsCad['cpf']           = $cpf;
    $argsCad['uf']            = $uf;
    $argsCad['cidade']        = $cidade;
    $argsCad['senha']         = mkpwd($senha);
    $argsCad['id_empresa']    = $id_empresa;
    $argsCad['dt_cad']        = $dth_Cad;
    $argsCad['cod_ativacao']  = userCodeActiv($dth_Cad);
    $argsCad['status']        = 0;
    
    $resCad = add_newUserCli($argsCad);//cadastra e retorna o ID do usuario recem cadastro
    
    //notifica usuario por email e requisita a confirmacao pelo click no email
    //DEFINE A MSG DE NOTIFICACAO
    $_urlLink = URLAPP . "cadastro/confirmacao/".userCodeActiv($dth_Cad);
    $message  = "<strong>Prezado(a) usuário(a).</strong>";
    $message .= "<br /><br />\n";
    $message .= "<h3 style=\"text-align:center;\">Clique no link abaixo para ativar seu cadatro!</h3>";
    $message .= "<br />\n";
    $message .= "<center><a href=\"$_urlLink\">$_urlLink</a></center>\n";
    $message .= "<br /><br />\n";
    $message .= "<b>EQUIPE OBA VISTO</b>";      
    
    //envia mensagem para o email do usuario
    $email    = array('to'=>$email, 'from'=>MAILFROM, 'subject'=>'Dados para Acesso', 'message'=>$message);
    $resMail  = sndMail($email);       


    if($resCad!=false && $resCad>0){//se tudo certo encaminha usuario para tela de aviso de confirmacao
      
      $app->redirect(URLAPP . 'cadastro/confirmacao');
      
    }
  
  }
  
}



?>
