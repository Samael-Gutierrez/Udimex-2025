<?php 
function abrir() { 
$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión nueva");
//$base=mysqli_connect("localhost","root","","udim") or die("No está lista la conexión");
return $base; 
} 
?>
