<?php
session_start();
include("general/consultas/basic.php");

if (isset($_SESSION["g_id"])){
	$us=$_SESSION["g_id"];
	$nom=$_SESSION["g_nom"];
	$ap=$_SESSION["g_ap"];
	$red="";
}
else{
	$us=$_SESSION["ad_id"];
	$nom=$_SESSION["ad_nom"];
	$ap=$_SESSION["ad_ap"];
	$raiz=$_GET['raiz'];
	$red="admin";
}



bitacora($us,"CIERRA SESION");
Session_destroy();

header('location: '.$red);
?>


