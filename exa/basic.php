<?php

include("conecta.php");

/*Registra en la bitácora*/

function bitacora($us,$ac){
	$horas=(date("d")*24)+(date("H"))-5;
	$dia=floor($horas/24);
	$hora=$horas%24;
	$fecha=date("Y-m")."-".$dia." ".$hora.":".date("i:s");
	$consulta="insert into bitacora values('',$us,'$ac','$fecha')";
	completa($consulta);
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
