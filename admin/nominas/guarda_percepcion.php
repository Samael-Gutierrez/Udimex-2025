<?php
session_start();
include ("../../general/db/nominas.php");
include ("../../general/db/basica.php");

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

header ("location:nominas.php");
?>
