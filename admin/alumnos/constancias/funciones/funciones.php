<?php

function abrir() { 
	$base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
	//$base=mysqli_connect("localhost","root","","udim") or die("No está lista la conexión");
	return $base; 
	}

function completa($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	mysqli_close($base);
	return $r;
}

function buscar_carrera($id_carrera){
    $consulta = "SELECT nombre FROM carrera WHERE id_carrera = '$id_carrera';
    ";
    return completa($consulta);
}