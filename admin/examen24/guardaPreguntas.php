<?php
session_start();

$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/preguntas.php");

if ($_POST) {

    $escribir = $_POST['escri_p'];
    $tipo = $_POST['tipo'];

    $op1 = $_POST['option1'];
    $op2 = $_POST['option2'];
    $op3 = $_POST['option3'];
    $op4 = $_POST['option4'];
    $op = isset ($_POST['op']) ? $_POST['op'] : '';
    $preguntas = $_POST['pregunta'];
    $opciones = $_POST['opcion'];
    $id_portada= $_SESSION["id_portada"] ;

    if (strlen($escribir) > 0) {
        $id = guardar_pregunta($escribir, $tipo, $id_portada);
        echo "ID de la pregunta guardada: $id <br>";

        if ($tipo == 1) {
            if (strlen($op1) > 0) guarda_respuesta($op1, 1, $id);
            if (strlen($op2) > 0) guarda_respuesta($op2, 0, $id);
            if (strlen($op3) > 0) guarda_respuesta($op3, 0, $id);
            if (strlen($op4) > 0) guarda_respuesta($op4, 0, $id);
        }

        if ($tipo == 3) {
            if (strlen($op) > 0) {
                if ($op == "True") {
                    guarda_respuesta("Verdadero", 1, $id);
                    guarda_respuesta("Falso", 0, $id);
                } else {
                    guarda_respuesta("Falso", 1, $id);
                    guarda_respuesta("Verdadero", 0, $id);
                }
            }
        }

        if ($tipo == 4) {
            $preguntas = $_POST['pregunta'];
            $opciones = $_POST['opcion'];

            $i=0;
            while($preguntas  [$i]){
                g_respuestas($preguntas[$i], $opciones[$i], $id);
                $i++; 
 
            }
        }
    }
}
?>
