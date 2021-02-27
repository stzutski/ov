<?php 
$tipo='';
$msg='';

if(isSet($_GET['tipo'])){$tipo=$_GET['tipo'];}
if(isSet($_GET['msg'])){$msg=$_GET['msg'];}

if($tipo=='alert' && $tipo!=''){
  
  echo 'alert("Alerta: '.$msg.'");';
  
}

if($tipo=='alert2' && $tipo!=''){
  
  echo 'alert("Alerta2: '.$msg.'");';
  
}

?>
