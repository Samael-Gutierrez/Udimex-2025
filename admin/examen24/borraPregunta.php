<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/preguntas.php");

$pregunta = $_POST['pregunta'];
$examen = $_POST['examen'];

borrar($pregunta);
borrar2($pregunta);

header('location: verExamen.php?id_portada='.$examen);