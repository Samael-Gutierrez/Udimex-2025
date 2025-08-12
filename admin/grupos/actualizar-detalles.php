<?php
date_default_timezone_set('America/Mexico_City');
include("../../general/db/basica.php");

$tarea = $_POST['tarea'];
$id_alumno = $_POST['id_alumno'];
$calificacion = $_POST['calificacion'];
$comentario = $_POST['comentario'];
$revision = date("Y-m-d H:i:s");

actualizarDetalles($tarea, $id_alumno, $calificacion, $comentario, $revision);

function actualizarDetalles($tarea, $id, $calificacion, $comentario, $revision){
    $consulta = "UPDATE tarea_alumno 
                SET calificacion = ?,
                comentario = ?,
                fecha_revision = ?
                WHERE id_tarea = ? 
                AND id_alumno = ? ;";
    ejecuta($consulta, [$calificacion, $comentario, $revision, $tarea, $id], 0);
}