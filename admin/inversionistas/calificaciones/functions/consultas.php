<?php

function getStudentsFromRatings(){
    $consulta = "SELECT DISTINCT u.ap_pat, u.ap_mat, u.nombre, c.id_alumno
                FROM usuario AS u, calificacion AS c, alumno AS a
                WHERE c.id_alumno = a.id_alumno
                AND a.id_usuario = u.id_usuario
                AND c.fecha_registro > '2024-11-20'
                ORDER BY u.ap_pat, u.ap_mat
    ";
    return completa($consulta);
}

function getRatingsById($id){
    $consulta = "SELECT c.id_calificacion, c.valor, c.fecha_registro, ma.nombre_materia, a.contenido
                FROM calificacion AS c, materias AS ma, portada AS p, adicionales AS a
                WHERE c.id_alumno = $id
                AND c.fecha_registro > '2024-10-01'
                AND c.id_materia = p.id_portada
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia
                ORDER BY c.id_materia DESC, c.fecha_registro DESC
    ";
    return completa($consulta);
}