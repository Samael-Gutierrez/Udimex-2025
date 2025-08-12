<?php
$dir="../../general/";
include ($dir."db/basica.php");
include ($dir."db/tarea.php");

$type = $_POST['tipo'];

if($type == 1){
    $tarea = $_POST['tarea'];
    $id = $_POST['id'];

    $archivo = "../../alumno/tarea/$id.alf";

    file_put_contents($archivo, $tarea);
}
if($type == 2){
    $id = $_POST['id'];
    desactivarTarea($id);
}


