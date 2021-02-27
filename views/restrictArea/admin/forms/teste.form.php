<form method="post" action="process">

<input type="text" style="width:50px;" name="valor1" />
+
<input type="text" style="width:50px;" name="valor2" />
<br />
<br />
<input type="hidden" name="do" value="teste1" />
<input type="button" style="width:100px;" id="tajax" value="Teste" />
<input type="submit" style="width:100px;" name="btn" value="Enviar <?php if(isSet($_GET['teste'])){echo '-'.$_GET['teste'].' '.$_GET['opt'];}?>" />

</form>
