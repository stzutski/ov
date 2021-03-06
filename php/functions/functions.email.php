<?php 

/*
 * funcao para enviar mensagem de email para o usuário com base no template e argumentos
 * */
//function sndMail($to,$from,$replyTo,$subject,$message){
/*
$args['to']       = 'email@destino.com.br';
$args['subject']  = 'Bem vindo';
$args['from']     = 'website.demonstracao@gmail.com';
$args['template'] = 'views/mails/mail.php';
$args['message']  = 'Ola {%usuario%} Seu Cadastro Foi Concluido com Sucesso';
$args['mailvars'] = array('nomeUsuario'=>'fulano de tal','emailUsuario'=>'ze@ze.com.br');


sndMail($args);
*/

//FUNCAO CONFIGURAR O TEMPLATE DO EMAIL (DEVERÁ SER REMOVIDA TROCADA POR UMA CLASSE)
function mailPrepare($args=array()){
  
  $msgemail = '';
  $template = arrayVar($args,'template');
  
  //se template for informado deve ser feito o parse da mensagem para email html
  if($template!=''){
    if(file_exists($template)){
      $mailbody = implode('', file($template));
    }else{
      $mailbody = '<h3>template não configurado</h3>';
    }
    $message    = $mailbody;
  }else{//caso contrario é um mensagem com formatacao direta
    $message    = arrayVar($args,'message');
  }

  $mailvars = arrayVar($args,'mailvars');
  
  
  //caso existam variaveis para o texto do email substitui pelos valores
  if(is_array($mailvars) && count($mailvars)>0 && $message!=''){
    $msgemail = $message;
    foreach ($mailvars as $key => $value) {
      $msgemail = str_replace('{%'.$key.'%}',$value,$msgemail);
    }
    $msgemail = str_replace('{%URLAPP%}',URLAPP,$msgemail);
    $msgemail = str_replace('{%mailSuporte%}',MAILSUPORTE,$msgemail);
    
  }else{//caso contrario deve ser uma mensagem de texto puro
    $msgemail = $message;
  }  
  $args['message'] = $msgemail;
  return $args;
}




//FUNCAO PARA ENVIAR EMAIL (DEVERÁ SER REMOVIDA TROCADA POR UMA CLASSE)
function sndMail($args=array()){
  

  //prepara a mensagem de email
  //$argsMail = mailPrepare($args);
  $argsMail = $args;

  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

  // Additional headers
  $headers .= 'To: ' . arrayVar($argsMail,'to') . "\r\n";
  $headers .= 'From: ' . arrayVar($argsMail,'from') . "\r\n";
  $headers .= 'Reply-To: ' . arrayVar($argsMail,'from') . "\r\n";
  //$headers .= 'Reply-To: ' . arrayVar($argsMail,'replyto') . "\r\n";
  $headers .= 'X-Mailer: PHP/ ' . phpversion();
  //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
  //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

  $to       = arrayVar($argsMail,'to');
  $subject  = arrayVar($argsMail,'subject');
  $message  = arrayVar($argsMail,'message');

  //se destinatario, assunto e mensagem estiverem definidos procede com o envio
  if($to!='' && $subject!='' && $message!=''){

    if(!mail($to, $subject, $message, $headers)){
      return false;
    }else{
      return true;
    }

  //caso contrario aborta e retorna false
  }else{
    return false;
  }

}

?>
