<?php
include "../general/consultas/basic.php";

function getGroupById($id){
	$consulta = "SELECT id_grupo FROM alumno WHERE id_alumno=$id";
	return completa($consulta);
}

function busca_usuario($id){
	$consulta="SELECT a.id_alumno, nombre, ap_pat, ap_mat
		FROM usuario AS u, alumno AS a
		WHERE a.id_alumno = $id
		AND a.id_usuario = u.id_usuario";
	return completa($consulta);
}

function counter($id){
	$consulta = "SELECT COUNT(id_alumno) FROM tarea_us WHERE id_alumno = $id";
	completa($consulta);
}

function getHomeWorks($id){
	$consulta = "SELECT tema.titulo, material.subtitulo, us.id_tarus, us.id_alumno, us.archivo, us.estado, us.id_tarea
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = $id
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = tema.id_tema
				";
	return completa($consulta);
}

function changeStatus($id){
	$consulta = "UPDATE tarea_us SET estado=1 WHERE id_tarus=$id";
	echo "<script>alert('Tarea revisada');</script>";
	return completa($consulta);
}

function getMateriaById($id){
	$consulta = "SELECT DISTINCT tema.titulo, tema.id_tema
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = $id
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = tema.id_tema
				";
	return completa($consulta);
}

function getTemaById($id, $material){
	$consulta = "SELECT DISTINCT material.subtitulo, material.id_material
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = $id
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = material.id_material
				AND material.id_tema = $material
				";
	return completa($consulta);
}

function counterHomeWorks($id){
	$consulta = "SELECT COUNT(id_alumno) AS tareas FROM tarea_us WHERE id_alumno = $id";
	return completa($consulta);
}

function getTareaById($id,$material){
	$consulta = "SELECT DISTINCT us.id_tarea, us.archivo, us.descripcion, us.estado
				FROM tarea_us AS us, tarea_apunte AS ap, material, tema
				WHERE us.id_alumno = $id
				AND us.id_tarea = ap.id_tarea
				AND ap.id_apunte = $material
				";
	return completa($consulta);
}

function obtenMateriasActivas($grupo){
	$consulta = "SELECT materia.id_materia, materia.nombre 
				FROM materia, materia_grupo AS mg 
				WHERE mg.id_grupo = $grupo
				AND mg.id_materia = materia.id_materia";
	return completa($consulta);
}

function obtenTotalMaterias($grupo){
	$consulta = "SELECT COUNT(id_materia) as materias FROM materia_grupo WHERE id_grupo = $grupo";
	return completa($consulta);
}

function getHomeWorksByMateria($id, $alumno){
	$consulta = "SELECT tu.id_tarea AS tarea, tu.archivo, tu.descripcion, tu.estado, te.titulo, ma.subtitulo, tu.visto
				FROM tarea_us AS tu, tarea_apunte AS ta, material AS ma, tema AS te
				WHERE tu.id_alumno = $alumno
				AND tu.id_tarea = ta.id_tarea
				AND ta.id_apunte = ma.id_material
				AND ma.id_tema = te.id_tema
				AND te.id_materia = $id
				ORDER BY ma.id_material ASC, tu.archivo ASC";
	return completa($consulta);
}

function obtenerFechaLimite ($tarea, $alumno){
	$consulta = "SELECT fecha_solicitud AS fecha_limite FROM tarea_alumno WHERE id_tarea = $tarea AND id_alumno = $alumno";
	return completa($consulta);
}

function fechaEntrega ($tarea, $alumno){
	$consulta = "SELECT fecha_entrega, calificacion FROM tarea_alumno WHERE id_tarea = $tarea AND id_alumno = $alumno";
	return completa($consulta);
}

function getDetails($tarea, $alumno){
	$consulta = "SELECT calificacion, comentario FROM tarea_alumno WHERE id_alumno = $alumno AND id_tarea = $tarea ORDER BY id_talumno DESC LIMIT 1";
	return completa($consulta);
}

function getRatingsById($id){
    $consulta = "SELECT c.valor, c.fecha_registro, ma.nombre_materia, a.contenido
                FROM calificacion AS c, materias AS ma, portada AS p, adicionales AS a
                WHERE c.id_alumno = $id
                AND c.fecha_registro > '2024-10-01'
                AND c.id_materia = p.id_portada
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia
                ORDER BY c.fecha_registro DESC
    ";
    return completa($consulta);
}

function totalExamenes($id){
	$consulta = "SELECT COUNT(id_calificacion) AS cal FROM calificacion WHERE id_alumno = $id";
	return completa($consulta);
}

function compruebaRespuestas($portada, $al){
	$consulta = "SELECT COUNT(id_alumno) AS totales FROM respuesta_alumno WHERE id_alumno = $al AND id_materia=$portada;";
	return completa($consulta);
}