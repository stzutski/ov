<?php 
use \db\Sql;
use \db\ProcSql;
use admin\servicos\Servicos;



if(postVar('table')=='faseServ'){//FASES DO SERVICO
  
  
  $id_srv = postVar('ids');
  $orderm = postVar('order'); //recebe str com a ordem dos IDs ex(3,1,2,6,4,5) 
  $re_ord = explode(',',$orderm);//gera array com os indices
  
  if(is_array($re_ord) && count($re_ord)>0){
    $zOrder=1;//ponteiro da primeira posicao
    foreach ($re_ord as $key) {//listamos cada registro na NOVA ordem
      $idReg    = $key;//anota o ID vindo do JS
      if(strstr($idReg,postVar('table'))){//caso a str possua o nome da tabela então extrai o ID
      $idFsSrv  = (int)str_replace( postVar('table').'_', '' ,$idReg); //extrai somente o ID
        if(is_int($idFsSrv)){//se o valor for inteiro (parece ser um ID VALIDO)
          //processa a atualizacao da ordem da fase
          if($idFsSrv!=''&&$id_srv!=''&&$zOrder!=''){
            $res  = Servicos::updFaseServico($idFsSrv,$id_srv,$zOrder);
            $zOrder++;//incrementa zOrder
          }
        }
      }
    }
  }
  
}
if(postVar('table')=='etapasServ'){//ETAPAS DA FASE

  
  
  $id_fse = postVar('ids');//ID DA FASE VINCULADA
  $orderm = postVar('order'); //recebe str com a ordem dos IDs ex(3,1,2,6,4,5) 
  $re_ord = explode(',',$orderm);//gera array com os indices
  
  if(is_array($re_ord) && count($re_ord)>0){
    $zOrder=1;//ponteiro da primeira posicao
    foreach ($re_ord as $key) {//listamos cada registro na NOVA ordem
      $idReg    = $key;//anota o ID vindo do JS
      if(strstr($idReg,postVar('table'))){//caso a str possua o nome da tabela então extrai o ID
      $idFsSrv  = (int)str_replace( postVar('table').'_', '' ,$idReg); //extrai somente o ID
        if(is_int($idFsSrv)){//se o valor for inteiro (parece ser um ID VALIDO)
          //processa a atualizacao da ordem da fase
          if($idFsSrv!=''&&$id_fse!=''&&$zOrder!=''){
            $res  = Servicos::updEtapaServico($idFsSrv,$id_fse,$zOrder);
            $zOrder++;//incrementa zOrder
          }
        }
      }
    }
  }


}
echo 'location.reload();';


?>
