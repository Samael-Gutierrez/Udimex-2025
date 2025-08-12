<?php

function abrir() { 
//$base=mysqli_connect("localhost","u412323884_chat","Alftom2125","u412323884_chat") or die("No está lista la conexión 2");
$base=mysqli_connect("localhost","root","","udim") or die("No está lista la conexión");
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
