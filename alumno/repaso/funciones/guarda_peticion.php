<?php
session_start();
include("funciones.php");

if(isset($_SESSION['g_id'])){

    $base=conexion();
    
    $fecha=date('Y-m-d');
    $tema=$_SESSION['tema'];
    $g_id=$_SESSION['g_id'];
    
    $consulta="INSERT INTO repaso (fecha, materia, id_alumno)
                VALUES ('$fecha', '$tema', '$g_id')";
                
    mysqli_query($base, $consulta);
    $id_repaso=mysqli_insert_id($base);
    
    $_SESSION['id_repaso']= $id_repaso;
    

    $ids=ids($g_id,$tema);
    while($datos= $ids->fetch_object()){
        //Crear condición, si el id de pregunta y id_repaso ya existen, no hacer insert
        
        $consulta="INSERT INTO preguntas_repaso (id_pregunta, pregunta, id_repaso)
        VALUES ('$datos->id_pregunta','$datos->pregunta', $id_repaso)";
        mysqli_query($base, $consulta);
    }
    
}

header("location:../archivos%20php/animacion_carga.php");


?>