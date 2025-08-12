<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/usuario.php");

if ($_POST){
	$us=$_SESSION["ad_id"];
	$correo=trim($_POST['correo']);
	$tel=trim($_POST['tel']);
	
	if(strlen($correo)>0){
		a_correo($us,$correo);
	}

	if(strlen($tel)>0){
		//Elimina teléfono de usuario
		e_tel($us);

		//Guarda teléfono de usuario
		g_tel($tel,$us);
	}
}

header("location: liga.php");

?>
