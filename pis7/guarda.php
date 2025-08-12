<?php
session_start();

$datos=$_POST['dato'];



$ar="ar/".$_SESSION['gu'].".alf";

$archivo=fopen($ar,"w+");
fputs($archivo,$datos);
fclose($archivo);

$_SESSION['gu']=$_SESSION['gu']+1;

$ar="ar/".$_SESSION['gu'].".alf";
$archivo=fopen($ar,"w+");
fputs($archivo,"");
fclose($archivo);

if ($_SESSION['gu']>10){
	$_SESSION['gu']=1;
	$ar="ar/".$_SESSION['gu'].".alf";
	$archivo=fopen($ar,"w+");
	fputs($archivo,"");
	fclose($archivo);
}

?>
