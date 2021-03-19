<?php 
//model com rotinas de recuperacao dos dados de acesso do usuario
use \db\Sql;
use \site\CadUserCli;

/*
 * MODEL EXECUTADO NO AJAX
 * */
//se POST 
if($_POST){
  //recebe os dados
  $_emailUsuario  = addslashes(trim($_POST['emladdr']));
  
  $cadUser    = new CadUserCli();
  
  //PRIMEIRO CONFERIMOS SE EMAIL EXISTE NA TABELA USUARIOS
  $exist      = $cadUser->consultaEmail($_emailUsuario);
  
  if($exist=='0' || $exist=='1002'){//ERR CODE 0 ou 1002 EMAIL NAO ENCONTRADO OU MAL FORMATADO
    
    echo 'alert("Email não cadastrado")';
    
  }
  else
  {
    
    $res        = $cadUser->passRecovery($_emailUsuario);
    $resMail    = false;
    if($res!=false && $res!='0'){
      
      $_userData = $res['userdata'];
      $_userHash = $res['urlHash'];
      
      $url_da_recuperacao = URLAPP.'confirma-recuperacao/'.$_userHash;
          
      $message  = "Prezado(a) usuário(a).";
      $message .= "<br /><br />\n";
      $message .= "Recebemos uma solicitação para recuperar seus dados de acesso";
      $message .= "para concluir o procedimento clique no link contigo nesta mensagem.";
      $message .= "<br /><br />\n";
      $message .= "Caso não seja possível clicar no link, copie e cole o mesmo em seu navegador";
      $message .= "<br />\n";
      $message .= "<br />\n";
      $message .= "<a href=\"$url_da_recuperacao\">$url_da_recuperacao</a>";

      //envia mensagem para o email do usuario
      $email    = array('to'=>$_emailUsuario, 'from'=>MAILFROM, 'subject'=>'Recuperação de Senha', 'message'=>$message);
      $resMail  = sndMail($email);    
    }
    
    if($resMail){
      echo 'alert("Confira sua caixa de entrada")';
    }else{
      echo 'alert("Erro na recuperacao da senha")';
    }
  
  }
}
/*
 * FINAL DAS ROTINAS AJAX
 * */



/*
 * MODEL EXECUTADO NA VALIDACAO DO HASH DA RECUPERACAO VIA GET VAR 
 * */

//caso codigo HASH tenha sido recebido processa a parte final da recuperacao da senha
if(isSet($codRecuperacao) && $codRecuperacao!=''){
  
  
  
  //CONSULTA VALIDADE DO HASH (CASO EXISTA E SEJA VALIDO) PROCEDE 
  $chkHash    = new CadUserCli();
  $idUsuario  = $chkHash->getUserByHash($codRecuperacao);//CONFERE O HASH SE OK (RETORNA O ID DO USUARIO)
  
  
  //SE HASH VALIDO
  if($idUsuario>0){
    
    
    //GERA UMA SENHA TEMPORARIA
    $pwdTemp    = genPwd();//SENHA TEMPORARIA TXT PLANO
    $pwdTempEnc = mkpwd($pwdTemp);//SENHA TEMPORARIA ENCRIPTADA
    
    $result     = $chkHash->savePwdTmp($idUsuario,$pwdTempEnc);
    
    //CASO PROCESSADO COM SUCESSO
    if($result!=false && $result!='0'){
      
      $_userDATA = $chkHash->getUserById($idUsuario);//RETORNA DADOS COMPLETOS DO USUARIO
      
      //DEFINE A MSG DE NOTIFICACAO
      $message  = "Prezado(a) usuário(a).";
      $message .= "<br /><br />\n";
      $message .= "<p>Restauramos seus dados de acesso, conforme sua solicitação geramos";
      $message .= "uma nova senha de acesso. Para realizar seu login utilize a senha abaixo:</p>";
      $message .= "<br /><br />\n";
      $message .= "<h2 style=\"margin:10px auto;display:inline-block;padding:10px;border:1px #333 dashed;\">$pwdTemp</h2>";
      $message .= "<br /><br />\n";
      $message .= "<b>EQUIPE OBA VISTO</b>";      
      
      //envia mensagem para o email do usuario
      $email    = array('to'=>$_userDATA['email_usuario'], 'from'=>MAILFROM, 'subject'=>'Dados para Acesso', 'message'=>$message);
      $resMail  = sndMail($email);    
      
      if($resMail){
        logsys("Email com notificacao de nova senha ENVIADO com SUCESSO");
      }else{
        logsys("Ocorreu um erro durante o envio da SENHA RECUPERADA");
      }
      
      
      //SINALIZA O SUCESSO PARA EXIBIR A PAGINA DE CONFIRMACAO
      $status_recuperacao = 1;
    }else{
      //SINALIZA O ERRO PARA EXIBIR A PAGINA DE ERRO
      $status_recuperacao = 0; 
    }
    
    
  //CASO HASH INVALIDO REDIRECIONA PARA PAGINA DE ERRO
  }elseif($idUsuario==false || $idUsuario==0){
    
    //SINALIZA O ERRO PARA EXIBIR A PAGINA DE ERRO
    $status_recuperacao = 0;
    
  }
  
}
/*
 * FIM DAS ROTINAS DE VERIFICACAO DO HASH, GERACAO E ENVIO DA NOVA SENHA
 * */

?>
