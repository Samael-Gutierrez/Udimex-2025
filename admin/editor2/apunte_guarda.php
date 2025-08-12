<?php
$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/materias.php");
include($dir."db/basica.php");
include($dir."db/admin.php");

$sub=$_POST['sub'];
$cont=$_POST['cont'];
$tema=$_POST['tema'];
$id=$_POST['id'];

//Quita comilla simple del contenido
$cont=str_replace("'", '"', $cont);

//Quita espacios de tabulador
$cont=str_replace("	", "", $cont);

//Reemplaza http por https en videos e imágenes
$cont=str_replace("http:", "https:", $cont);

act_cont($id,$sub,$cont,$tema);

//Guarda fichero
	$nombre="../../alumno/apuntes/".$id.".alf";
	$archivo=fopen($nombre,'w');
	fwrite($archivo, $cont) or die("No se pudo escribir en el archivo");
	fclose($archivo);

?>


