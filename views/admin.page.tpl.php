<?php include('views/headersAndFooters/admin-header.php');?>


<div class="navbar">
<?php include('views/menus/admin-menu-lateral.php');?>
</div>


<div class="pagebody">
<?php 
  if(isSet($incBody)){
    if(file_exists($incBody)){
      include ($incBody);
    }else{
      echo "<center><h5>Page body não LOCALIZADO<br />$incBody</h5></center>";
    }
  }else{
    echo "<center><h2>Page body não definido</h2></center>";
  } 
?>
</div>


<?php include('views/headersAndFooters/admin-footer.php');?>
