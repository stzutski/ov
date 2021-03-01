<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>LOGIN</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
</head>
<body>
<?php 
if(isSet($erro)&&$erro!=''){echo '<h3>Dados nao conferem</h3>';}
?>
<form method="post" action="<?php echo URLAPP. 'process';?>">

User <input type="text" style="width:50px;" name="user" />
 - Senha 
<input type="text" style="width:50px;" name="pwd" />
<br />
<br />
<input type="hidden" name="do" value="login" />
<input type="submit" style="width:100px;" name="btn" value="Login" />

</form>

	
</body>
</html>
