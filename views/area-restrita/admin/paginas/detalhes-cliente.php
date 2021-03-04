detalhes do cliente

<?php 

if(count($_dataUserCli)>0){
  
$cli = $_dataUserCli[0];


foreach ($cli as $key => $value) {
  echo "{$key} => {$value}<br />\n";
}

}else{

echo '<br />nada encontrado!';  
  
}
?>
