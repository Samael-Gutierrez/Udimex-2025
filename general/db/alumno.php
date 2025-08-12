<?php
function b_usuario($nom,$ap,$am,$esc){
	$consulta="
		SELECT a.id_alumno, nombre, ap_pat, ap_mat, correo,u.clave, u.id_usuario, u.usuario
		FROM usuario AS u, alumno AS a
		WHERE nombre LIKE '%$nom%'
		and ap_pat LIKE '%$ap%'
		and ap_mat LIKE '%$am%'
		AND a.id_usuario = u.id_usuario";
	return completa($consulta,0);
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

	return completa($consulta,0);
}

//busca a un alumno según su estado académico
function b_us_edo2($esc,$edo){
	$consulta="
		SELECT count(a.id_alumno)as r
		FROM alumno AS a
		WHERE a.estado=$edo";
	echo "falta considerar escuela";
	return completa($consulta,0);
}



function b_alumnog($orden){
	$consulta="SELECT a.id_grupo, a.id_carrera, a.id_alumno, a.colegiatura, u.nombre, u.ap_pat, u.ap_mat, p.f_pago
	FROM alumno as a, usuario as u, pago_fechas as p
	WHERE a.estado>0 
	and a.id_usuario=u.id_usuario 
	and (a.id_grupo>0 or++ p.f_pago>'2019-01-01' or p.id_usuario=a.id_usuario)
	order by $orden;";
	return completa($consulta,0);
}

function b_exp_doc($id){
	$consulta="select * from doc_exp where id_exp=$id and estado>0";
	return completa($consulta,0);
}

function b_doc($nombre){
	$consulta="select count(id_de) as r from doc_exp where doc like '$nombre'";
	return completa($consulta,0);
}

function g_doc($exp,$nombre,$ext,$desc){
	$fa=date('Y-m-d');
	$consulta="INSERT INTO doc_exp VALUES ('', $exp, '$nombre', '$ext', '$desc', '$fa', '1','0');";
	completa($consulta,0);
}


function b_ales(){
	$consulta="select * from alumno_estado order by descripcion;";
	return completa($consulta,0);
}

function b_ales2($id){
	$consulta="select estado from alumno where id_alumno='$id';";
	return completa($consulta,0);
}


function guarda_alumno($id,$ins,$cm,$cer,$edo,$fdi,$fdp,$mo,$carrera,$promotor,$grupo){
	$consulta="insert into alumno values($id,$ins,$cm,$cer,$edo,'$fdi','$fdp',$mo,$id,$grupo,$carrera,$promotor,2)";
	completa($consulta,0);
	guarda_expediente_seguimineto($id);
	
}

function guarda_curp($id,$curp){
	$consulta="insert into curp values($id,'$curp')";
	completa($consulta,0);	
}

function guarda_examen($id,$linea,$dia){
	$consulta="insert into fecha_examen values('',$id,$linea,'$dia',0)";
	completa($consulta,0);
}

/*Busca alumno por estado académico*/
function b_alumnos($es){
		$consulta="select * from alumno as a, usuario as u where a.id_usuario=u.id_usuario and estado=$es";
		return completa($consulta,0);
}

/*Busca a un expediente*/
function b_exp($id){
	$consulta="SELECT * 
	FROM alumno as a, documentos as d 
	where a.id_alumno=d.id_alumnos 
	and e.id_alumno=$id";
	return completa($consulta,0);
}

/*Busca a un expediente*/
function b_documentos($id){
	$consulta="SELECT * from documentos where id_alumno=$id";
	return completa($consulta,0);
}


function guarda_alumno_tutor($id,$idt){
	$consulta="insert into alumno_tutor values($id,$idt);";
	 completa($consulta,0);
}

function busca_alumno_tutor($id){
	$consulta="SELECT * FROM alumno_tutor as t, usuario as u WHERE t.id_alumno=$id and t.id_tutor=u.id_usuario";
	return completa($consulta,0);
}


function guarda_documentos($id,$nombre,$tipo){
	$consulta="insert into documentos values($id,'$nombre',$tipo)";
	completa($consulta,0);
}
function b_carrera_al($id){
	$consulta="select * from alumno where id_alumno=$id";
	return completa($consulta,0);
}

function guarda_expediente_seguimineto($id){
	$fecha=date('Y-m-d');
	$consulta="insert into expediente_revision value('',$id,'$fecha')";
	completa($consulta,0);
}

?>
