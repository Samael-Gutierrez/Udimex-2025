<?php

/* Busca custionario sobre un tema */
function b_preg($id){
	$consulta="SELECT * FROM cuestionario WHERE id_pregunta=?;";
	return ejecuta($consulta, [$id], 0);
}

/*Crea una nueva pregunta */
function g_preg($p,$sub,$tipo){
	$consulta="INSERT INTO cuestionario VALUES (NULL, ?, ?, ?)";
	return ejecuta($consulta, [$p, $tipo, $sub], 1);
}

/*actualiza una nueva pregunta */
function a_preg($id,$p,$sub,$tipo){
	$consulta="UPDATE cuestionario SET pregunta = ?, tipo = ?, id_material = ? WHERE id_pregunta = ?;";
	ejecuta($consulta, [$p, $tipo, $sub, $id], 0);
}

// Guarda la respuesta a una pregunta creada
function g_res($r,$t,$id){
	$consulta="INSERT INTO respuesta VALUES (NULL,?,?,?)";
	ejecuta($consulta, [$r, $t, $id], 0);
}

// Elimina respuesta
function e_res($preg){
	$consulta="DELETE FROM respuesta WHERE id_pregunta = ?";
	ejecuta($consulta, [$preg], 0);
}

/* Busca custionario sobre un tema */
function cues($portada,$orden){
	/*$consulta="SELECT id_pregunta,pregunta
	FROM tema AS t, material AS m, cuestionario AS c
	WHERE t.id_tema =$tema
	AND t.id_tema = m.id_tema
	AND c.tipo=1
	AND m.id_material = c.id_material 
	$orden";*/
	
	$consulta="SELECT id_pregunta,pregunta
				FROM cuestionario AS c
				WHERE c.id_material = ?";

	return ejecuta($consulta, [$portada], 0);
}

/* Busca custionario sobre un tema */
function cues_tot($portada){
/*	$consulta="SELECT count(id_pregunta) as r
	FROM tema AS t, material AS m, cuestionario AS c
	WHERE t.id_tema =$tema
	AND t.id_tema = m.id_tema
	AND c.tipo=1
	AND m.id_material = c.id_material";*/

	$consulta = "SELECT COUNT(id_pregunta) AS r FROM cuestionario AS c WHERE c.id_material = ?;";
	return ejecuta($consulta, [$portada], 0);
}

/* Busca las respuestas de un custionario */
function res($preg,$orden){
	$consulta="SELECT id_respuesta, respuesta, tipo
			FROM respuesta
			WHERE id_pregunta = $preg $orden;";
	return completa($consulta, 0);
}

/* Busca las respuestas de un custionario */
function b_alu_ev(){
	$consulta="SELECT DISTINCT(r.id_alumno), u.nombre, u.ap_pat, u.ap_mat FROM respuesta_alumno AS r, usuario AS u WHERE u.id_usuario=r.id_alumno ORDER BY u.ap_pat;";
	return ejecuta($consulta, [], 0);
}

function b_alu_res($al){
	$consulta="SELECT * FROM respuesta_alumno WHERE id_alumno = ?;";
	return ejecuta($consulta, [$al], 0);
}


/* Busca las respuestas de un custionario */
function evalua($res){
	$consulta="SELECT id_material,pregunta, respuesta, r.tipo as tipo, c.tipo as tr
				FROM respuesta AS r, cuestionario AS c
				WHERE r.id_respuesta = ?
				AND r.id_pregunta = c.id_pregunta";
	return ejecuta($consulta, [$res], 0);
}

/* Busca las respuestas de un custionario */
function e_prega($us,$preg,$mat){
	$consulta="DELETE FROM respuesta_alumno WHERE id_alumno = ? AND id_pregunta= ? AND id_materia=?;";
	ejecuta($consulta, [$us, $preg, $mat], 0);
}

function g_prega($us,$preg,$res,$mat){
	$consulta="INSERT INTO respuesta_alumno VALUES(NULL, ?, ?, ?, ?);";
	ejecuta($consulta, [$us, $preg, $res, $mat], 0);
}

function compruebaRespuestas($portada, $al){
	$consulta = "SELECT COUNT(id_alumno) AS totales FROM respuesta_alumno WHERE id_alumno = ? AND id_materia = ?;";
	return ejecuta($consulta, [$al, $portada], 0);
}

?>