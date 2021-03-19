<?php 
$optF=1;
if($optF==1){?>
<script src="assets/jquery-3.5.1.min.js"></script>
<script src="assets/bootstrap.bundle.min.js"></script>
<script src="assets/alertify.min.js"></script>
<script src="assets/masks.js"></script>
<script src="assets/jquery.dragndrop.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="assets/scripts.js?rnd=<?php echo rand(0,255);?>"></script>
<?php 
}
else
{
?>
<script src="assets/jquery-3.5.1.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="assets/alertify.min.js"></script>
<script src="assets/masks.js"></script>
<script src="assets/jquery.dragndrop.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>  
  
<?php }?>
<script>
<?php 
if(sessionVar('_msg'))
{ echo 'alert("'.sessionVar('_msg').'")';
  unset($_SESSION['_msg']);}
?>

$(document).ready(function() {
    $('.dtTable').DataTable();
} );

/*
$(document).ready(function () {
$('#dttb').DataTable();
$('.dataTables_length').addClass('bs-select');
});
*/


</script>
</body>
</html>
