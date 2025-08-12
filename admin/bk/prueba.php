<?php
include("../consultas.php");
	$id=3;
	$res=b_contenido($id);
	echo $res;
	$fila=mysql_fetch_array($res);
	echo $fila;
	echo $fila['subtitulo'];

?>
