<?php
	$dir="../../general/";
	include($dir."db/tarea.php");
	include($dir."db/basica.php"); 
	
	if(strlen($_POST['line'])>0){
		$apunte=$_POST['ap'];
		$ins=$_POST['line'];
		$dias=$_POST['dias'];
		
		$id=guarda_tarea($apunte,$dias);
		
		$archivo=fopen("../../alumno/tarea/".$id.".alf",'w');
		fwrite($archivo,$ins);
		fclose($archivo);
	}
	
?>



