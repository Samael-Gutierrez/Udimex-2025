<?php
include("../consultas/generales.php");
include("../consultas/expediente.php");
	

$dic=$_POST['dictamen'];
$exp=$_POST['exp'];

if (strlen(trim($dic))>0){
	g_dic($dic,$exp);
}

header("location: ../expediente/?c=3#bot");

?>
