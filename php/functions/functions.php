<?php
// auto carregamento das classes
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', "php/classes/$class.php"));
});


//funcao para proteger areas restritas de acordo com o nivel de permissao
function protege($userLevel,$required){
  
}

// helpers para vars
function getVar($varname){
  if(isSet($_GET[$varname])){if($_GET[$varname]=='' || $_GET[$varname]!=''){return $_GET[$varname];}}
  else
  {return false;}
}
function postVar($varname){
  if(isSet($_POST[$varname])){if($_POST[$varname]=='' || $_POST[$varname]!=''){return $_POST[$varname];}}
  else{return false;}
}
function sessionVar($varname){
  if(isSet($_SESSION[$varname])){if($_SESSION[$varname]=='' || $_SESSION[$varname]!=''){return $_SESSION[$varname];}}
  else{return false;}
}
function cookieVar($varname){
  if(isSet($_COOKIE[$varname])){if($_COOKIE[$varname]=='' || $_COOKIE[$varname]!=''){return $_COOKIE[$varname];}}
  else{return false;}
}
function dataVar($_RESOURCE,$varname){
  if(isSet($_RESOURCE[$varname])){if($_RESOURCE[$varname]=='' || $_RESOURCE[$varname]!=''){return $_RESOURCE[$varname];}}
  else{return false;}
}
function arrayVar($_ARRAY,$varname=''){
  if($varname==''){
    if(isSet($_ARRAY)){return true;}else{return false;}
  }else{
    if(isSet($_ARRAY[$varname])){
        if($_ARRAY[$varname]=='' || $_ARRAY[$varname]!=''){
          return $_ARRAY[$varname];
        }
    }
    else
    {
      return false;
    }
  }
}

/*
 * funcao para retornar o nome correto do campo com o seed de protecao
 * */
function _sf($campo=''){
  $field = $campo;
  if(sessionVar('_sf')){
    $field = sessionVar('_sf')."_$campo";
    if($campo==''){return sessionVar('_sf');}
    else
    {return $field;}
  }
}


//FUNCAO PARA ENCRIPTAR STR DA SENHA
function mkpwd($str){
 $str = base64_encode($str.'obav');
 $str = md5($str);
 $str = base64_encode($str.'obav');
 $str = base64_encode(md5($str).'===');
 return $str;
}


//funcao para codificar strings
function encode($str,$seed='app/obavisto'){
  $string   = $seed.$str;
  $string2  = base64_encode($string);
  return $string2;
}

//funcao para decodificar strings
function decode($str,$seed='app/obavisto'){
  $open = str_replace($seed,'',base64_decode( str_replace($seed,'',$str) ) );
  return $open;
}


//funcao para conferencia de um CPF
function validaCPF($cpf = null) {

  // Verifica se um número foi informado
  if(empty($cpf)) {
    return false;
  }

  // Elimina possivel mascara
  $cpf = preg_replace("/[^0-9]/", "", $cpf);
  $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

  // Verifica se o numero de digitos informados é igual a 11
  if (strlen($cpf) != 11) {
    return false;
  }
  // Verifica se nenhuma das sequências invalidas abaixo
  // foi digitada. Caso afirmativo, retorna falso
  else if ($cpf == '00000000000' ||
    $cpf == '11111111111' ||
    $cpf == '22222222222' ||
    $cpf == '33333333333' ||
    $cpf == '44444444444' ||
    $cpf == '55555555555' ||
    $cpf == '66666666666' ||
    $cpf == '77777777777' ||
    $cpf == '88888888888' ||
    $cpf == '99999999999') {
    return false;
   // Calcula os digitos verificadores para verificar se o
   // CPF é válido
   } else {

    for ($t = 9; $t < 11; $t++) {

      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf{$c} * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf{$c} != $d) {
        return false;
      }
    }

    return true;
  }
}


//funcao para validar datas informadas
/*
 * https://www.linhadecomando.com/php/php-funcao-para-validar-data
 * */
function ValidaData($data){
    // data é menor que 8
    if ( strlen($data) < 8){
        return false;
    }else{
        // verifica se a data possui
        // a barra (/) de separação
        if(strpos($data, "/") !== FALSE){
            //
            $partes = explode("/", $data);
            // pega o dia da data
            $dia = $partes[0];
            // pega o mês da data
            $mes = $partes[1];
            // prevenindo Notice: Undefined offset: 2
            // caso informe data com uma única barra (/)
            $ano = isset($partes[2]) ? $partes[2] : 0;
 
            if (strlen($ano) < 4) {
                return false;
            } else {
                // verifica se a data é válida
                if (checkdate($mes, $dia, $ano)) {
                     return true;
                } else {
                     return false;
                }
            }
        }else{
            return false;
        }
    }
}


//funcao para validar email
function validaEmail($email=''){

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
  }else{
      return false;  
  }

}


//funcao para anotar no log de atividades
function logsys($str){
  $fp = fopen('sys.log.txt', 'a');
  fwrite($fp, date('d/m/y - H:i:s').' - '.$str."\n");
  fclose($fp);
}

//limpa logs
function clearLog(){
  $fp = fopen('sys.log.txt', 'w');fclose($fp);
}

//funcao para gerar senhas temporarias com 8 caracteres (POR PADRÃO)
function genPwd($intsize=8){
  //DETERMINA OS CARACTERES QUE CONTERÃO A SENHA
  $caracteres = "0123456789abcdefghijklmnopqrstuvwxyz+-/()";
  //EMBARALHA OS CARACTERES E PEGA APENAS OS 10 PRIMEIROS
  $mistura = substr(str_shuffle($caracteres),0,$intsize);
  //EXIBE O RESULTADO
  return $mistura;
}

?>
