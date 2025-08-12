<?php

/* Busca custionario sobre un tema */
function b_preg($id){
	$consulta="select * from cuestionario where id_pregunta=$id";
	return completa($consulta);
}

/*Crea una nueva pregunta */

function g_preg($p,$sub,$tipo){
	$consulta="INSERT INTO cuestionario VALUES ('','".$p."',$tipo,$sub)";
	return completa2($consulta);
}

/*actualiza una nueva pregunta */

function a_preg($id,$p,$sub,$tipo){
	$consulta="update cuestionario set pregunta='$p', tipo=$tipo, id_material=$sub where id_pregunta=$id";
	completa($consulta);
}

// Guarda la respuesta a una pregunta creada
function g_res($r,$t,$id){
	$consulta="INSERT INTO respuesta VALUES ('','".$r."',$t,$id)";
	completa($consulta);
}

// Elimina respuesta
function e_res($preg){
	$consulta="delete from respuesta where id_pregunta=$preg";
	completa($consulta);
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
	WHERE c.id_material =$portada";
	return completa($consulta);
}


/* Busca custionario sobre un tema */
function cues_tot($portada){
/*	$consulta="SELECT count(id_pregunta) as r
	FROM tema AS t, material AS m, cuestionario AS c
	WHERE t.id_tema =$tema
	AND t.id_tema = m.id_tema
	AND c.tipo=1
	AND m.id_material = c.id_material";*/
	$consulta="SELECT count(id_pregunta) as r FROM cuestionario AS c WHERE c.id_material =$portada;";
	return completa($consulta);
}

/* Busca las respuestas de un custionario */
function res($preg,$orden){
	$consulta="SELECT id_respuesta, respuesta, tipo
	FROM respuesta
	WHERE id_pregunta=$preg
	$orden";
	return completa($consulta);
}


/* Busca las respuestas de un custionario */
function b_alu_ev(){
	$consulta="select DISTINCT(r.id_alumno), u.nombre, u.ap_pat, u.ap_mat from respuesta_alumno as r, usuario as u where u.id_usuario=r.id_alumno order by u.ap_pat;";
	return completa($consulta);
}

function b_alu_res($al){
	$consulta="SELECT * FROM respuesta_alumno WHERE id_alumno=$al";
	return completa($consulta);
}


/* Busca las respuestas de un custionario */
function evalua($res){
	$consulta="SELECT id_material,pregunta, respuesta, r.tipo as tipo, c.tipo as tr
	FROM respuesta AS r, cuestionario AS c
	WHERE r.id_respuesta =$res
	AND r.id_pregunta = c.id_pregunta";
	return completa($consulta);
}

/* Busca las respuestas de un custionario */
function e_prega($us,$preg,$mat){
	$consulta="delete from respuesta_alumno where id_alumno=$us and id_pregunta=$preg and id_materia=$mat";
	completa($consulta);
}

function g_prega($us,$preg,$res,$mat){
	$consulta="insert into respuesta_alumno values('',$us,$preg,$res,$mat)";
	completa($consulta);
}

function compruebaRespuestas($portada, $al){
	$consulta = "SELECT COUNT(id_alumno) AS totales FROM respuesta_alumno WHERE id_alumno = $al AND id_materia=$portada;";
	return completa($consulta);
}

?>

