<?php 
if(postVar('go')=='ficha'){
  $_ficha=array();
  //busca dados na ficha atual
  $res = dbf('SELECT * FROM ficha WHERE id_ficha = :id_ficha',array(':id_ficha'=>1),'fetch');
  if(is_array($res)&&count($res)>0){
    
    logsys("Existem dados na ficha de teste!!!");
    
    //caso existam dados...
    //dados para registro
    $index    = postVar('pk');
    $content  = postVar('content');    
    
    //recupero os dados serializados
    $dados_serializados = stripslashes($res[0]['ficha']);
    logsys("VAR $"."dados_serializados:::" .$dados_serializados);
    
    //desSerializo os dados da tabela de dados
    $_ficha             = unserialize($dados_serializados);
    
    //se conteudo for vazio gera string VAZIO
    if($content==''){
    $content='vazio';  
    }
    
    //atualizo ou crio um novo indice no array de dados 
    $_ficha[$index]     = $content;
    $percentual         = calcFichaPercent($_ficha);
    
    logsys("PERCENTUAL ATUALIZADO:: ($percentual)");
    
    //serializa array de dados da ficha
    $se_ficha           = serialize($_ficha);
    
    //atualizo na tabela de dados o registro
    $res2               = dbf('UPDATE ficha SET ficha = :ficha WHERE id_ficha = :id_ficha',array(':ficha'=>$se_ficha,':id_ficha'=>1));
    if(!is_array($res2)&&$res2>=0){
      logsys("Novos dados serializados salvos::: ".$se_ficha);
      echo 'el.html("'.$content.'");$(".fpercent").html("'.$percentual.'%");';  
      //
    }
    else
    {
      logsys("ERRO NA ATUALIZACAO DA FICHA:::" . json_encode($se_ficha));
      echo 'alert("Erro na atualizacao!")'; 
    }
    
  }
  else
  {
    
    if(postVar('pk')!=''&&postVar('content')!=''){
      logsys("Ficha estava fazia, inserindo o primeiro registro...");
      $index          = postVar('pk');
      $content        = postVar('content');
      $_ficha[$index] = $content;
      $se_ficha       = serialize($_ficha);//serializa array de dados da ficha
      
      $percentual     = calcFichaPercent($_ficha);
      logsys("PERCENTUAL CADASTRADO:: ($percentual)");
      
      //grava informacao no banco de dados
      $res = dbf('INSERT INTO ficha (ficha) VALUES (:ficha)',array(':ficha'=>$se_ficha));
      if($res>0){
        echo 'el.html("'.$content.'");$(".fpercent").html("'.$percentual.'%");';
      }
      else
      {
        echo 'alert("Erro na atualizacao!")';
      }
    }
  }
  
  //### fim da insercao ou atualizacao da ficha no banco de dados

  
}else{

$dt_ficha = array();
$percentual = 0;

  //RECUPERA DADOS PARA PREENCHER O FORMULARIO COM OS DADOS JA CADASTRADOS
  $res = dbf('SELECT * FROM ficha WHERE id_ficha = :id_ficha',array(':id_ficha'=>1),'fetch');
  if(is_array($res)&&count($res)>0){
    $dados_serializados = stripslashes($res[0]['ficha']);

    //desSerializo os dados da tabela de dados
    $dt_ficha           = unserialize($dados_serializados);  
    $a  = $dt_ficha;  
    
    $percentual         = calcFichaPercent($dt_ficha);
  }


$dt_ficha['1'] =   __fly(array('id'=>'c001','type'=>'text','value'=>cFi($a,'c001','@perfil')));
$dt_ficha['2'] =   __fly(array('id'=>'c002','type'=>'text','value'=>cFi($a,'c002','@perfil')));
$dt_ficha['3'] =   __fly(array('id'=>'c003','type'=>'text','value'=>cFi($a,'c003','@perfil')));
$dt_ficha['4'] =   __fly(array('id'=>'c004','type'=>'select','value'=>cFi($a,'c004','Selecione'),'mask'=>'data','opts'=>'São Paulo|Brasilia|Rio Grande do Sul|Rio de Janeiro'));
$dt_ficha['5'] =   __fly(array('id'=>'c005','type'=>'text','value'=>cFi($a,'c005','Seu nome')));
$dt_ficha['6'] =   __fly(array('id'=>'c006','type'=>'text','value'=>cFi($a,'c006','CPF'),'mask'=>'cpf'));
$dt_ficha['7'] =   __fly(array('id'=>'c007','type'=>'text','value'=>cFi($a,'c007','00/00/0000'),'mask'=>'data'));
$dt_ficha['8'] =   __fly(array('id'=>'c008','type'=>'select','value'=>cFi($a,'c008','Selecione'),'opts'=>'Solteiro|Casado|União Estável|Noivo|Viúvo|Divorciado'));
$dt_ficha['9'] =   __fly(array('id'=>'c009','type'=>'text','value'=>cFi($a,'c009','Descreva o motivo')));
$dt_ficha['10'] =  __fly(array('id'=>'c010','type'=>'text','value'=>cFi($a,'c010','informe')));
$dt_ficha['11'] =  __fly(array('id'=>'c011','type'=>'select','value'=>cFi($a,'c011','Selecione'),'opts'=>'AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO','max'=>'2'));
$dt_ficha['12'] =  __fly(array('id'=>'c012','type'=>'text','value'=>cFi($a,'c012','informe')));
$dt_ficha['13'] =  __fly(array('id'=>'c013','type'=>'select','value'=>cFi($a,'c013','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['14'] =  __fly(array('id'=>'c014','type'=>'text','value'=>cFi($a,'c014','informe')));
$dt_ficha['15'] =  __fly(array('id'=>'c015','type'=>'select','value'=>cFi($a,'c015','Selecione'),'opts'=>'MASC|FEM'));
$dt_ficha['16'] =  __fly(array('id'=>'c016','type'=>'text','value'=>cFi($a,'c016','informe')));
$dt_ficha['17'] =  __fly(array('id'=>'c017','type'=>'text','value'=>cFi($a,'c017','00/00/0000'),'mask'=>'data','max'=>10));
$dt_ficha['18'] =  __fly(array('id'=>'c018','type'=>'text','value'=>cFi($a,'c018','informe')));
$dt_ficha['19'] =  __fly(array('id'=>'c019','type'=>'text','value'=>cFi($a,'c019','00/00/0000'),'mask'=>'data','max'=>10));
$dt_ficha['20'] =  __fly(array('id'=>'c020','type'=>'select','value'=>cFi($a,'c020','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['21'] =  __fly(array('id'=>'c021','type'=>'text','value'=>cFi($a,'c021','informe')));
$dt_ficha['22'] =  __fly(array('id'=>'c022','type'=>'text','value'=>cFi($a,'c022','informe')));
$dt_ficha['23'] =  __fly(array('id'=>'c023','type'=>'text','value'=>cFi($a,'c023','informe')));
$dt_ficha['24'] =  __fly(array('id'=>'c024','type'=>'select','value'=>cFi($a,'c024','Selecione'),'opts'=>'AC|AL|AP|AM|BA|CE|DF|ES|GO|MA|MT|MS|MG|PA|PB|PR|PE|PI|RJ|RN|RS|RO|RR|SC|SP|SE|TO','max'=>'2'));
$dt_ficha['25'] =  __fly(array('id'=>'c025','type'=>'text','value'=>cFi($a,'c025','00/00/0000'),'mask'=>'data','max'=>10));
$dt_ficha['26'] =  __fly(array('id'=>'c026','type'=>'text','value'=>cFi($a,'c026','00/00/0000'),'mask'=>'data','max'=>10));
$dt_ficha['27'] =  __fly(array('id'=>'c027','type'=>'select','value'=>cFi($a,'c027','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['28'] =  __fly(array('id'=>'c028','type'=>'text','value'=>cFi($a,'c028','Detalhes')));
$dt_ficha['29'] =  __fly(array('id'=>'c029','type'=>'text','value'=>cFi($a,'c029','Nome Completo')));
$dt_ficha['30'] =  __fly(array('id'=>'c030','type'=>'select','value'=>cFi($a,'c028','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['31'] =  __fly(array('id'=>'c031','type'=>'text','value'=>cFi($a,'c031','Detalhes')));
$dt_ficha['32'] =  __fly(array('id'=>'c032','type'=>'select','value'=>cFi($a,'c032','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['33'] =  __fly(array('id'=>'c033','type'=>'text','value'=>cFi($a,'c033','nome(s) país(es)')));
$dt_ficha['34'] =  __fly(array('id'=>'c034','type'=>'select','value'=>cFi($a,'c034','Selecione'),'opts'=>'Turismo|Estudo|Trabalho Legal|Investimento/Negócios|Cidadania'));
$dt_ficha['35'] =  __fly(array('id'=>'c035','type'=>'select','value'=>cFi($a,'c035','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['36'] =  __fly(array('id'=>'c036','type'=>'text','value'=>cFi($a,'c026','Num. SSN.')));
$dt_ficha['37'] =  __fly(array('id'=>'c037','type'=>'text','value'=>cFi($a,'c037','Informar')));
$dt_ficha['38'] =  __fly(array('id'=>'c038','type'=>'text','value'=>cFi($a,'c038','Informar')));
$dt_ficha['39'] =  __fly(array('id'=>'c039','type'=>'text','value'=>cFi($a,'c039','Informar')));
$dt_ficha['40'] =  __fly(array('id'=>'c040','type'=>'text','value'=>cFi($a,'c040','Informar')));
$dt_ficha['41'] =  __fly(array('id'=>'c041','type'=>'text','value'=>cFi($a,'c041','Informar'),'mask'=>'zipbr','max'=>9));
$dt_ficha['42'] =  __fly(array('id'=>'c042','type'=>'text','value'=>cFi($a,'c042','Informar'),'mask'=>'telefone'));
$dt_ficha['43'] =  __fly(array('id'=>'c043','type'=>'text','value'=>cFi($a,'c043','00/00/0000'),'mask'=>'data','max'=>10));
$dt_ficha['44'] =  __fly(array('id'=>'c044','type'=>'select','value'=>cFi($a,'c044','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['45'] =  __fly(array('id'=>'c045','type'=>'text','value'=>cFi($a,'c045','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['46'] =  __fly(array('id'=>'c046','type'=>'select','value'=>cFi($a,'c046','Selecione'),'opts'=>'5 a 9 dias|10 a 15 dias|30 dias ou +'));
$dt_ficha['47'] =  __fly(array('id'=>'c047','type'=>'select','value'=>cFi($a,'c047','Selecione'),'opts'=>'Hotel|Hostel|AirBnB|Casa de amigo|Casa de Parente'));
$dt_ficha['48'] =  __fly(array('id'=>'c048','type'=>'select','value'=>cFi($a,'c048','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['49'] =  __fly(array('id'=>'c049','type'=>'text','value'=>cFi($a,'c049','Informar')));
$dt_ficha['50'] =  __fly(array('id'=>'c050','type'=>'select','value'=>cFi($a,'c050','Selecione'),'opts'=>'Sozinho|Acompanhado|Por alguma empresa'));
$dt_ficha['51'] =  __fly(array('id'=>'c051','type'=>'text','value'=>cFi($a,'c051','Informar')));
$dt_ficha['52'] =  __fly(array('id'=>'c052','type'=>'text','value'=>cFi($a,'c052','Informar')));
$dt_ficha['53'] =  __fly(array('id'=>'c053','type'=>'text','value'=>cFi($a,'c053','Informar')));
$dt_ficha['54'] =  __fly(array('id'=>'c054','type'=>'select','value'=>cFi($a,'c054','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['55'] =  __fly(array('id'=>'c055','type'=>'text','value'=>cFi($a,'c055','Informar')));
$dt_ficha['56'] =  __fly(array('id'=>'c056','type'=>'text','value'=>cFi($a,'c056','Informar')));
$dt_ficha['57'] =  __fly(array('id'=>'c057','type'=>'select','value'=>cFi($a,'c057','Selecione'),'opts'=>'Eu mesmo|Um Parente|Um Amigo|Meu Empregador'));
$dt_ficha['58'] =  __fly(array('id'=>'c058','type'=>'text','value'=>cFi($a,'c058','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['59'] =  __fly(array('id'=>'c059','type'=>'select','value'=>cFi($a,'c059','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['60'] =  __fly(array('id'=>'c060','type'=>'select','value'=>cFi($a,'c060','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['61'] =  __fly(array('id'=>'c061','type'=>'text','value'=>cFi($a,'c061','Informar')));
$dt_ficha['62'] =  __fly(array('id'=>'c062','type'=>'text','value'=>cFi($a,'c062','00/00/0000'),'mask'=>'data'));
$dt_ficha['63'] =  __fly(array('id'=>'c063','type'=>'text','value'=>cFi($a,'c063','00/00/0000'),'mask'=>'data'));
$dt_ficha['64'] =  __fly(array('id'=>'c064','type'=>'select','value'=>cFi($a,'c064','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['65'] =  __fly(array('id'=>'c065','type'=>'text','value'=>cFi($a,'c065','número')));
$dt_ficha['66'] =  __fly(array('id'=>'c066','type'=>'text','value'=>cFi($a,'c066','00/00/0000'),'mask'=>'data'));
$dt_ficha['67'] =  __fly(array('id'=>'c067','type'=>'select','value'=>cFi($a,'c067','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['68'] =  __fly(array('id'=>'c068','type'=>'text','value'=>cFi($a,'c068','motivo')));
$dt_ficha['69'] =  __fly(array('id'=>'c069','type'=>'select','value'=>cFi($a,'c069','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['70'] =  __fly(array('id'=>'c070','type'=>'text','value'=>cFi($a,'c070','00/00/0000'),'mask'=>'data'));
$dt_ficha['71'] =  __fly(array('id'=>'c071','type'=>'select','value'=>cFi($a,'c071','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['72'] =  __fly(array('id'=>'c072','type'=>'text','value'=>cFi($a,'c072','Informar')));
$dt_ficha['73'] =  __fly(array('id'=>'c073','type'=>'select','value'=>cFi($a,'c073','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['74'] =  __fly(array('id'=>'c074','type'=>'text','value'=>cFi($a,'c074','Informar')));
$dt_ficha['75'] =  __fly(array('id'=>'c075','type'=>'select','value'=>cFi($a,'c075','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['76'] =  __fly(array('id'=>'c076','type'=>'select','value'=>cFi($a,'c076','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['77'] =  __fly(array('id'=>'c077','type'=>'text','value'=>cFi($a,'c077','Informar')));
$dt_ficha['78'] =  __fly(array('id'=>'c078','type'=>'text','value'=>cFi($a,'c078','Informar')));
$dt_ficha['79'] =  __fly(array('id'=>'c079','type'=>'text','value'=>cFi($a,'c079','Informar')));
$dt_ficha['80'] =  __fly(array('id'=>'c080','type'=>'text','value'=>cFi($a,'c080','00/00/0000'),'mask'=>'data'));
$dt_ficha['81'] =  __fly(array('id'=>'c081','type'=>'text','value'=>cFi($a,'c081','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['82'] =  __fly(array('id'=>'c082','type'=>'text','value'=>cFi($a,'c082','Informar'),'mask'=>'telefone'));
$dt_ficha['83'] =  __fly(array('id'=>'c083','type'=>'select','value'=>cFi($a,'c083','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['84'] =  __fly(array('id'=>'c084','type'=>'text','value'=>cFi($a,'c084','Informar'),'mask'=>'cnpj'));
$dt_ficha['85'] =  __fly(array('id'=>'c085','type'=>'select','value'=>cFi($a,'c085','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['86'] =  __fly(array('id'=>'c086','type'=>'select','value'=>cFi($a,'c086','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['87'] =  __fly(array('id'=>'c087','type'=>'select','value'=>cFi($a,'c087','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['88'] =  __fly(array('id'=>'c088','type'=>'text','value'=>cFi($a,'c088','Informar')));
$dt_ficha['89'] =  __fly(array('id'=>'c089','type'=>'text','value'=>cFi($a,'c089','Informar'),'mask'=>'telefone'));
$dt_ficha['90'] =  __fly(array('id'=>'c090','type'=>'text','value'=>cFi($a,'c090','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['91'] =  __fly(array('id'=>'c091','type'=>'select','value'=>cFi($a,'c091','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['92'] =  __fly(array('id'=>'c092','type'=>'select','value'=>cFi($a,'c082','Selecione'),'opts'=>'Empresário|Empregado de empresa Privada|Funcionário Público'));
$dt_ficha['93'] =  __fly(array('id'=>'c093','type'=>'text','value'=>cFi($a,'c093','Informar'),'mask'=>'cnpj'));
$dt_ficha['94'] =  __fly(array('id'=>'c094','type'=>'text','value'=>cFi($a,'c094','Informar')));
$dt_ficha['95'] =  __fly(array('id'=>'c095','type'=>'text','value'=>cFi($a,'c095','00/00/0000'),'mask'=>'data'));
$dt_ficha['96'] =  __fly(array('id'=>'c096','type'=>'text','value'=>cFi($a,'c096','00/00/0000'),'mask'=>'data'));
$dt_ficha['97'] =  __fly(array('id'=>'c097','type'=>'text','value'=>cFi($a,'c097','Informar')));
$dt_ficha['98'] =  __fly(array('id'=>'c098','type'=>'text','value'=>cFi($a,'c098','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['99'] =  __fly(array('id'=>'c099','type'=>'text','value'=>cFi($a,'c099','Informar'),'mask'=>'telefone')); 
$dt_ficha['100'] = __fly(array('id'=>'c100','type'=>'select','value'=>cFi($a,'c100','Selecione'),'opts'=>'Sim, nos envie|Não'));
$dt_ficha['101'] = __fly(array('id'=>'c101','type'=>'select','value'=>cFi($a,'c101','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['102'] = __fly(array('id'=>'c102','type'=>'select','value'=>cFi($a,'c102','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['103'] = __fly(array('id'=>'c103','type'=>'text','value'=>cFi($a,'c103','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['104'] = __fly(array('id'=>'c104','type'=>'select','value'=>cFi($a,'c104','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['105'] = __fly(array('id'=>'c105','type'=>'text','value'=>cFi($a,'c105','R$ (informar)'),'mask'=>'moeda'));
$dt_ficha['106'] = __fly(array('id'=>'c106','type'=>'select','value'=>cFi($a,'c106','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['107'] = __fly(array('id'=>'c107','type'=>'text','value'=>cFi($a,'c107','Informar')));
$dt_ficha['108'] = __fly(array('id'=>'c108','type'=>'select','value'=>cFi($a,'c108','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['109'] = __fly(array('id'=>'c109','type'=>'text','value'=>cFi($a,'c109','Informar')));
$dt_ficha['110'] = __fly(array('id'=>'c110','type'=>'text','value'=>cFi($a,'c110','Informar'),'mask'=>'telefone'));
$dt_ficha['111'] = __fly(array('id'=>'c111','type'=>'text','value'=>cFi($a,'c111','Informar')));
$dt_ficha['112'] = __fly(array('id'=>'c112','type'=>'text','value'=>cFi($a,'c112','00/00/0000'),'mask'=>'data'));
$dt_ficha['113'] = __fly(array('id'=>'c113','type'=>'text','value'=>cFi($a,'c113','00/00/0000'),'mask'=>'data'));
$dt_ficha['114'] = __fly(array('id'=>'c114','type'=>'select','value'=>cFi($a,'c114','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['115'] = __fly(array('id'=>'c115','type'=>'text','value'=>cFi($a,'c115','Informar')));
$dt_ficha['116'] = __fly(array('id'=>'c116','type'=>'text','value'=>cFi($a,'c116','Informar')));
$dt_ficha['117'] = __fly(array('id'=>'c117','type'=>'text','value'=>cFi($a,'c117','Informar')));
$dt_ficha['118'] = __fly(array('id'=>'c118','type'=>'select','value'=>cFi($a,'c118','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['119'] = __fly(array('id'=>'c119','type'=>'text','value'=>cFi($a,'c119','Informar')));
$dt_ficha['120'] = __fly(array('id'=>'c120','type'=>'select','value'=>cFi($a,'c120','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['121'] = __fly(array('id'=>'c121','type'=>'text','value'=>cFi($a,'c121','Informar')));
$dt_ficha['122'] = __fly(array('id'=>'c122','type'=>'select','value'=>cFi($a,'c122','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['123'] = __fly(array('id'=>'c123','type'=>'text','value'=>cFi($a,'c123','Informar')));
$dt_ficha['124'] = __fly(array('id'=>'c124','type'=>'select','value'=>cFi($a,'c124','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['125'] = __fly(array('id'=>'c125','type'=>'text','value'=>cFi($a,'c125','Informar')));
$dt_ficha['126'] = __fly(array('id'=>'c126','type'=>'text','value'=>cFi($a,'c126','Informar')));
$dt_ficha['127'] = __fly(array('id'=>'c127','type'=>'select','value'=>cFi($a,'c127','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['128'] = __fly(array('id'=>'c128','type'=>'text','value'=>cFi($a,'c128','Informar')));
$dt_ficha['129'] = __fly(array('id'=>'c129','type'=>'select','value'=>cFi($a,'c129','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['130'] = __fly(array('id'=>'c130','type'=>'text','value'=>cFi($a,'c130','Informar')));
$dt_ficha['131'] = __fly(array('id'=>'c131','type'=>'select','value'=>cFi($a,'c131','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['132'] = __fly(array('id'=>'c132','type'=>'text','value'=>cFi($a,'c132','Informar')));
$dt_ficha['133'] = __fly(array('id'=>'c133','type'=>'select','value'=>cFi($a,'c133','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['134'] = __fly(array('id'=>'c134','type'=>'text','value'=>cFi($a,'c134','Informar')));
$dt_ficha['135'] = __fly(array('id'=>'c135','type'=>'select','value'=>cFi($a,'c135','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['136'] = __fly(array('id'=>'c136','type'=>'text','value'=>cFi($a,'c136','Informar')));
$dt_ficha['137'] = __fly(array('id'=>'c137','type'=>'select','value'=>cFi($a,'c137','Selecione'),'opts'=>'NÃO|SIM'));
$dt_ficha['138'] = __fly(array('id'=>'c138','type'=>'text','value'=>cFi($a,'c138','informe')));
$dt_ficha['139'] = __fly(array('id'=>'c139','type'=>'text','value'=>cFi($a,'c139','informe')));
$dt_ficha['140'] = __fly(array('id'=>'c140','type'=>'text','value'=>cFi($a,'c140','informe')));
$dt_ficha['141'] = __fly(array('id'=>'c141','type'=>'text','value'=>cFi($a,'c141','informe')));
$dt_ficha['142'] = __fly(array('id'=>'c142','type'=>'text','value'=>cFi($a,'c142','informe')));
$dt_ficha['143'] = __fly(array('id'=>'c143','type'=>'text','value'=>cFi($a,'c143','informe')));
$dt_ficha['144'] = __fly(array('id'=>'c144','type'=>'text','value'=>cFi($a,'c144','informe')));
$dt_ficha['145'] = __fly(array('id'=>'c145','type'=>'text','value'=>cFi($a,'c145','informe')));
$dt_ficha['146'] = __fly(array('id'=>'c146','type'=>'text','value'=>cFi($a,'c146','informe')));
$dt_ficha['147'] = __fly(array('id'=>'c147','type'=>'text','value'=>cFi($a,'c147','informe')));
$dt_ficha['148'] = __fly(array('id'=>'c148','type'=>'text','value'=>cFi($a,'c148','informe')));
$dt_ficha['149'] = __fly(array('id'=>'c149','type'=>'text','value'=>cFi($a,'c149','informe')));
$dt_ficha['150'] = __fly(array('id'=>'c150','type'=>'text','value'=>cFi($a,'c150','informe')));
$dt_ficha['151'] = __fly(array('id'=>'c151','type'=>'text','value'=>cFi($a,'c151','informe')));

}

?>
