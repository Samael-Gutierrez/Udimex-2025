<?php
include('../../general/consultas/basic.php');
include('../../general/consultas/materias.php');

$datos=max_apunte();

if($fila=mysqli_fetch_assoc($datos)){
	$max=$fila['m'];
}

if($max==NULL){
	$max=0;
}

$datos=busca_material($max);
if($fila=mysqli_fetch_assoc($datos)){
	$contenido=$fila['contenido'];
	$id=$fila['id_material'];
	$sub=$fila['subtitulo'];
	$tema=$fila['id_tema'];
	
	$nombre=$id.".alf";

	if ($contenido==NULL){
		$contenido=" ";
	}
	$archivo=fopen($nombre,'w');
	fwrite($archivo, $contenido) or die("No se pudo escribir en el archivo");
	fclose($archivo);
	
	guarda_apunte($id,$sub,$tema);
	
	header('location:fin.html');
}

?>

//<>