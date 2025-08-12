<?php 
function abrir() { 
// $base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
$base=mysqli_connect("localhost","root","","udimex") or die("No está lista la conexión");
return $base; 
} 
?>
