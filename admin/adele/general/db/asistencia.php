<?php
function guarda_asistencia($mp,$alumno,$fecha,$edo){
	$consulta = "insert into asistencia values('',?,?,?,?)";
    ejecuta($consulta, [$mp,$alumno,$fecha,$edo],0);
}

function elimina_asistencia($mp,$alumno,$fecha,$edo){
	$consulta = "delete from asistencia where mp_lista=? and id_alumno=? and fecha=? and estado=?";
    ejecuta($consulta, [$mp,$alumno,$fecha,$edo],0);
}

function busca_pasistencia($mp,$id,$fecha){
	$consulta="SELECT * 
	FROM asistencia 
	WHERE mp_lista=? 
	and id_alumno=? 
	and fecha=?";
	return ejecuta($consulta, [$mp,$id,$fecha],0);
}

function busca_lista($mp){
	$consulta="SELECT * 
	FROM asistencia as s, alumno as a, usuarios as u
	WHERE s.mp_lista=? 
	and s.estado=0
	and s.id_alumno=a.id_alumno
	and s.id_alumno=u.id_usuario
	order by u.ap, u.am, u.nombre";
	return ejecuta($consulta, [$mp],0);
}


function busca_fechas($mp){
	$consulta="SELECT distinct(fecha) FROM `asistencia` WHERE mp_lista=? and fecha>'0000-00-00';";
	return ejecuta($consulta, [$mp],0);

}
function busca_asistencia($alumno,$fecha,$mp){
	$consulta="SELECT * from asistencia where id_alumno=? and fecha=? and mp_lista=?";
	return ejecuta($consulta, [$alumno,$fecha,$mp],0);
}


?>