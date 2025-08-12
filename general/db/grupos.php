<?php
/*Buscar alumnos ordenados por grupo
admin/grupos/index.php*/

function b_alumno($orden){
	$consulta="SELECT a.id_grupo, a.id_carrera, a.id_alumno, a.colegiatura, a.f_pago, u.nombre, u.ap_pat, u.ap_mat 
	FROM alumno as a, usuario as u 
	WHERE a.estado>0 
	and a.id_usuario=u.id_usuario 
	order by ?";	
	return ejecuta($consulta,[$orden],0);

}

/* Selecciona todos los datos de un grupo 
admin/grupos/index.php*/


//No funciona porque los grupos ya no llevan id_asesor
function grupo($id){
	$consulta="
		SELECT *
		FROM grupo 
		where id_grupo=?";
	return ejecuta($consulta,[$id],0);
}

function b_grupo2($id){
	$consulta="SELECT * FROM grupo as g, carrera as c where g.tipo=c.id_carrera and g.id_grupo=?";
	return ejecuta($consulta,[$id],0);
}



/* Selecciona todos grupos 
admin/grupos/index.php*/
function b_grupos(){
	$consulta="SELECT g.*, c.nombre FROM grupo as g, carrera as c 
	where c.id_carrera=g.tipo
	and g.estado>0 order by nombre";
	return ejecuta($consulta,[],0);
}


// da de alta un grupo
function g_grupo($dias,$tp){
	$consulta="INSERT INTO grupo VALUES ('', '?', ?, 1)";
	return ejecuta($consulta,[$dias,$tp],0);
}


function e_grupo($gr,$edo){
	$consulta="update grupo set estado=? where id_grupo=?";
	ejecuta($consulta,[$edo,$gr],0);
}

//Actualiza la carrera de un alumno
function act_gru($id, $gru){
	$consulta="update alumno set id_grupo=? where id_alumno=?";
	ejecuta($consulta,[$gru,$id],0);
}

//Actualiza la carrera de un alumno
function elimina_alumno_grupo($grupo){
	$consulta="update alumno set id_grupo=0 where id_grupo=?";
	ejecuta($consulta,[$grupo],0);
}



//Actualiza la carrera de un alumno
function act_es($id,$edo, $tabla){
	$consulta="update $tabla set estado=? where id_usuario=?";
	ejecuta($consulta,[$edo,$id],0);
}

function b_fi($id){
	$consulta="SELECT f_ingreso, colegiatura FROM alumno WHERE id_alumno=?";
	return ejecuta($consulta,[$id],0);
}

function b_algr($grupo){
	$consulta="SELECT a.id_alumno, u.nombre, u.ap_pat, u.ap_mat
	FROM alumno as a, usuario as u
	WHERE a.id_grupo=?
	and u.id_usuario=a.id_usuario
	order by u.ap_pat";
	return ejecuta($consulta,[$grupo],0);
}

function b_matgr($grupo){
	$consulta="SELECT a.id_alumno, u.nombre, u.ap_pat, u.ap_mat
	FROM alumno as a, usuario as u
	WHERE a.id_grupo=?
	and u.id_usuario=a.id_usuario
	order by u.ap_pat";
	return ejecuta($consulta,[$grupo],0);
}

function b_matgr2($us){
	$consulta="SELECT * FROM usuario as u, alumno as a, materia_grupo as m where u.id_usuario=a.id_alumno and u.id_usuario=? and a.id_grupo=m.id_grupo";
	return ejecuta($consulta,[$us],0);
}

function b_grm($id){
	$consulta="SELECT * FROM materia_grupo as mg, materia as m 
WHERE mg.id_grupo=?
and m.id_materia=mg.id_materia";
	return ejecuta($consulta,[$id],0);
}

function grupo_alumnos($id_grupo){
    $consulta="select count(id_alumno) as r from alumno where id_grupo=?";
    return ejecuta($consulta,[$id_grupo],0);

}


?>
