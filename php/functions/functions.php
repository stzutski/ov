<?php
// auto carregamento das classes
spl_autoload_register(function ($class) {
    require_once(str_replace('\\', '/', "php/classes/$class.php"));
});



/*
 * funcao para retornar os dados do servico selecionado
 * */
function getDataService($idServico='',$idEmpresa='1'){
  if($idServico!='' && $idEmpresa!=''){
  $resServs = dbf('SELECT * FROM servicos WHERE id_servico = :id_servico AND id_empresa = :id_empresa',
                  array(':id_servico'=>$idServico,':id_empresa'=>$idEmpresa),'fetch');
    if(is_array($resServs) && count($resServs)>0){
      return $resServs;
    }else{
      return false;
    }
  }else{
    return false;  
  }
}    


/*
 * funcao para cadastrar usuario e clientes (CADASTRO INICIAL)
 * */
function add_newUserCli($args=array()){

  $sts_cad  = false;
  
  $resUsr   = dbf('INSERT INTO usuarios 
                  (id_empresa,nome_usuario,sobrenome_usuario,email_usuario,telefone_usuario,pwd_usuario,permissao_usuario,dt_usuario,cod_ativacao_usuario,status_usuario)
                  VALUES 
                  (:id_empresa,:nome_usuario,:sobrenome_usuario,:email_usuario,:telefone_usuario,:pwd_usuario,:permissao_usuario,:dt_usuario,:cod_ativacao_usuario,:status_usuario)',
                  array(
                  ':id_empresa'           => $args['id_empresa'],
                  ':nome_usuario'         => $args['nome'],
                  ':sobrenome_usuario'    => $args['sobrenome'],
                  ':email_usuario'        => $args['email'],
                  ':telefone_usuario'     => $args['telefone'],
                  ':pwd_usuario'          => $args['senha'],
                  ':permissao_usuario'    => 'cliente',
                  ':dt_usuario'           => $args['dt_cad'],
                  ':cod_ativacao_usuario' => $args['cod_ativacao'],
                  ':status_usuario'       => $args['status']));
  
  if($resUsr>0){
    $id_usuario = $resUsr;

    $resCli     = dbf('INSERT INTO clientes
                      (id_usuario,id_empresa,nome_cliente,sobrenome_cliente,cpf_cliente,uf_cliente,cidade_cliente,dt_cliente,status_cliente)
                      VALUES
                      (:id_usuario,:id_empresa,:nome_cliente,:sobrenome_cliente,:cpf_cliente,:uf_cliente,:cidade_cliente,:dt_cliente,:status_cliente)',
                      array(':id_usuario'         => $id_usuario,
                            ':id_empresa'         => $args['id_empresa'],
                            ':nome_cliente'       => $args['nome'],
                            ':sobrenome_cliente'  => $args['sobrenome'],
                            ':cpf_cliente'        => $args['cpf'],
                            ':uf_cliente'         => $args['uf'],
                            ':cidade_cliente'     => $args['cidade'],
                            ':dt_cliente'         => $args['dt_cad'],
                            ':status_cliente'     => $args['status']));
    
    
      if($resCli>0)
      {
        $sts_cad = $id_usuario; //caso cadastro positivo retorna o ID do usuario recem cadastrado
        $msg_cad = "Cadastrado com sucesso";
      }
      else
      {
        //caso cadastro do cliente tenha falhado entao remove usuario recem cadastrado e assinala o erro
        $remUsr = dbf('DELETE FROM usuarios WHERE id_usuario = :id_usuario AND id_empresa = :id_empresa',
                      array(':id_usuario'=>$id_usuario,':id_empresa'=>$args['id_empresa']));
                      
        $sts_cad = false; //caso erro no cadastro retorna FALSE
        $msg_cad = "Ocorreu um erro durante o cadastro\n tente novamente mais tarde!";
      }
  }
  else
  {
    $sts_cad = false; //caso erro no cadastro retorna FALSE
  }
  
  return $sts_cad;
}


/*
 * funcao para converter str decimal em float
 * */
function strToFloat($str){
  $number = false;
  $number = floatval(str_replace(',', '.', str_replace('.', '', $str)));
  return $number;
}

/*
 * funcao pre historica REFATORADA dbf(str1,array,str2);
 * recebe 
 * str1 a query a ser executada
 * array() campos para o prepare do PDO
 * str2 tipo de retorno esperado (fetch,num)
 * */
function dbf($query='',$args=array(),$ret=''){
  $results=false;
    if($query!=''){
    $hostname = "localhost";
    $username = "servidor";
    $password = "Nv32125";
    $dbname   = "obv";
    try {
        $conn     = new PDO("mysql:dbname=$dbname;host=$hostname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt     = $conn->prepare($query);
        
        //BINDPARAMS
        if(is_array($args)&&count($args)>0){
          foreach ($args as $key => &$value) {
            $valor = $value;
            $stmt->bindParam( $key , $value);
          }
        }
        //EXECUTE QUERY
        $stmt->execute();
          if(strstr(strtoupper($query),'INSERT')){$results  = $conn->lastInsertId();}//ultimo ID inserido
          if(strstr(strtoupper($query),'UPDATE')){$results  = $stmt->rowCount();}//ultimo ID inserido
          if(strstr(strtoupper($query),'DELETE')){$results  = $stmt->rowCount();}//ultimo ID inserido
          if($ret=='fetch'){$results  = $stmt->fetchAll(PDO::FETCH_ASSOC);}
          if($ret=='num'){$results  = $stmt->rowCount();}//numero de linhas afetadas
    } catch (PDOException $e) {
    $results = 'ERROR:'.$e->getMessage();
    }
  }
  return $results;
}


/*
 * FUNCAO PARA RETORNAR ARRAY DE DADOS (DE UMA TABELA) PARA MONTAGEM DE CAMPOS SELECT
 * recebe str=(nome da tabela), array de args(indice na tabela, nome coluna)
 * */
function mkSelFDB($res,$args=array()){
  $result = array();
  if(is_array($res)&&count($res)>0){
    $idx = $args['indice'];
    $col = $args['coluna'];
    for ($i = 0; $i < count($res); $i++)
    {
      $data = $res[$i];
      $a = $data[$idx];
      $b = $data[$col];
      $result[$a] = $b;
    }
  }
  return $result;
}


/*
 * funcao para repopular formularios de acordo com a origem dos dados
 * ex recebe 2 indices o primeiro para retornos do db o segundo para
 * retornos do post no formulario...
 * se POST for falso busca em Array de Dados e utilizada em formularios
 * de cadastros diversos onde caso ocorra erro no processamento os
 * campos do form serao repopulados com o conteudo do ultimo post
 * evitando a redigitacao
 * */
function popform($dbSrc=array(),$dbIndex='',$postIndex=''){
  $res=false;
  if(!postVar($postIndex)){//caso "NAO SEJA POST" retorna dados do array de dados
    if(dataVar($dbSrc,$dbIndex)!=''){$res = dataVar($dbSrc,$dbIndex);}else{$res = '0';}
  }else{//caso "SEJA POST" retorna dados do POST
    if(postVar($postIndex)!=''){$res = postVar($postIndex);}else{$res = '0';}
  }
  return $res;
}




/*
 * funcao para auxiliar no DEV realiza a listagem recursiva de arrays
 * recebe array
 * retorna str
 * */
function reList($arr){
  if(is_array($arr) && count($arr)>0){
    $str='';
    foreach ($arr as $key => $value) {
      if(is_array($value)){
        reList($value);
      }else{
        echo "{$key} => {$value}<br />";
      }
    }
  }
}


/*
 * funcao para echoar N/A ou N/D no retorno de dados
 * */
 if(!function_exists('naNd')){
  function naNd($str='',$def='N/D'){
    if($str==''){return $def;}else{return $str;}
  }
}

/*
 * funcao auxiliar para dev (cria um box colapsavel) para dados brutos
 * recebe str (header | footer) só para criar a tag
 * */
if (!function_exists('boxColapse')) {
  function boxColapse($opt='header',$btnText=''){
    $tag='';
    $rand = rand(0,255).date('His');
    if($opt=='header'){
    $tag = '<button data-toggle="collapse" data-target="#col'.$rand.'" class="btn btn-warning btn-sm"><i class="fas fa-exclamation-triangle"></i>'.$btnText.'</button>
    <div id="col'.$rand.'" class="collapse">';
    }
    if($opt=='footer'){
    $tag='</div>';
    }
    return $tag;
  }
}



/*
 * funcao para converter valor financeiro em FLOAT
 * */
function toFloat($str=''){
  $valor = false;
  if($str!=''){
    $valor = str_replace('.','',$str);
    $valor = str_replace(',','.',$valor);
  }
  return $valor;
}


/*
 * funcao para montar lista com arrays recursivos
 * */
function ulArr($array){

  $tag="<ul>\n";
    foreach ($array as $key => $value) {
      $tag.="<li>";
      if(is_array($value)){
        $tag.=ulArr($value);
      }else{
        $tag.= "{$key}: $value";
      }
      $tag.="</li>\n";
    }
  $tag.="</ul>\n";
  
  return $tag;
}



//FUNCAO PARA LISTA TMP DE DADOS RETORNA UMA TAG UL COM OS VALORES DO ARRAY
function listaForeach($arr=array(),$classCss=''){
  $tag_ul          = false;
  $tag_uls='';
  $item_lista      =  "";
  if($classCss!='')  {$classCss = ' class="'.$classCss.'" ';}
  if(is_array($arr)){
    for ($i = 0; $i < count($arr); $i++)
    {
      $item_lista    .=  "<ul".$classCss.">\n";
      $item          = $arr[$i];
      foreach ($item as $key => $value) {
        $item_lista .= "<li>{$key} => {$value}</li>\n";
      }
      $item_lista   .= "</ul>\n";
      //$item_lista   .= "<li><br /></li>\n";
      $tag_ul        = $item_lista;
    }
  }
  //return "<ul>$item_lista</ul>";
  return $item_lista;
}


//FUNCAO ATALHO TRATAMENTO DE RETORNO DE ARRAYS DE DADOS
function dbRet($db=array()){
  $ret = false;
  if(is_array($db)){
    if(count($db)==1){
      $ret = $db[0];
    }
    if(count($db)>1){
      $ret = $db;
    }
  }
  return $ret;
}


//FUNCAO TEMPORARIA PARA ENVIO DE EMAILs
function mailTo($to='',$subject='',$message=''){
  
  if($to!=''&&$subject!=''&&$message!=''){

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'To: ' . $to . "\r\n";
    $headers .= 'From: ' . MAILFROM . "\r\n";
    $headers .= 'Reply-To: ' . MAILFROM . "\r\n";
    $headers .= 'X-Mailer: PHP/ ' . phpversion();

    if(!mail($to, $subject, $message, $headers)){
      return false;
    }else{
      return true;
    }
  
  }else{
    return false;  
  }
  
}

// helpers para vars
function chkVar($varname){
  if(isSet($varname)){return $varname;}
  else
  {return false;}
}
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

//Funcao para gerar codigo de ativacao do usuario
function userCodeActiv($str){
  return md5(encode($str));
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
