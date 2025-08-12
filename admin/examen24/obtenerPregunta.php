<?php
include "funciones/funcionesPreguntas.php";

if (isset($_GET['id_pregunta'])) {
    $id_pregunta = $_GET['id_pregunta'];
    $consulta = "SELECT * FROM cuestionario WHERE id_pregunta = $id_pregunta";
    $resultado = completa($consulta);
    $pregunta = mysqli_fetch_assoc($resultado);

    echo json_encode($pregunta);
}
?