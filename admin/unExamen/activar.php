<?php
$dir = "../../general/";
include($dir."db/unExamen.php");
include($dir."db/basica.php");

if($_POST['type'] == 1){
    $id = $_POST['id'];
    activarExamen($id);
    
    header("location:index.php");
}

if($_POST['type'] == 2){
    $id = $_POST['grupo'];
    activarExamen2($id);
    
    header("location:index.php");
}

if($_POST['type'] == 3){
    $hoy = Date("Y-m-d");
    $alumno = $_POST['alumno'];

    $mate = $_POST['matematicas'];
    $com = $_POST['comprension'];
    $len = $_POST['lengua'];
    $ana = $_POST['analitico'];

    borrarCalificacion($alumno);
    subirCalificacion($alumno, $mate, 355, $hoy);
    subirCalificacion($alumno, $com, 356, $hoy);
    subirCalificacion($alumno, $len, 357, $hoy);
    subirCalificacion($alumno, $ana, 358, $hoy);
    actualizarEstado($alumno);

    header("location:index.php");
}