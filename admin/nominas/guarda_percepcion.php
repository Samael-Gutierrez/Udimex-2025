<?php
session_start();
include ("modelo/conexion.php");

$concepto=$_POST["concepto"];
$horas=$_POST["horas"];
$cantidad=$_POST["cantidad"];
$datos= buscar_percepcion2($concepto);
if ($fila=mysqli_fetch_assoc($datos)){
    $id_percepcion=$fila['id_percepcion'];
}
else{
    $id_percepcion=guarda_percepcion($concepto);
}
echo $id_percepcion;
$periodo=explode(" ",$_SESSION['idp']);
//condicion, para llenar sin tener forsosamente las horas
if ($horas<1){
    $horas=0;
}
guarda_percepcion_usuario($_SESSION['id_us'],$id_percepcion,$horas,$_SESSION['idp'],$cantidad);
 
//Se obtiene el numero de nomina con respecto al periodo 
/*if ($periodo[0] == 14) {
    $periodo[0] = "Segunda quincena ";
} elseif ($periodo[0] == 29) {
    $periodo[0] = "Primera quincena  ";
}

// Imprimir los resultados
//echo  ' '.$periodo[0].'de'.' '.$periodo[6];
*/
header ("location:nominas.php");
?>
