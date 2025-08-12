<?php 
function abrir() { 
$base=mysqli_connect("localhost","u412323884_alf","alftom2125","u412323884_udim") or die("No está lista la conexión 2");
//$base=mysqli_connect("localhost","root","","calavera") or die("Error en la conexión de base de datos");
return $base; 
} 
?>
