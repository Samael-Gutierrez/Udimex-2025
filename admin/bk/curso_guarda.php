<?php
include("../consultas.php");

$sub=$_POST['sub'];
$cont=$_POST['cont'];
$tema=$_POST['tema'];
$id=$_POST['id'];
act_cont($id,$sub,$cont,$tema);

?>


