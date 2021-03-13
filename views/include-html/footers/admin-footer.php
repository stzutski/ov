<script src="assets/jquery-3.5.1.min.js"></script>
<script src="assets/bootstrap.bundle.min.js"></script>
<script src="assets/alertify.min.js"></script>
<script src="assets/masks.js"></script>
<script src="assets/jquery.dragndrop.js"></script>
<script src="assets/scripts.js?rnd=<?php echo rand(0,255);?>"></script>
<script>
<?php 
if(sessionVar('_msg'))
{
  echo 'alert("'.sessionVar('_msg').'")';
  unset($_SESSION['_msg']);
}
?>
</script>
</body>
</html>
