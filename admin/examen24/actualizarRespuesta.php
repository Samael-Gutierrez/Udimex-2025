<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/preguntas.php");

if ($_POST) {
    $id_respuesta = $_POST['id_respuesta'];
    $respuesta = $_POST['respuesta'];
    $id = intval($id_respuesta);

    actualizar_respuesta($respuesta, $id);
}
?>