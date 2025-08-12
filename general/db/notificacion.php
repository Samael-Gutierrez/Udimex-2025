<?php

//La tabla 'destinatario' va a desaparecer, se cambia por 'notificacion_destinatario', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function guarda_destinatario($id_mensaje,$id){
	$consulta="INSERT INTO destinatario (id_datos,id_usuario) VALUES($id_mensaje,$id)";
	ejecuta($consulta,[],0);
}

//consulta mal clasificada, debe estar en cuestionario
function saveQualification($calificacion, $tema, $id_alumno){
	$date = Date("Y-m-d");
	$consulta = "INSERT INTO calificacion (valor, fecha_registro, id_materia, id_alumno) VALUES (?, ?, ?, ?);";
	ejecuta($consulta, [$calificacion, $date, $tema, $id_alumno], 0);
}

//consulta mal clasificada, debe estar en cuestionario
function getTeacherByCover($id){
	$consulta = "SELECT id_usuario FROM portada WHERE id_portada = $id";
	return ejecuta($consulta,[],0);
}

//consulta mal clasificada, debe estar en cuestionario
function getInfoByCover($id){
	$consulta = "SELECT ma.nombre_materia AS materia, a.contenido AS tema
                FROM materias AS ma, portada AS p, adicionales AS a
                WHERE p.id_portada = $id
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia
	";

	return ejecuta($consulta,[],0);
}

//La tabla 'datos' va a desaparecer, se cambia por 'notificacion', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function countMessage($mensaje){
	$consulta = "SELECT COUNT(id) AS mensajes FROM datos WHERE mensaje = ?;";
	return ejecuta($consulta, [$mensaje], 0);
}

//La tabla 'datos' va a desaparecer, se cambia por 'notificacion', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function getIdByMessage($mensaje){
	$consulta = "SELECT id FROM datos WHERE mensaje = ? ORDER BY id DESC LIMIT 1";
	return ejecuta($consulta, [$mensaje], 0);
}

//La tabla 'datos' va a desaparecer, se cambia por 'notificacion', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function getDestinatarios($id,$mensaje,$value){
	$consulta = "SELECT COUNT(id_usuario) AS total
				FROM destinatario 
				WHERE id_datos = ?
				AND id_usuario = ?
				AND estados = ?
	";

	return ejecuta($consulta, [$mensaje, $id, $value], 0);
}

//La tabla 'destinatario' va a desaparecer, se cambia por 'notificacion_destinatario', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function busca_destinatario($id){
	$consulta="SELECT count(id_destinatario) as r from destinatario where id_usuario=$id and estados=0";
	return ejecuta($consulta,[$id],0);
}

//La tabla 'datos' va a desaparecer, se cambia por 'notificacion', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function changeStatus($id,$mensaje){
	$consulta = "UPDATE destinatario SET estados = 0 WHERE id_usuario = $id AND id_datos = $mensaje AND estados = 1";
	ejecuta($consulta,[],0);
}


//La tabla 'datos' va a desaparecer, se cambia por 'notificacion', verificar que esta consulta siga en uso
//Existe función para guardar notificaciones en general/php/notificacion.php
function guarda_notificacion($mensaje){
	$consulta="INSERT INTO datos (autor,mensaje) VALUES(483,?)";
	return ejecuta($consulta,[$mensaje],1);
}

//****************************************************************************************************************
//09-08'2025 Alf: NUEVAS CONSULTAS PARA NUEVA TABLA NOTIFICACIÓN
function g_notificacion($us,$mensaje){
	$consulta="INSERT INTO notificacion (autor,mensaje) VALUES(?,?)";
	return ejecuta($consulta,[$us,$mensaje],1);
}

function b_mensaje($mensaje){
	$consulta = "SELECT * FROM notificacion WHERE mensaje = ?;";
	return ejecuta($consulta, [$mensaje], 0);
}

function a_destinatario($id,$mensaje){
	$consulta = "UPDATE notificacion_destinatario SET estado = 0 WHERE id_usuario = $id AND id_notificacion = $mensaje";
	ejecuta($consulta,[],0);
}

function g_destinatario($us,$id_notificacion){
	$consulta="INSERT INTO notificacion_destinatario (id_usuario,id_notificacion) VALUES(?,?)";
	ejecuta($consulta,[$us,$id_notificacion],0);
}

function b_notificacion_usuario($us,$id_notificacion){
	$consulta="select * from notificacion_destinatario where id_usuario=? and id_notificacion=?";
	return ejecuta($consulta,[$us,$id_notificacion],0);
}

function b_destinatario($id){
	$consulta="SELECT count(id_destinatario) as r from notificacion_destinatario where id_usuario=? and estado=0";
	return ejecuta($consulta,[$id],0);
}
?>
