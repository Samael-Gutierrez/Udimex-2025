<?php
session_start();
include('conexion.php');
$id=$_SESSION['ad_id'];
$mensaje= $_POST["mensaje"];
$id_mensaje= envia_mensaje($id , $mensaje, $destinatario);
//$insertados=busca_empleado($id);

if (isset($_POST['destinatario'])) {
    foreach ($_POST['destinatario'] as $destinatario) {
        destinatarios($id_mensaje,$destinatario);
        //envia_mensaje($id, $mensaje, $destinatario); 
    }
}
header( 'Location: ../' )
?>



