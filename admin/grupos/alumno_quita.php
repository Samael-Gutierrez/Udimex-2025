<?php
$dir="../../general/";
include($dir."db/basica.php");
include($dir."db/grupos.php");

if ($_GET){
	act_gru($_GET['id'],0);
} 

$red="location:materia_ver.php?id=".$_GET['gr'];
header($red);
?>

