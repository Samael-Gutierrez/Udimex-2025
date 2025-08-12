<?php
session_start();
$dir="../";
include($dir."db/basica.php");

$red="location:".$dir."../";
$ud=0;

if (isset($_SESSION["ad_id"])){
	$us=$_SESSION["ad_id"];
	$red="location:".$dir."../admin";
}

if (isset($_SESSION["g_id"])){
	$us=$_SESSION["g_id"];
}

bitacora($us,"CIERRA SESION");
session_destroy();

header($red);
?>


