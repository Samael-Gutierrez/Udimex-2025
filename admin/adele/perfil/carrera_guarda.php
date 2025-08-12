<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/profesor.php');
$error=0;
if (!isset($_SESSION['id'])){
	$error=1;
}

if ($_POST){
	$id=$_SESSION['id'];
	$acr=$_POST['acronimo'];
	$carrera=$_POST['carrera'];
	$nivel=$_POST['nivel'];
	carrera_guarda($id,$acr,$carrera,$nivel);
}
else{
	$error=1;
}

if($error==1){
	header('location:../index.php');
	die();
}
else{
	header('location: index.php');
	die();	
}