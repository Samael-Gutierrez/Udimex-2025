<?php
include("basica.php");

function guardar_pregunta($escribir, $tipo, $id_portada) {
    $consulta = "INSERT INTO cuestionario (id_pregunta, pregunta, tipo, id_material) VALUES (NULL, ?, ?, ?);";
    return ejecuta($consulta, [$escribir, $tipo, $id_portada], 1);
}

function guarda_respuesta($opcion, $tipo, $id) {
    $consulta = "INSERT INTO respuesta (id_respuesta, respuesta, tipo, id_pregunta) VALUES (NULL, ?, ?, ?);";
    ejecuta($consulta, [$opcion, $tipo, $id], 0);
}

function verdad($op, $tipo, $id) {
    $consulta = "INSERT INTO respuesta (id_respuesta, respuesta, tipo, id_pregunta) VALUES (NULL, ?, ?, ?);";
    ejecuta($consulta, [$op, $tipo, $id], 0);
}

function g_respuestas($preguntas, $opciones, $idPregunta) {
    $consulta = "INSERT INTO columnas_r (id_pregunta, numero, inciso) VALUES (?, ?, ?)";
    ejecuta($consulta, [$idPregunta, $preguntas, $opciones], 0);

}

function actualizar_pregunta($id_pregunta, $pregunta) {
    $consulta= "UPDATE cuestionario SET pregunta = ? WHERE id_pregunta = ?";
    ejecuta($consulta, [$pregunta, $id_pregunta], 0);
}

function actualizar_respuesta($respuesta, $id){
    $consulta = "UPDATE respuesta SET respuesta = ? WHERE id_respuesta = ?;";
    ejecuta($consulta, [$respuesta, $id], 0);
}

function borrar($pregunta){
    $consulta = "DELETE FROM cuestionario WHERE id_pregunta=?";
    ejecuta($consulta, [$pregunta], 0);
}

function borrar2($pregunta){
    $consulta = "DELETE FROM respuesta WHERE id_pregunta=?";
    ejecuta($consulta, [$pregunta], 0);
}

function obtenerPregunta($id_pregunta){
    $consulta = "SELECT * FROM cuestionario WHERE id_pregunta = ?";
    $resultado = ejecuta($consulta, [$id_pregunta], 0);
    return $resultado;
}