<?php

function busca_usuario($id){
	$consulta="SELECT a.id_alumno, nombre, ap_pat, ap_mat
		FROM usuario AS u, alumno AS a
		WHERE a.id_alumno = ?
		AND a.id_usuario = u.id_usuario";
	return ejecuta($consulta,[$id],0);
}

function counter($id){
	$consulta = "SELECT COUNT(id_alumno) FROM tarea_us WHERE id_alumno = ?";
	return ejecuta($consulta,[$id],0);
}

function getHomeWorks($id){
	$consulta = "SELECT tema.titulo, material.subtitulo, us.id_tarus, us.id_alumno, us.archivo, us.estado, us.id_tarea
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = ?
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = tema.id_tema
				";
	return ejecuta($consulta,[$id],0);
}

function changeStatus($id){
	$consulta = "UPDATE tarea_us SET estado=1 WHERE id_tarus=?";
	echo "<script>alert('Tarea revisada');</script>";
	return ejecuta($consulta,[$id],0);
}

function getMateriaById($id){
	$consulta = "SELECT DISTINCT tema.titulo, tema.id_tema
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = ?
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = tema.id_tema
				";
	return ejecuta($consulta,[$id],0);
}

function getTemaById($id, $material){
	$consulta = "SELECT DISTINCT material.subtitulo, material.id_material
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = ?
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = ?
				";
	return ejecuta($consulta,[$id, $material],0);
}

function counterHomeWorks($id){
	$consulta = "SELECT COUNT(id_alumno) AS tareas FROM tarea_us WHERE id_alumno = ?";
	return ejecuta($consulta,[$id],0);
}

function getTareaById($id,$material){
	$consulta = "SELECT DISTINCT us.id_tarea, us.archivo, us.descripcion, us.estado
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = ?
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = ?
				";
	return ejecuta($consulta,[$id,$material],0);
}

function obtenMateriasActivas($grupo){
	$consulta = "SELECT materia.id_materia, materia.nombre 
				FROM materia, materia_grupo AS mg 
				WHERE mg.id_grupo = ?
				AND mg.id_materia = materia.id_materia;";
	return ejecuta($consulta,[$grupo],0);
}

function obtenTotalMaterias($grupo){
	$consulta = "SELECT COUNT(id_materia) as materias FROM materia_grupo WHERE id_grupo = ?;";
	return ejecuta($consulta,[$grupo],0);
}

function getHomeWorksByMateria($id, $alumno){
	$consulta = "SELECT tu.id_tarea AS tarea, tu.id_tarus AS id, tu.archivo, tu.descripcion, tu.estado, te.titulo, ma.subtitulo, tu.visto
				FROM tarea_us AS tu, tarea_apunte AS ta, material AS ma, tema AS te
				WHERE tu.id_alumno = ?
				AND tu.id_tarea = ta.id_tarea
				AND ta.id_apunte = ma.id_material
				AND ma.id_tema = te.id_tema
				AND te.id_materia = ?
				ORDER BY ma.id_material ASC, tu.archivo ASC";
	return ejecuta($consulta,[$alumno, $id],0);
}

function obtenerFechaLimite ($tarea, $alumno){
	$consulta = "SELECT fecha_solicitud AS fecha_limite FROM tarea_alumno WHERE id_tarea = ? AND id_alumno = ? ;";
	return ejecuta($consulta,[$tarea, $alumno],0);
}

function fechaEntrega ($tarea, $alumno){
	$consulta = "SELECT fecha_entrega, calificacion FROM tarea_alumno WHERE id_tarea = ? AND id_alumno = ?";
	return ejecuta($consulta,[$tarea, $alumno ],0);
}

function getDetails($tarea, $alumno){
	$consulta = "SELECT calificacion, comentario FROM tarea_alumno WHERE id_alumno = ? AND id_tarea = ? ORDER BY id_talumno DESC LIMIT 1";
	return ejecuta($consulta,[$alumno, $tarea],0);
}

function getRatingsById($id){
    $consulta = "SELECT c.valor, c.fecha_registro, ma.nombre_materia, a.contenido, c.id_materia
                FROM calificacion AS c, materias AS ma, portada AS p, adicionales AS a
                WHERE c.id_alumno = ?
                AND c.fecha_registro > '2024-10-01'
                AND c.id_materia = p.id_portada
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia
                ORDER BY c.fecha_registro DESC;
    ";
    return ejecuta($consulta,[$id],0);
}

function totalFocus($al, $mat){
	$consulta = "SELECT COUNT(id_materia) AS totales FROM focus WHERE id_alumno = ?  AND id_materia = ? ;";
	return ejecuta($consulta,[$al, $mat],0);
}

function totalExamenes($id){
	$consulta = "SELECT COUNT(id_calificacion) AS cal FROM calificacion WHERE id_alumno = ? ;";
	return ejecuta($consulta,[$id],0);
}