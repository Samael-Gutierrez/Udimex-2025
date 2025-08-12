<?php
include "../../general/consultas/basic.php";

$pregunta = $_POST['pregunta'];
$examen = $_POST['examen'];

borrar($pregunta);
borrar2($pregunta);

header('location: verExamen.php?id_portada='.$examen);


function borrar($pregunta){
    $consulta = "DELETE FROM cuestionario WHERE id_pregunta=$pregunta";
    completa($consulta);
}

function borrar2($pregunta){
    $consulta = "DELETE FROM respuesta WHERE id_pregunta=$pregunta";
    completa($consulta);
}