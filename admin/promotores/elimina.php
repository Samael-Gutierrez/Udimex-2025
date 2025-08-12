<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/promotor.php");

if ($_GET){
	$id=$_GET["id"];
	a_liga2($id);
	
}

header("location: liga.php");

?>
