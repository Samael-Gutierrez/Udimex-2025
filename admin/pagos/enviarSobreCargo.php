<?php
include("../../general/consultas/basic.php");

if($_POST){
    $hoy = date("Y-m-d");
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];

    addCargos($id, $cantidad, $hoy);

}

function addCargos($id, $cantidad, $fecha){
    $consulta = "INSERT INTO sobrecargo(id_sobrecargo,id_alumno, cantidad, fecha_pago) VALUES('',$id, $cantidad, '$fecha')";
    completa($consulta);
}