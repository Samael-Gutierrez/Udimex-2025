<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/conta.php");

 

if ($_POST){
	$cant1=$_POST['cant1'];
	$fecha1=$_POST['fecha'];
	$descu=$_POST['descu'];
   
	
	g_ingreso1($cant1,$fecha1,$descu);
}

header("location: ../contabilidad");

?>
