<?php
session_start();
include("funciones.php");

$base=conexion();
$consulta="UPDATE preguntas_repaso SET estado = 1 WHERE id_repaso = $contar";
mysqli_query($base,$consulta);

header("location:/archivos php/muestra_preguntas.php");

?>