<?php include('views/headersAndFooters/master-header.php');?>



<div class="navbar">

<?php include('views/menus/master-menu-lateral.php');?>

</div>


<div class="pagebody">



<?php 
  if(isSet($incBody)){
    if(file_exists($incBody)){
      include ($incBody);
    }else{
      echo '<center><h2>Page body não LOCALIZADO</h2></center>';
    }
  }else{
    echo '<center><h2>Page body não definido</h2></center>';
  } 
?>


</div>





<?php include('views/headersAndFooters/master-footer.php');?>
