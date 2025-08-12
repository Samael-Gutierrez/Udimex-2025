<?php
/*Buscar alumnos ordenados por grupo
admin/grupos/index.php*/

function b_alumno($orden){
	$consulta="SELECT a.id_grupo, a.id_carrera, a.id_alumno, a.colegiatura, a.f_pago, u.nombre, u.ap_pat, u.ap_mat 
	FROM alumno as a, usuario as u 
	WHERE a.estado>0 
	and a.id_usuario=u.id_usuario 
	order by $orden";	
	return completa($consulta);

}

/* Selecciona todos los datos de un grupo 
admin/grupos/index.php*/


//No funciona porque los grupos ya no llevan id_asesor
function grupo($id){
	$consulta="
		SELECT *
		FROM grupo 
		where id_grupo=$id";
	return completa($consulta);
}

function b_grupo2($id){
	$consulta="SELECT * FROM grupo as g, carrera as c where g.tipo=c.id_carrera and g.id_grupo=$id";
	return completa ($consulta);
}



/* Selecciona todos grupos 
admin/grupos/index.php*/
function b_grupos(){
	$consulta="SELECT g.*, c.nombre FROM grupo as g, carrera as c 
	where c.id_carrera=g.tipo
	and g.estado>0 order by nombre";
	return completa($consulta);
}


// da de alta un grupo
function g_grupo($dias,$tp){
	$consulta="INSERT INTO grupo VALUES ('', '$dias', $tp, 1)";
	completa($consulta);	
}


function e_grupo($gr){
	$consulta="update grupo set estado=0 where id_grupo=$gr";
	completa($consulta);	
}

//Actualiza la carrera de un alumno
function act_gru($id, $gru){
	$consulta="update alumno set id_grupo=$gru where id_alumno=$id";
	completa($consulta);
}

//Actualiza la carrera de un alumno
function act_gru2($id,$gr){
	$consulta="update alumno set id_grupo=$gr where id_alumno=$id";
	completa($consulta);
}

//Actualiza la carrera de un alumno
function act_es($id,$edo, $tabla){
	$consulta="update $tabla set estado=$edo where id_usuario=$id";
	completa($consulta);
}

function b_fi($id){
	$consulta="SELECT f_ingreso, colegiatura FROM alumno WHERE id_alumno=$id";
	return completa($consulta);
}

function b_algr($grupo){
	$consulta="SELECT a.id_alumno, u.nombre, u.ap_pat, u.ap_mat
	FROM alumno as a, usuario as u
	WHERE a.id_grupo=$grupo
	and u.id_usuario=a.id_usuario
	order by u.ap_pat";
	return completa($consulta);
}

function b_matgr($grupo){
	$consulta="SELECT a.id_alumno, u.nombre, u.ap_pat, u.ap_mat
	FROM alumno as a, usuario as u
	WHERE a.id_grupo=$grupo

	and u.id_usuario=a.id_usuario
	order by u.ap_pat";
	return completa($consulta);
}

function b_matgr2($us){
	$consulta="SELECT * FROM usuario as u, alumno as a, materia_grupo as m where u.id_usuario=a.id_alumno and u.id_usuario=$us and a.id_grupo=m.id_grupo";
	return completa($consulta);
}

function b_grm($id){
	$consulta="SELECT * FROM materia_grupo as mg, materia as m 
WHERE mg.id_grupo=$id
and m.id_materia=mg.id_materia";
	return completa($consulta);
}



?>
