<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>ADMIN...</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<base href="http://localhost/labs/ov/">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <?php 
  $optH=1;
  
  if($optH==1){
  ?>
  <link rel="stylesheet" href="assets/bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="assets/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/alertify.css">
  <link rel="stylesheet" type="text/css" href="assets/alertify.default.css">
  <link rel="stylesheet" type="text/css" href="assets/flyedit.css?v=<?php echo rand(0,255);?>">
  <link rel="stylesheet" type="text/css" href="assets/estilos.css?v=<?php echo rand(0,255);?>">
  
  <?php }else{?>
    
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="assets/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/alertify.css">
  <link rel="stylesheet" type="text/css" href="assets/alertify.default.css">
  <link rel="stylesheet" type="text/css" href="assets/estilos.css?<?php echo rand(0,255);?>">    
    
  <?php }?>
</head>
<body>
