<?php
include '../../general/consultas/basic.php';

$tarea = $_POST['tarea'];
$id = $_POST['id'];
$calificacion = $_POST['calificacion'];
$comentario = $_POST['comentario'];
$revision = date("Y-m-d");

actualizarDetalles($tarea, $id, $calificacion, $comentario, $revision);

function actualizarDetalles($tarea, $id, $calificacion, $comentario, $revision){
    $consulta = "UPDATE tarea_alumno 
                SET calificacion = $calificacion,
                comentario = '$comentario',
                fecha_revision = '$revision' 
                WHERE id_tarea = $tarea 
                AND id_alumno = $id";
    completa($consulta);
}