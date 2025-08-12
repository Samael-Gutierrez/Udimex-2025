<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/conta.php");

if ($_POST){
	$cant=$_POST['cant'];
	$desc=$_POST['desc'];
	$fecha=$_POST['fecha'];

	//Corregir comisiones de promotor
	g_egreso($desc,$cant,$fecha,1);



	
} 
header("location: ../contabilidad");

?>
