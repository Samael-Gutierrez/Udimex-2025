<?php
	session_start();
	$dir="../general/";
	include($dir."db/basica.php");
	include($dir."db/cuestionario.php");
	
	$preg=$_GET['preg'];
	$res=$_GET['res'];
	$mat=$_GET['mat'];
	$us=$_SESSION["g_id"];

	e_prega($us,$preg,$mat);
	g_prega($us,$preg,$res,$mat);
	

?>
