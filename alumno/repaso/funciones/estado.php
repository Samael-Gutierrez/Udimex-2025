<?php
session_start();
include("funciones.php");

$id_pregunta=$_POST['id']; 
$id_repaso=$_SESSION['id_repaso'];

$base=conexion();
$consulta="UPDATE preguntas_repaso SET estado = 1 WHERE id_repaso = $id_repaso AND id_pregunta = $id_pregunta";
mysqli_query($base, $consulta);
header("location:../archivos%20php/muestra_preguntas.php");
?>