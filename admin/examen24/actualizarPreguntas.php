<?php
$dir = "../../general/";
include($dir."db/preguntas.php");

if ($_POST) {
    $id_pregunta = $_POST['id_pregunta'];
    $pregunta = $_POST['pregunta'];
    $id_pregunta = intval($id_pregunta);
    
    actualizar_pregunta($id_pregunta, $pregunta );
}
?>