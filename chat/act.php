<?php
session_start();

if(isset($_SESSION['chat'])){

	//Falta consultar el chat en base de dtos, luego asignar a variable de sessión

	echo $_SESSION['mensajes']."<br><br>";

	$archivo=fopen("msg/control".$_SESSION['chat'].".alf", "w+");
	$mensaje="0";
	fwrite($archivo, "$mensaje"); 
	fclose($archivo);
}
?>
