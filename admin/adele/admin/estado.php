<?php
session_start();
include('../general/db/conecta.php');
include('../general/db/usuario.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
	die();
}
else{
	if($_GET['id']){
		if ($_GET['edo']==1){
			activa_cuenta($_GET['id']);
			//Activa documentos
			activa_aplicacion($_GET['id'],4,'3000/01/01');
			//Regresa a index
			header('location:../admin');
		}
		if ($_GET['edo']==2){
			elimina($_GET['id']);
		}		
	}
	else{
		header('location:../index.php');
		die();	
	}
}

?>