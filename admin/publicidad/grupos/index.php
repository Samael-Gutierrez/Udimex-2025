<?php

include ("../db/basicas.php");
include ("../db/grupos.php");









if($_POST){
	$url=trim($_POST['url']);
	$op=$_POST['op'];

	if(strlen($url)>0){
	    $dato=b_grupo($url);
	    $fila=mysqli_fetch_assoc($dato);
		if ($fila['r']==0){
			guarda_grupo($url,$op);
			echo "Grupo agregado correctamente";
		}
		else{
			echo "El grupo ya existe";
		}		

	}
}




?>

<!DOCTYPE html>
<html>
	<head>
		<title>Guarda grupos</title>
	</head>
	<body>
		<form method="POST">
			<input type="text" placeholder="Escribe aquí la URL del grupo de facebook"
			name="url"><br>
			<input type="radio" name="op" value="0"> Local<br>
			<input type="radio" name="op" value="1"> Foráneo<br>
			<input type="radio" name="op" value="2" checked> Especial<br>
			<input type="submit" value="Guardar">
		</form>
	</body>
</html>
