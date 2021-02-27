<?php 

if($_POST['do']=='teste1'){
    
    $v1     = $_POST['valor1'];
    $v2     = $_POST['valor2'];
    $result = $v1 . $v2;
    $app->redirect('http://localhost/labs/ov/resultado/'.$result);
    
}

if($_POST['do']=='teste2'){
    $app->redirect('http://localhost/labs/ov/resultado/teste2');
}




if($_POST['do']=='teste3'){
    $app->redirect('http://localhost/labs/ov/resultado/teste3');
}


?>
