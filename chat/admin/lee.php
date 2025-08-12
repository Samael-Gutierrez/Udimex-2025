<?php

$chat=$_POST['chat'];

$ar="../msg/chat".$chat;
$ar=fopen($ar,"r+");
while(!feof($ar)){
	$linea=fgets($ar);
	$linea=str_replace("img","img hidden",$linea);
	$linea=str_replace("button","button hidden",$linea);
	echo $linea;
}
fclose($ar);

?>
