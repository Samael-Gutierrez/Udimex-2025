<?php
session_start();

if ($_SESSION['le']>10){
	$_SESSION['le']=1;
}

$ar="ar/".$_SESSION['le'].".alf";


if (filesize($ar)==0){
	$_SESSION['le']=$_SESSION['le']+9;
	if ($_SESSION['le']>10){
		$_SESSION['le']=$_SESSION['le']-10;
	}
}

$ar="ar/".$_SESSION['le'].".alf";

$archivo=fopen($ar,"r+");
while(!feof($archivo)){
	echo fgets($archivo);
}

fclose($archivo);

$_SESSION['le']=$_SESSION['le']+1;

?>
