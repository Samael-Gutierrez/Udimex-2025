<?php

function abrir() { 
$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
//$base=mysqli_connect("localhost","root","","ia") or die("No está lista la conexión");
return $base; 
}


/* Completa las consultas*/
function completa($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	mysqli_close($base);
	return $r;
}

/* Completa las consultas*/
function completa2($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	$r=mysqli_insert_id($base);
	mysqli_close($base);
	return $r;
}


?>
