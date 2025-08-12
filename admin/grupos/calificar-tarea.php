<?php
date_default_timezone_set('America/Mexico_City');

include '../../general/consultas/basic.php';

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

function asignarCalificacion($revision, $calificacion, $comentario, $tarea, $alumno, $profe){
    $consulta = "UPDATE tarea_alumno 
                SET fecha_revision = '$revision',
                calificacion = $calificacion, 
                comentario = '$comentario',
                estado = 1,
                id_reviso = $profe
                WHERE id_tarea = $tarea
                AND id_alumno = $alumno
                ";
    completa($consulta);
}

function cambiarEstado($alumno, $tarus){
    $consulta = "UPDATE tarea_us
                SET estado = 1
                WHERE id_tarus = $tarus
                AND id_alumno = $alumno
                ";
    completa($consulta);
}