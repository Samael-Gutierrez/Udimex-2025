<?php
session_start();
include("funciones.php");
$id_repaso=$_SESSION['id_repaso'];
$base= conexion();

$preguntas=trim($_POST['pregunta']);
    
if($preguntas!=""){
    $consulta= "INSERT INTO respuestaschatgpt VALUES ('','$preguntas',$id_repaso)";

    mysqli_query($base, $consulta);
    mysqli_close($base);
}

header("location:../archivos php/muestra_preguntas.php");
?>