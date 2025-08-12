<?php
include('../consultas/basic.php');
include('../consultas/chat.php');

if ($_POST){
	$pro=$_POST['destino'];
	$id=$_POST['origen'];
	$ro=$_POST['res'];

	a_respuesta($pro,$ro,$id);

}

header('location:preguntas.php');

?>
