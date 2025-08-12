<?php
session_start();

$dir = "../../general/";
include($dir."db/basica.php"); 
include($dir."db/conta.php"); 
 
if ($_POST){
	$cant1=$_POST['cant1'];
	$fecha1=$_POST['fecha'];
	$descu=$_POST['descu'];
   
	
	g_ingreso1($cant1,$fecha1,$descu);
}

header("location: ../contabilidad");

?>
