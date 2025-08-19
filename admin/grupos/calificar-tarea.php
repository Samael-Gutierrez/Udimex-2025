<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/seccion_tareas.php");

date_default_timezone_set('America/Mexico_City');
$tarea = $_POST['tarea'];
$tarus = $_POST['tarus'];
$calificacion = $_POST['calificacion'];
$comentario= '';
$revision = date('Y-m-d H:i:s');
$alumno = $_POST['alumno'];
$profe = $_POST['profe'];

if($_POST['comentario']){
    $comentario = $_POST['comentario'];
}

asignarCalificacion($revision, $calificacion, $comentario, $tarea, $alumno, $profe);
cambiarEstado($alumno, $tarus);