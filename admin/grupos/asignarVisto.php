<?php
include "funciones.php";
include "../../general/consultas/basic.php";

if($_POST){
    $id = $_POST['miDato'];
    asignarVisto($id);
}

function asignarVisto($id){
	$consulta = "UPDATE tarea_us SET visto = 1 WHERE id_tarus=$id";
	completa($consulta);
}