<?php include('views/include-html/headers/admin-header2.php');?>

  <?php //include('views/include-html/menus/admin-menu-lateral2.php');?>

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

<?php include('views/include-html/footers/admin-footer2.php');?>
