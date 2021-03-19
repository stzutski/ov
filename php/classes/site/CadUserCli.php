<?php 
namespace site;

use \db\Sql;
use \db\ProcSql;


class CadUserCli{
  
  
  //consulta se o email informado ja esta em uso
  public function consultaEmail($email){
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM usuarios 
                          WHERE email_usuario = :email_usuario',array(
                          ':email_usuario'=>$email));
      
      if(count($res)>0){
        return 1001;//caso SIM email ja esta em uso
      }else{
        return 0;//tudo certo email NAO ESTA em uso
      }

    }else{
        return 1002;//email informado nao e valido
    }
  
  }//fim do consultaEmail
  
  //retorna dados do usuario com base na pesquisa do email dele
  public function getUserByEmail($email){
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
      
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM usuarios 
                          WHERE email_usuario = :email_usuario',array(
                          ':email_usuario'=>$email));
      
      if($res==false || count($res)==0){
        return 0;//caso NADA ENCONTRADO
      }else{
        return $res[0];//retorna array associativo com dados do usuario
      }

    }else{
        return false;//RETORNA FALSO (EMAIL INVÁLIDO)
    }
  
  }//fim do consultaEmail

  //cadastra novo usuario no sistema
  public function addNewUser($args=array()){
    
    //conferimos se o email informado não esta em uso
    $sql = new Sql();
    $res = $sql->select('SELECT * FROM usuarios WHERE email_usuario = :email_usuario',array(':email_usuario'=>$args['email_usuario']));
    if(count($res)==0){
    
      //geramos uma chave de validacao com base no email do usuario
      //esta chave será utilizada para a ativação do cadastro dele
      $userKEY= encode($args['email_usuario']);
      
      $query  = 'INSERT INTO usuarios (
                id_empresa, nome_usuario, sobrenome_usuario, email_usuario, 
                pwd_usuario, permissao_usuario, dt_usuario, cod_ativacao_usuario, status_usuario) 
                VALUES (
                :id_empresa, :nome_usuario, :sobrenome_usuario, :email_usuario,
                :pwd_usuario, :permissao_usuario, :dt_usuario, :cod_ativacao_usuario, :status_usuario)'; 
                
      $params = array(
                ':id_empresa'=>UIDEMPRESA,
                ':nome_usuario'=>$args['nome_usuario'],
                ':sobrenome_usuario'=>$args['sobrenome_usuario'],
                ':email_usuario'=>$args['email_usuario'],
                ':pwd_usuario'=>mkpwd($args['password']),
                ':permissao_usuario'=>'cliente',
                ':dt_usuario'=>time(),
                ':cod_ativacao_usuario'=>$args['cod_ativacao'],
                ':status_usuario'=>0);
                
      
      $res    = $sql->query($query,$params);  
      
      return $res;  
    }else{//SE EMAIL JA CADASTRADO RETORNA FALSE
      return 'erro1001';
    }
    
  }
  
  //cadastra novo cliente com base no usuário cadastrado
  public function addNewClient($args=array()){
    
    $query_addCli = 'INSERT INTO clientes (
                    id_usuario,
                    id_empresa,
                    nome_cliente,
                    sobrenome_cliente,
                    cpf_cliente,
                    uf_cliente,
                    cidade_cliente,
                    dt_cliente,
                    status_cliente) VALUES (
                    :id_usuario,     
                    :id_empresa,
                    :nome_cliente,
                    :sobrenome_cliente,
                    :cpf_cliente,
                    :uf_cliente,
                    :cidade_cliente,
                    :dt_cliente,
                    :status_cliente)';
      
      $paramsAddCli = array(
                    ':id_usuario'=>$args['id_usuario'],
                    ':id_empresa'=>UIDEMPRESA,
                    ':nome_cliente'=>$args['nome_usuario'],
                    ':sobrenome_cliente'=>$args['sobrenome_usuario'],
                    ':cpf_cliente'=>$args['cpf'],
                    ':uf_cliente'=>$args['uf'],
                    ':cidade_cliente'=>$args['cidade'],
                    ':dt_cliente'=>time(),
                    ':status_cliente'=>0);
      
      $sql = new Sql();
      $res = $sql->query($query_addCli, $paramsAddCli);    
      
      return $res;
    
  }
  
  //metodo para remocao de usuarios com base no ID USUARIO
  public function delUser($id_usuario){
    $sql    = new Sql();
    $remUse = $sql->query('DELETE FROM usuarios WHERE id_usuario = :id_usuario', array(':id_usuario'=>$id_usuario));
    if(!is_array($remUse)){
        return true;
    }else{
        return false;
    }
  }

  //metodo para remocao de cliente com base no ID USUARIO
  public function delClientUser($id_usuario){
    $sql    = new Sql();
    $remCli = $sql->query('DELETE FROM clientes WHERE id_usuario = :id_usuario', array(':id_usuario'=>$id_usuario));
    if(!is_array($remCli)){
        return true;
    }else{
        return false;
    }
  }

  //cadastro de novo usuário atraves do site
  public function cadastraUsuario($args){
    
    $userArgs = $args;
    $cliArgs  = $args;
    
    //geramos uma chave de validacao com base no email do usuario
    //esta chave será utilizada para a ativação do cadastro dele
    $codAtivacao              = encode($args['email_usuario']);      
    $userArgs['cod_ativacao'] = md5($codAtivacao);      
    
    //#1 cadastra o usuario e retorna o seu ID
    $usuario = $this->addNewUser($userArgs);
    
    if($usuario == 'erro1001'){
        return 'alert("O email informado já esta em uso!")';
    }
    elseif($usuario!='erro1001' && $usuario > 0)
    {
      
      $cliArgs['id_usuario'] = $usuario;
      
      //#2 cadastra o usuário como cliente e retorna o ID CLIENTE
      $cliente = $this->addNewClient($cliArgs);
      
      //#3 confere a criacao dos registros USUARIO <=> CLIENTE
      if(is_array($cliente))
      {//se for retornado um array significa que ocorreu um erro
        
        //por segurança apaga qualque registro possível para o usuario que recem tentou se cadastrar
        //assim nada impedirá de informar o mesmo endereço de email durante a nova tentativa de cadastro
        $this->delUser($usuario);
        $this->delClientUser($usuario);      
        
            
        return 'alert("01 ERRO TENTE NOVAMENTE MAIS TARDE!!!")';
        
      }
      elseif($cliente>0)
      { 
        //caso contrario procede com a rotina
        //confere se a tabela de clientes possui um registro vinculado a tabela usuarios através de ID_USUARIO
        $sql = new Sql();
        $res = $sql->select('SELECT * FROM clientes WHERE id_usuario = :id_usuario',array(':id_usuario'=>$usuario));
        
          if(is_array($res) && count($res)==0)
          {
            //SE NENHUM REGISTRO FOR ENCONTRADO ENTÃO OCORREU ERRO NO CADASTRO DO CLIENTE
            //sera necessário remover o registro do usuario para que no futuro ele possa novamente se cadastrar
            //utilizando o mesmo e-mail
            
            $this->delUser($usuario);
            $this->delClientUser($usuario); 
            return 'alert("02 ERRO TENTE NOVAMENTE MAIS TARDE!!!")';
            
          }
          elseif(count($res)==1)
          {
            //SE APENAS 1 REGISTRO FOR ENCONTRATO!!
            //CADASTRO OK RETORNA O CODIGO DE ATIVACAO DO USUARIO 
            //return 'window.location="'.URLAPP.'?user=confirm&code='.$codAtivacao.'"';
            return $userArgs['cod_ativacao'];
          }
      }
    }//final cadastro 
  }//final cadastraUsuario
  
  //metodo para gerar o hash de recuperacao de senha (retorna um array com dados do usuario e o hash gerado)
  public function passRecovery($email=''){
    
      $ret = '';//var para retorno
            
      if($email!=''){//se email informado
        
        $sql = new Sql();
        //consulta email informado na tabela de usuários
        $res = $sql->select('SELECT * FROM usuarios WHERE email_usuario = :email_usuario',array(':email_usuario'=>$email)); 
        
        //caso nada encontrado retorna ZERO
        if(is_array($res) && count($res)==0){
          
          $ret = 0;//email nao encontrado
        
        }
        elseif(count($res)==1)//caso encontrado então gera o link para recuperacao com base no ID e EMAIL do usuario
        {
          $_userData  = array();
          $dataUser   = $res[0];
          $_linkTtime = date('Y-m-d H:i:s');
          $_userData['userdata']  = $dataUser;
          $_userData['hash']      = md5(  base64_encode($dataUser['id_usuario'])  );
          $_userData['hrlimit']   = date("d/m/Y H:i:s", strtotime("+1 hours"));
          
          
          $paramsRecovery = array(
                              ':id_usuario'=>$res[0]['id_usuario'],
                              ':hash_recovery'=>md5(  base64_encode($dataUser['id_usuario'])  ),
                              ':dt_register'=>$_linkTtime
                              );
          
          
          //gera cadastro na tabela de recuperacao de senha
          $res = $sql->query('INSERT INTO pwd_recovery (
                              id_usuario,
                              hash_recovery,
                              dt_register
                              ) VALUES ( 
                              :id_usuario, 
                              :hash_recovery, 
                              :dt_register )',$paramsRecovery);
          
          
          if($res>1){//se hash anotado corretamente retorna a url para redirect
            
            $user_key     = md5(base64_encode($dataUser['id_usuario']));
            $user_uid     = $dataUser['id_usuario'];
            $_url         = "$user_key";//hash (IDusuario)/(HASH)
            $ret          = $_url;
            
            
            $_userData['userdata']  = $_userData;
            $_userData['urlHash']   = $ret;
            //$hashRecovery = $ret;
            
            //retorna a URL com o hash para o reset da senha do usuário
            return $_userData;
            
          }else{//caso contrario retorna falso
            
            
            $ret = false;
            return $ret;
          }
        }
      
    }else{
      $ret = 0;//email nao informado retorna 0
      return $ret;
    }
  
  }//end method passRecovery
  
  //metodo para conferir o hash de recuperacao e autorizar a nova senha
  public function chkPassRecovery($hash='',$uid=''){

    $ret='';
    if($hash!='' && $uid!=''){//se chave e uid do usuario for informado
      
      //consulta na tabela de recuperacao de senha
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM pwd_recovery WHERE
                          id_usuario = :id_usuario AND
                          hash_recovery = :hash_recovery AND
                          DATE_ADD(dt_register, INTERVAL 1 HOUR) >= NOW()',array(
                          ':id_usuario'=>$uid,
                          ':hash_recovery'=>$hash));
      
      if(count($res)==0){//ativador nao valido
        $ret = false;
      }else{//caso valido retorna o HASH que sera utilizado para autorizar a nova senha
        $ret = $hash;
      }
    }
    
    return $ret;
  }
  
  //metodo para salvar senha temporaria no banco de dados
  public function savePwdTmp($uid='',$pwdTmp=''){
  
    if($uid!='' && $pwdTmp!=''){//se id de usuario e senha temporaria for informada procede com o update
      $sql    = new Sql();
      $update = $sql->query('UPDATE usuarios SET 
                            pwd_usuario = :pwd_usuario 
                            WHERE 
                            id_usuario = :id_usuario',array(':pwd_usuario'=>$pwdTmp,
                                                            ':id_usuario'=>$uid));
                                                            
      if($update==1){//se retornar 1 linha alterada entao ok
        
        //entao remove todas as solicitacoes de alteracao de senha pendentes na tabela
        $remove = $sql->query('DELETE FROM pwd_recovery WHERE
                              id_usuario = :id_usuario',array(':id_usuario'=>$uid));
        
        //retorna o ID USUARIO que teve sua senha atualizada
        return $uid;
      }
      else
      {
        //retorna ZERO informando que ocorreu um erro na atualizacao da senha temporaria
        return 0;
      }
                                                            
      
    }
    else //caso contrario retorna false
    {
        return false;
    }
    
  }
  
  //metodo para validar o HASH de recuperacao de senha e retornar o ID USUARIO
  public function getUserByHash($hash=''){

    if($hash!='')
    {
      
      //consulta validade do link HASH
      $sql = new Sql();
      $res = $sql->select('SELECT * FROM pwd_recovery WHERE 
                          hash_recovery = :hash_recovery AND
                          DATE_ADD(dt_register, INTERVAL 1 HOUR) >= NOW() LIMIT 0,1',
                          array(':hash_recovery'=>$hash));
                          
      
      //caso nada encontrado então ou o HASH é inválido ou o tempo limite expirou
      if(count($res)==0){
        //sinaliza como não alterado pois o hash é invalido
        $_result = 0;
      }
      else
      {
        //recebe ID USUARIO que sera necessario para o update da senha 
        $recoveryData = $res[0];
        $_result      = $recoveryData['id_usuario'];                          
      }        
      return $_result;
      
    }
    else
    {
      return false;
    }

  }

  //metodo para retornar dados do usuario pelo ID USUARIO
  public function getUserById($uid=''){
    if($uid!=''){//se ID USUARIO for informado

      $sql = new Sql();
      $res = $sql->select('SELECT * FROM usuarios WHERE id_usuario = :id_usuario',array(':id_usuario'=>$uid));
      if(count($res)==0){//se nada encontrado
          return 0;
      }else{
          return $res[0];//se usuario encontrado (retorna um array associativo com os dados dele)
      }
    
    }else{//se ID USUARIO não informado RETORNA FALSE
        return false;
    }  

  } 

  //metodo para login do usuario
  public function loginUser($user,$pwd){
    
    $pwdCr    = mkpwd($pwd);
    
    
    
    $sql      = new Sql();
    $userData = $sql->select('SELECT * FROM usuarios 
                            WHERE email_usuario = :email_usuario
                            AND pwd_usuario = :pwd_usuario',array(':email_usuario'=>$user,':pwd_usuario'=>$pwdCr));
                            
    if(!isSet($userData) || count($userData)==0){//CASO NADA RETORNADO
        return false;
    }elseif(count($userData)>0){//CASO DADOS RETORNADOS CONFERE O STATUS
      
      if($userData[0]['status_usuario']==0){
          
          return 0;//caso INATIVO entao retorna ZERO indicando cadastro NAO ATIVO
      
      }elseif($userData[0]['status_usuario']==1){//CASO USUARIO ATIVO GERA SESSION DO LOGIN
        
          
          //permissao do cliente
          $_SESSION['_uL']    = encode($userData[0]['permissao_usuario']);
          $_SESSION['logado'] = 'sim';
          
          //dados do usuario
          $_SESSION['_iU']    = encode($userData[0]['id_usuario']);
          $_SESSION['_iE']    = encode($userData[0]['id_empresa']);
          $_SESSION['_nU']    = encode($userData[0]['nome_usuario'] . ' ' . $userData[0]['sobrenome_usuario']);
          $_SESSION['_eU']    = encode($userData[0]['email_usuario']);
          
          return 1;
      }
      
    }
                            
    
  }
  
  //metodo para realizar a ativacao do cadastro do usuario
  public function userCadConfirm($codConfirmacao=''){
    

    
    if($codConfirmacao==''){//se em branco retorna NULL (erro)
        
        
        return null;
    
    }else{//caso codigo informado procede com a conferencia e a ativacao
    
    
    
      $sql = new Sql();
      $ativacao = $sql->select('SELECT * FROM usuarios 
                                WHERE cod_ativacao_usuario = :cod_ativacao_usuario',
                                array(':cod_ativacao_usuario'=>$codConfirmacao)); 
      
      if(count($ativacao)==0){
        
      
        return null;//caso nada encontrado retorna NULL (deve pode ser um codigo invalido)
      
      }elseif(count($ativacao)>0){//caso codigo de confirmacao for OK entao ativa o cadastro
        
        
        //obtem o id do usuario
        $id_usuario = $ativacao[0]['id_usuario'];
        
        
        //verifica se existe a necessidade de ativacao
        if($ativacao[0]['status_usuario']==1){//cadastro JA ATIVO basta notificar
          
          return true;//retorna true confirmando que o cadastro esta atualizado 
          
        }elseif($ativacao[0]['status_usuario']==0){//CASO INATIVO ENTÃO PROCEDE COM A ATIVACAO
        
          //atualiza o cadastro do usuario ativando ele
          $res = $sql->query('UPDATE usuarios SET status_usuario = 1
                              WHERE id_usuario = :id_usuario',
                              array(':id_usuario'=>$id_usuario));
                              
          if($res>0){//se o numero de linhas afetadas for maior que ZERO
            
            return true;//retorna true confirmando que o cadastro esta atualizado
            
          }else{
            return false;//caso nada encontrado retorna FALSE (pode ter ocorrido erro na atualizacao)

          }
        }
      } 
    }
  }
  
  
  
}

?>
