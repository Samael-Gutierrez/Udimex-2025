<?php
session_start();
include ("../../general/db/nominas.php");
include ("../../general/db/basica.php");

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

header ("location:nominas.php");
?>
