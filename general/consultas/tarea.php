<?php

function b_tarea($id){
	$consulta="SELECT *
	FROM tarea_apunte
	WHERE id_apunte=$id
	AND estado = 0";
	return completa($consulta);
}

function busca_tarea_alumno($id, $alumno){
	$consulta="SELECT * FROM tarea_alumno where id_tarea=$id and id_alumno=$alumno";
	return completa($consulta);	
}

function guarda_tarea_alumno($fichero,$al,$entrega,$edo,$profe){
	$consulta="INSERT INTO tarea_alumno VALUES ('',$fichero,$al,'$entrega','null','null','null','null',$edo,$profe);";
	completa($consulta);	
}

function guarda_tarea($id,$dias){
	$consulta="INSERT INTO tarea_apunte VALUES ('',$id,$dias,0);";
	return completa2($consulta);	
}

// Cuenta cuantas tareas ya tiene registradas
function countHomeWork($tarea, $alumno) {
	$consulta = "SELECT COUNT(id_alumno) FROM tarea_us WHERE id_alumno=$alumno AND id_tarea=$tarea";
	return completa($consulta);
}

?>