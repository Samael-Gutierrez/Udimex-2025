<?php

	function b_tarea($id){
		$consulta="SELECT *
		FROM tarea_apunte
		WHERE id_apunte=?";
		return ejecuta($consulta,[$id],0);
	}

	function busca_tarea_alumno($id, $alumno){
		$consulta="SELECT * FROM tarea_alumno where id_tarea=? and id_alumno=?";
		return ejecuta($consulta,[$id,$alumno],0);	
	}

	function guarda_tarea_alumno($fichero,$al,$entrega,$edo,$profe){
		$consulta="INSERT INTO tarea_alumno VALUES (NULL,?,?,?,NULL,NULL,NULL,NULL,?,?);";
		ejecuta($consulta,[$fichero,$al,$entrega,$edo,$profe],0);
	}

	function guarda_tarea($id,$dias){
		$consulta="INSERT INTO tarea_apunte VALUES ('',?,?,0);";
		return ejecuta($consulta,[$id,$dias],1);
	}
	
	// Cuenta cuantas tareas ya tiene registradas
	function cuenta_tarea($tarea, $alumno) {
		$consulta = "SELECT COUNT(id_alumno) AS r FROM tarea_us WHERE id_alumno=? AND id_tarea=?";
		return ejecuta($consulta,[$alumno,$tarea],0);
	}
	
	function consultaSQL($id_alumno, $id_tarea, $tarea_name, $descripcion){
	    $consulta = "INSERT INTO tarea_us(id_alumno, id_tarea, archivo, descripcion, estado) VALUES(?,?,?,?, 0)";
	    ejecuta($consulta,[$id_alumno,$id_tarea,$tarea_name,$descripcion],0);
	}

	function actualizarTarea($id_tarea, $id_alumno){
	    $entrega = date("Y-m-d");
	    $consulta = "UPDATE tarea_alumno SET fecha_entrega=? WHERE id_tarea=? AND id_alumno=?";
	    ejecuta($consulta,[$entrega,$id_tarea,$id_alumno],0);
	}

?>
