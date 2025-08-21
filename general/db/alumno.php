<?php
function b_usuario($nom,$ap,$am,$esc){
	$consulta="
		SELECT a.id_alumno, nombre, ap_pat, ap_mat, correo,u.clave, u.id_usuario, u.usuario
		FROM usuario AS u, alumno AS a
		WHERE nombre LIKE '%$nom%'
		and ap_pat LIKE '%$ap%'
		and ap_mat LIKE '%$am%'
		AND a.id_usuario = u.id_usuario";
	return ejecuta($consulta, [], 0);
}


//busca a un alumno según su estado académico
function b_us_edo($nom,$ap,$am,$esc,$edo){
	$consulta="
		SELECT a.id_alumno, nombre, ap_pat, ap_mat, correo,u.clave, u.id_usuario, u.usuario
		FROM usuario AS u, alumno AS a
		WHERE nombre LIKE '%$nom%'
		and ap_pat LIKE '%$ap%'
		and ap_mat LIKE '%$am%'
		AND a.id_usuario = u.id_usuario
		and a.estado=$edo";

	return ejecuta($consulta, [], 0);
}

//busca a un alumno según su estado académico
function b_us_edo2($esc,$edo){
	$consulta="SELECT count(a.id_alumno)as r
		FROM alumno AS a
		WHERE a.estado=?";
	return ejecuta($consulta, [$edo], 0);
}



function b_alumnog($orden){
	$consulta="SELECT a.id_grupo, a.id_carrera, a.id_alumno, a.colegiatura, u.nombre, u.ap_pat, u.ap_mat, p.f_pago
	FROM alumno as a, usuario as u, pago_fechas as p
	WHERE a.estado>0 
	and a.id_usuario=u.id_usuario 
	and (a.id_grupo>0 or++ p.f_pago>'2019-01-01' or p.id_usuario=a.id_usuario)
	order by $orden;";
	return ejecuta($consulta, [], 0);
}

function b_exp_doc($id){
	$consulta="SELECT * from doc_exp where id_exp=? and estado>0";
	return ejecuta($consulta, [$id], 0);
}

function b_doc($nombre){
	$consulta="SELECT count(id_de) as r from doc_exp where doc like ?";
	return ejecuta($consulta, [$nombre], 0);
}

function g_doc($exp,$nombre,$ext,$desc){
	$fa=date('Y-m-d');
	$consulta="INSERT INTO doc_exp VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);";
	ejecuta($consulta, [$exp, $nombre, $ext, $desc, $fa, 1, 0], 0);
}


function b_ales(){
	$consulta="SELECT * from alumno_estado order by descripcion;";
	return ejecuta($consulta, [], 0);
}

function b_ales2($id){
	$consulta="SELECT estado from alumno where id_alumno=?;";
	return ejecuta($consulta, [$id], 0);
}


function guarda_alumno($id,$ins,$cm,$cer,$edo,$fdi,$fdp,$mo,$carrera,$promotor,$grupo){
	$consulta="INSERT into alumno values(?,?,?,?,?,?,?,?,?,?,?,?,2)";
	ejecuta($consulta, [$id, $ins, $cm, $cer, $edo, $fdi, $fdp, $mo, $id, $grupo, $carrera, $promotor], 0);
	guarda_expediente_seguimineto($id);
	
}

function guarda_curp($id,$curp){
	$consulta="INSERT into curp values(?, ?)";
	ejecuta($consulta, [$id, $curp], 0);	
}

function guarda_examen($id,$linea,$dia){
	$consulta="INSERT into fecha_examen values(NULL, ?,?,?,0)";
	ejecuta($consulta, [$id, $linea, $dia], 0);
}

/*Busca alumno por estado académico*/
function b_alumnos($es){
		$consulta="SELECT * from alumno as a, usuario as u where a.id_usuario=u.id_usuario and estado=?";
		return ejecuta($consulta, [$es], 0);
}

/*Busca a un expediente*/
function b_exp($id){
	$consulta="SELECT * 
	FROM alumno as a, documentos as d 
	where a.id_alumno=d.id_alumnos 
	and e.id_alumno=?";
	return ejecuta($consulta, [$id], 0);
}

/*Busca a un expediente*/
function b_documentos($id){
	$consulta="SELECT * from documentos where id_alumno=?";
	return ejecuta($consulta, [$id], 0);
}


function guarda_alumno_tutor($id,$idt){
	$consulta="insert into alumno_tutor values(?,?);";
	 ejecuta($consulta, [$id, $idt], 0);
}

function busca_alumno_tutor($id){
	$consulta="SELECT * FROM alumno_tutor as t, usuario as u WHERE t.id_alumno=? and t.id_tutor=u.id_usuario";
	return ejecuta($consulta, [$id], 0);
}

function guarda_documentos($id,$nombre,$tipo){
	$consulta="insert into documentos values(?,?,?)";
	ejecuta($consulta, [$id, $nombre, $tipo], 0);
}
function b_carrera_al($id){
	$consulta="select * from alumno where id_alumno=?";
	return ejecuta($consulta, [$id], 0);
}

function guarda_expediente_seguimineto($id){
	$fecha=date('Y-m-d');
	$consulta="insert into expediente_revision value(NULL,?,?)";
	ejecuta($consulta, [$id, $fecha], 0);
}

?>
