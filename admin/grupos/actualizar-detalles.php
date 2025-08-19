<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/seccion_tareas.php");

date_default_timezone_set('America/Mexico_City');
$tarea = $_POST['tarea'];
$id_alumno = $_POST['id_alumno'];
$calificacion = $_POST['calificacion'];
$comentario = $_POST['comentario'];
$revision = date("Y-m-d H:i:s");

actualizarDetalles($tarea, $id_alumno, $calificacion, $comentario, $revision);