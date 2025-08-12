<?php
include "../../general/consultas/basic.php";

function obtenEstudiantes(){
    $consulta = "SELECT DISTINCT r.id_alumno, u.nombre, u.ap_pat, u.ap_mat
                FROM respuesta_alumno AS r, alumno AS a, usuario AS u 
                WHERE r.id_materia = 4114 
                AND r.id_alumno = a.id_alumno 
                AND NOT (a.estado = 6)
                AND a.id_usuario = u.id_usuario
                ORDER BY u.ap_pat ASC
                ;";
    return completa($consulta);
}

function obtenAciertos($id){
    $consulta = "SELECT respuesta_alumno.id_alumno, COUNT(respuesta_alumno.id_respuesta) AS aciertos
                FROM respuesta_alumno, respuesta 
                WHERE respuesta_alumno.id_materia = 4114 
                AND respuesta_alumno.id_alumno=$id 
                AND respuesta_alumno.id_respuesta = respuesta.id_respuesta 
                AND respuesta.tipo = 1;";
    return completa($consulta);
}

function borrarCalificacion($id){
    $consulta = "DELETE FROM calificacion WHERE id_alumno = $id";
    completa($consulta);
}

function subirCalificacion($id, $valor, $materia, $dia){
    $consulta = "INSERT INTO calificacion VALUES('', $valor, '$dia', $materia, $id)";
    completa($consulta);
}

function actualizarEstado($id){
    $consulta = "UPDATE alumno SET estado = 6 WHERE id_alumno = $id";
    completa($consulta);
}

function esperaExamen($fechaIn, $fechaFi){
    $consulta = "SELECT a.id_alumno, u.nombre, u.ap_pat, u.ap_mat, f.fecha, a.id_grupo
                FROM alumno AS a, usuario AS u, fecha_examen AS f
                WHERE a.id_usuario = u.id_usuario
                AND a.estado = 1
                AND a.id_alumno = f.id_alumno
                AND f.fecha BETWEEN '$fechaIn' AND '$fechaFi'
                ORDER BY f.fecha ASC
    ";
    return completa($consulta);
}

function activarExamen($id){
    $consulta = "UPDATE alumno SET id_grupo = 1 WHERE id_alumno = $id;";
    $consulta2 = "UPDATE grupo SET estado = 1 WHERE id_grupo = 1;";
    completa($consulta);
    completa($consulta2);
}

function activarExamen2($id){
    $consulta = "INSERT INTO materia_grupo  VALUES('', 1144, $id, 1);";
    completa($consulta);
}

function examenGrupo($grupo){
    $consulta = "SELECT COUNT(id_mg) AS totales FROM materia_grupo WHERE id_grupo = $grupo AND id_materia = 1144;";
    return completa($consulta);
}