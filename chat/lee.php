<?php
session_start();

if(isset($_SESSION['chat'])){
	$archivo="msg/control".$_SESSION['chat'];
	$archivo=fopen($archivo,"r+");
	while(!feof($archivo)){
		echo fgets($archivo);
	}
	fclose($archivo);
}
?>
