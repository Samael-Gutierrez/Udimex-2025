<?php
session_start();

$dir = "../../general/";
include($dir."db/basica.php"); 
include($dir."db/conta.php"); 

if ($_POST){
	$cant=$_POST['cant'];
	$desc=$_POST['desc'];
	$fecha=$_POST['fecha'];

	g_egreso($desc,$cant,$fecha,1);

} 
header("location: ../contabilidad");

?>
