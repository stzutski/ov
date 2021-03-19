<?php 
//rotina de login de usuarios do site
use \db\Sql;
use \site\CadUserCli;

//rotinas (POST)PROCESS de LOGIN do usuario
if(postVar('do')=='login'){
  
  if(postVar('user')!='' && postVar('pwd')!=''){

      $usuario = new CadUserCli();
      $login   = $usuario->loginUser(postVar('user'),postVar('pwd'));

      if($login==false){
          $app->redirect(URLAPP . 'erro-login/nao-autorizado');
      }
      elseif($login==0){
          $app->redirect(URLAPP . 'erro-login/nao-confirmado');
      }
      elseif($login==1){
          $app->redirect(URLAPP);
      }
  }
  
}

//rotinas (POST)AJAX para REENVIO do email de ativacao
if(postVar('do')=='reconf'){
  
  $emailUser='';
  if(postVar('emladdr')==''){//SE EMAIL NAO INFORMADO
    
    echo 1002;//COD ERRO 1002 EMAIL NÃO INFORMADO
  
  }elseif(postVar('emladdr')!=''){
  
    if(!validaEmail(postVar('emladdr'))){
      
      echo 1003;//COD ERRO 1003 EMAIL MAL FORMATADO
      
    }else{
      
      $emailUser = postVar('emladdr');    
      
      //CONSULTA EMAIL NA TABELA DE USUARIOS
      $usuario  = new CadUserCli();
      $userData = $usuario->getUserByEmail($emailUser);
      
      
      //CHECA NOVAMENTE SE DADOS REALMENTE CONFEREM
      if($userData['email_usuario']!=$emailUser){
      
        //echo 1004;//COD ERRO 1004 EMAIL NÃO ENCONTRADO OU DIVERGE DO CADASTRADO
        echo 'alert("Email não cadastrado no sistema")';
      
      //CASO DADOS OK ENTÃO RE-ENVIA MSG DE ATIVACAO DO CADASTRO
      }elseif($userData['email_usuario']==$emailUser){
        
        
        $cod_conf_usuario = $userData['cod_ativacao_usuario'];

        $url_da_confirmacao = URLAPP.'cadastro/confirmacao/'.$cod_conf_usuario;
            
        $message  = "Prezado(a) usuário(a).";
        $message .= "<br /><br />\n";
        $message .= "Para confirmar e ativar seu cadastro, necessitamos confirmar seu endereço de email.";
        $message .= "para concluir o procedimento clique no link contigo nesta mensagem.";
        $message .= "<br /><br />\n";
        $message .= "Caso não seja possível clicar no link, copie e cole o mesmo em seu navegador";
        $message .= "<br />\n";
        $message .= "<br />\n";
        $message .= "<a href=\"$url_da_confirmacao\">$url_da_confirmacao</a>";

        //envia mensagem para o email do usuario
        $email    = array('to'=>$emailUser, 'from'=>MAILFROM, 'subject'=>'Confirmação do Cadastro', 'message'=>$message);
        
        if(sndMail($email)){
          //echo 1;//CASO EMAIL ENVIADO COM SUCESSO RETORNA 1
          echo 'alert("Confira sua caixa de entrada!")';
        
        }else{
          //echo 0;//CASO ERRO NO ENVIO RETORNA 0
          echo 'alert("Ocorreu um erro no envio\ntente novamente mais tarde")';
        }
      }
    }
  }
}

?>
