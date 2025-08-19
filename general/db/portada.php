<?php
function guardarEscuela($nombreEscuela, $logotipo) {
    $consulta = "INSERT INTO escuela_log (id_escuela, nombre_escuela, logotipo) VALUES (NULL, ?, ?)";
    return ejecuta($consulta, [$nombreEscuela, $logotipo], 1);
}

function verificaMateria($materia){
    $consulta = "SELECT COUNT(id_materia) AS total
                FROM materias
                WHERE nombre_materia = ?";
    return ejecuta($consulta, [$materia], 0);
}

function getIdByMateria($materia){
    $consulta = "SELECT id_materia AS id 
                FROM materias 
                WHERE nombre_materia = ?
                ORDER BY id_materia DESC
                LIMIT 1
    ";
    return ejecuta($consulta, [$materia], 0);
}

function guardarMateria($nombreMateria) {
    $consulta = "INSERT INTO materias (nombre_materia) VALUES (?)";
    return ejecuta($consulta, [$nombreMateria], 1);
}

function recuperar_id($id_escuela, $id_usuario, $id_materia, $tiempo) {
    $consulta = "INSERT INTO portada (id_escuela, id_usuario, id_materia, tiempo) VALUES (?, ?, ?, ?)";
    return ejecuta($consulta, [$id_escuela, $id_usuario, $id_materia, $tiempo], 1);
}

function datos_adicionales($id_portada, $contenido, $valor) {
    $consulta = "INSERT INTO adicionales (id_portada, contenido, valor) VALUES (?, ?, ?)";
    $resultado = ejecuta($consulta, [$id_portada, $contenido, $valor], 0); 
    return $resultado;
}

function guardarRespuesta($id_portada, $pregunta_id, $respuesta) {
    $consulta = "INSERT INTO respuestas (id_portada, id_pregunta, respuesta) VALUES (?, ?, ?)";
    ejecuta($consulta, [$id_portada, $pregunta_id, $respuesta], 0);
}

function obtenerPortada($id_portada) {
    $consulta = "SELECT id_escuela, id_usuario, id_materia FROM portada WHERE id_portada = ?";
    $resultado = ejecuta($consulta, [$id_portada], 0);
    return $resultado;

}

function obtener_datos($portada){
    $consulta= "SELECT * FROM portada as p, escuela_log as e, usuario as us, materias as m WHERE p.id_portada=? AND p.id_escuela= e.id_escuela AND p.id_usuario=us.id_usuario AND p.id_materia=m.id_materia";
    return ejecuta($consulta, [$portada], 0);
}

 function obtener_adicionales ($portada){
     $consulta= "SELECT * FROM adicionales as a WHERE a.id_portada=?";
     return ejecuta($consulta, [$portada], 0);
 }
 
?>