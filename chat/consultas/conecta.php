<?php 
function abrir() { 
$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión nueva");
//$base=mysqli_connect("localhost","u412323884_chat","Alftom2125","u412323884_chat") or die("No está lista la conexión 2");
//$base=mysqli_connect("localhost","root","","udim") or die("No está lista la conexión");
return $base; 
} 
?>
