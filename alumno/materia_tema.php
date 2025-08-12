<?php
	session_start();
	$dir="../general/";
	include($dir."db/basica.php");
	include($dir."db/materias.php");
	
	$materia=$_SESSION['materia'];
	$al=$_SESSION["g_id"];
	$apunte=$_GET['apunte'];

	
	$datos=busca_anterior($materia,$apunte);
	
	
	

	
?>

