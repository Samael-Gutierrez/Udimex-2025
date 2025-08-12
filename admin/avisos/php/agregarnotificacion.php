<?php
session_start();
include('conexion.php');
$id=$_SESSION['ad_id'];
$mensaje= $_POST["mensaje"];
$inserta= envia_mensaje($id , $mensaje, $destinatario);
$insertados=busca_empleado($id);

if (isset($_POST['destinatarios'])) {
    foreach ($_POST['destinatarios'] as $destinatario) {
       
        envia_mensaje($id, $mensaje, $destinatario); 
    }
}
header( 'Location: ../' )
?>



