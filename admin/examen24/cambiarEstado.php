<?php
include "funciones/funciones_examenes.php";

if($_POST){
    $id = $_POST['id'];
    changeStatus($id);
    header("Location: Examenes.php");   
}