<?php
date_default_timezone_set("America/Mexico_City");
include("conecta.php");

/* Completa las consultas*/
function guarda($de,$para,$titulo,$video,$ext){
	$consulta="insert into calavera values('','$de','$para','$titulo','$video','$ext')";
	echo $consulta;
	return completa2($consulta);
}

function b_doc(){
	$consulta="select max(id_calavera) as r from calavera";
	return completa($consulta);
}

function b_aleatorio(){
	$consulta="SELECT * FROM calavera where id_calavera>18 ORDER BY id_calavera LIMIT 1;";
	return completa($consulta);
}

function b_prin($id){
	$consulta="SELECT * FROM calavera where id_calavera=$id";
	return completa($consulta);
}

function b_todo(){
	$consulta="SELECT * FROM calavera where id_calavera>18";
	return completa($consulta);
}


/* Completa las consultas*/
function completa($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	mysqli_close($base);
	return $r;
}

/*Completa las consultas*/
function completa2($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	$r=mysqli_insert_id($base);
	mysqli_close($base);
	return $r;
}

function b_appus($us){
	$consulta="SELECT * FROM app_acceso as p, app as ap WHERE p.id_usuario=$us and p.id_app=ap.id_app order by ap.id_app";
	return completa($consulta);
}

?>
