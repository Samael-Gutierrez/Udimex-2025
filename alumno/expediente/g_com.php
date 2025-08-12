<?php
include("../consultas/generales.php");
include("../consultas/expediente.php");
	

$com=$_POST['com'];
$exp=$_POST['exp'];
$us=$_POST['us'];

if (strlen(trim($com))>0){
	g_com($com,$exp,$us);
}

header("location: ../expediente/?c=1#bot");

?>
