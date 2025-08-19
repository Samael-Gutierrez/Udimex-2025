<?php
$dir = "../../general/";
include($dir."db/preguntas.php");

if (isset($_GET['id_pregunta'])) {
    $id_pregunta = $_GET['id_pregunta'];
    obtenerPregunta($id_pregunta);
    $pregunta = mysqli_fetch_assoc($resultado);
    echo json_encode($pregunta);
}