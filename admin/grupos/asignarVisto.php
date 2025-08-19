<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/seccion_tareas.php");

if($_POST){
    $id = $_POST['miDato'];
    asignarVisto($id);
}