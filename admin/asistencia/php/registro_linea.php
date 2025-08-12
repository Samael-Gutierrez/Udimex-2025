<?php 
include("funciones.php");
date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d H:i:s");

    $horas=360;
    $asitencia="";
    $alumno_l = obtener_a_l(); 
    while($fila = mysqli_fetch_assoc($alumno_l)){
        $usuario_1=$fila['id_usuario'];
        $usuario_a = usuario_a($usuario_1);
        while($fila2 = mysqli_fetch_assoc($usuario_a)){
            $alumno= $fila2['id_alumno'];
        }
        $minutos=asistencia_l();
        while($fila3 = mysqli_fetch_assoc($minutos)){
            $usuario2=$fila3['usuario'];
            $minutos_t= $fila3['minutos_totales'];
        }
        if($horas==$minutos_t && $usuario_1=$usuario2){
            $asistencia=0;
            g_lista_l($alumno,$asistencia,$fecha_ac);
        }else{
            $asistencia="1";
            g_lista_l($alumno,$asistencia,$fecha_ac);
        }
    }
?>