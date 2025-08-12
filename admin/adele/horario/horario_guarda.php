<?php
	include('../general/db/conecta.php');
	include('../general/db/horario.php');
	
	$dias=['','Lunes','Martes','Miércoles','Jueves','Viernes'];
	$id=$_POST["id"];
	$celda=str_split($_POST["celda"]);
	
	$hora=$celda[0]+6;
	$dia=$dias[$celda[1]];
	
	guarda_horario($id,$dia,$hora,$_POST["celda"]);
?>