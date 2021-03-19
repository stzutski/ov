<?php include('views/include-html/headers/admin-header.php');?>
<div class="container-fluid">

  <div class="row">

      <div class="col-md-2 mainNav-admin">

        <?php include('views/include-html/menus/admin-menu-lateral.php');?>      
      
      </div>

      <div class="col-md-10">

        <div>
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

      </div>

  </div>

</div>

<?php include('views/include-html/footers/admin-footer.php');?>
