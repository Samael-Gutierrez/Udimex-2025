<?php

include "../../../../general/consultas/basic.php";

function searchGroups($id_carrera){
    $consulta = "SELECT gr.id_grupo, gr.dias
                FROM grupo AS gr, carrera AS ca 
                WHERE ca.id_carrera = $id_carrera
                AND gr.tipo = ca.id_carrera
                AND gr.estado = 1
    ";

    return completa($consulta);
}

function addGroup($dias, $carrera){
    $consulta = "INSERT INTO grupo(dias, tipo, estado) VALUES ('$dias', $carrera, 1);";
    return completa($consulta);
}