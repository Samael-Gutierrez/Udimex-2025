<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/materias.php");

if ($_POST){
	$mat=$_POST['id'];
	$car=$_POST['car'];
	$nom=$_POST['nom'];
	$dur=$_POST['dur'];
	$tip=$_POST['tip'];
	$sem=$_POST['sem'];
	$ba=$_POST['ba'];
	if ($mat==0){
		g_mat($car,$nom,$dur,$tip,$sem,$ba);
	}
	else{
		a_mat($mat,$car,$nom,$dur,$tip,$sem,$ba);
	}
	echo "<script type='text/javascript'> top.window.location='plan.php?car=$car'; </script>";
}
?>
