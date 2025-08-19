<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/examenes.php");

if($_POST){
    $id = $_POST['id'];
    changeStatus($id);
    header("Location: Examenes.php");   
}