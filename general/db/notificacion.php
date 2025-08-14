<?php

function cuenta_mensajes($id){
	$consulta="SELECT COUNT(id_destinatario) AS r FROM destinatario WHERE id_usuario = ? AND estados = 0";
	return ejecuta($consulta, [$id], 0);
}

function busca_mensajes($id){
	$consulta="SELECT * FROM destinatario as d, datos as m, usuario as u
				WHERE d.id_datos = m.id 
				AND d.id_usuario = ?
				AND d.estados = 0
				AND m.autor = u.id_usuario";
	return ejecuta($consulta, [$id], 0);
}

function busca_admin($id){
	$consulta="SELECT COUNT(id_acceso) AS r FROM acceso WHERE id_usuario = ?";
	return ejecuta($consulta, [$id], 0);
}

function cambio_de_estado($id){
	$consulta="UPDATE destinatario SET estados = 1 WHERE id_destinatario = ?";
	return ejecuta($consulta, [$id], 0);
}
function envia_mensaje($id , $mensaje, $destinatario){
	$consulta="INSERT INTO datos (autor,mensaje) VALUES(?, ?);";
	return ejecuta($consulta, [$id, $mensaje], 1);
}

function destinatarios($id , $mensaje){
	$consulta="INSERT INTO destinatario (id_datos,id_usuario) VALUES( ?, ?);";
	return ejecuta ($consulta, [$id, $mensaje], 0);
}

function busca_empleado($id){
	$consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario = u.id_usuario";
	return ejecuta($consulta, [], 0);
}

function guarda_notificacion($mensaje){
	$consulta="INSERT INTO datos (autor,mensaje) VALUES(?, ?);";
	return ejecuta($consulta, [483, $mensaje], 1);
}

function guarda_destinatario($id_mensaje,$id){
	$consulta="INSERT INTO destinatario (id_datos,id_usuario) VALUES(?, ?);";
	ejecuta($consulta, [$id_mensaje, $id], 0);
}

function saveQualification($calificacion, $tema, $id_alumno){
	$date = Date("Y-m-d");
	$consulta = "INSERT INTO calificacion (valor, fecha_registro, id_materia, id_alumno) VALUES (?, ?, ?, ?);";
	ejecuta($consulta, [$calificacion, $date, $tema, $id_alumno], 0);
}

function getTeacherByCover($id){
	$consulta = "SELECT id_usuario FROM portada WHERE id_portada = ?";
	return ejecuta($consulta, [$id], 0);
}

function getInfoByCover($id){
	$consulta = "SELECT ma.nombre_materia AS materia, a.contenido AS tema
                FROM materias AS ma, portada AS p, adicionales AS a
                WHERE p.id_portada = ?
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia";
	return ejecuta($consulta, [$id], 0);
}

function countMessage($mensaje){
	$consulta = "SELECT COUNT(id) AS mensajes FROM datos WHERE mensaje = ?;";
	return ejecuta($consulta, [$mensaje], 0);
}

function getIdByMessage($mensaje){
	$consulta = "SELECT id FROM datos WHERE mensaje = ? ORDER BY id DESC LIMIT 1";
	return ejecuta($consulta, [$mensaje], 0);
}

function getDestinatarios($id,$mensaje,$value){
	$consulta = "SELECT COUNT(id_usuario) AS total
				FROM destinatario 
				WHERE id_datos = ?
				AND id_usuario = ?
				AND estados = ?";
	return ejecuta($consulta, [$mensaje, $id, $value], 0);
}

function busca_destinatario($id){
	$consulta="SELECT count(id_destinatario) as r FROM destinatario WHERE id_usuario = ? AND estados = 0";
	return ejecuta($consulta,[$id],0);
}

function changeStatus($id,$mensaje){
	$consulta = "UPDATE destinatario SET estados = 0 WHERE id_usuario = ? AND id_datos = ? AND estados = ?";
	ejecuta($consulta, [$id, $mensaje, 1], 0);
}