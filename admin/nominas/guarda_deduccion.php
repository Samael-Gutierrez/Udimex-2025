<?php
session_start();
include ("modelo/conexion.php");

$concepto=$_POST["concepto"];
$cantidad=$_POST["cantidad"];
$registro= buscar_deduccion2($concepto);
if ($fila=mysqli_fetch_assoc($registro)){
    $id_deduccion=$fila['id_deduccion'];
}
else{
    $id_deduccion= guarda_deduccion($concepto);
}
echo $id_deduccion;
$periodo=explode(" ",$_SESSION['idp']);

 guarda_deduccion_usuario($_SESSION['id_us'],$id_deduccion,$_SESSION['idp'],$cantidad);

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
