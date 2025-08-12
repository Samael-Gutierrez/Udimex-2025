<?php
session_start();
include('consultas/basic.php');
include('consultas/chat.php');

if($_POST){
	$id_respuesta=$_POST['id_respuesta'];
	$datos=bot_funcion($id_respuesta);
	if($fila=mysqli_fetch_assoc($datos)){
		if($fila['tipo']==1){
			fb_carrera($fila['variable'],$fila['id_respuesta']);
		}
	}
}

function fb_carrera($var,$r){
	$_SESSION[$var]=$r;
}




?>
