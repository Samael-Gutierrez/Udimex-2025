<?php
include('../../../general/consultas/admin.php');
include("../../../general/consultas/basic.php");
if(!empty($_GET["id"])){
    $id=$_GET["id"];
    borrar($id); 
}
header("location:../index.php");
// borrar publicacion
?>