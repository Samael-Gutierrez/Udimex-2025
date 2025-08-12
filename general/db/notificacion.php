<?php

//Usar la nueva función ejecuta(consulta,[argumentos],tipo) en lugar de completa o completa2

function guarda_notificacion($mensaje){
	$consulta="INSERT INTO datos (autor,mensaje) VALUES(483,'$mensaje')";
	echo $consulta;
	return completa2($consulta);
}

function guarda_destinatario($id_mensaje,$id){
	$consulta="INSERT INTO destinatario (id_datos,id_usuario) VALUES($id_mensaje,$id)";
	completa($consulta);
}

function saveQualification($calificacion, $tema, $id_alumno){
	$date = Date("Y-m-d");
	$consulta = "INSERT INTO calificacion (valor, fecha_registro, id_materia, id_alumno) VALUES (?, ?, ?, ?);";
	ejecuta($consulta, [$calificacion, $date, $tema, $id_alumno], 0);
}

function getTeacherByCover($id){
	$consulta = "SELECT id_usuario FROM portada WHERE id_portada = $id";
	return completa($consulta);
}

function getInfoByCover($id){
	$consulta = "SELECT ma.nombre_materia AS materia, a.contenido AS tema
                FROM materias AS ma, portada AS p, adicionales AS a
                WHERE p.id_portada = $id
                AND p.id_portada = a.id_portada
                AND p.id_materia = ma.id_materia
	";

	return completa($consulta);
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
				AND estados = ?
	";

	return ejecuta($consulta, [$mensaje, $id, $value], 0);
}

function busca_destinatario($id){
	$consulta="SELECT count(id_destinatario) as r from destinatario where id_usuario=$id and estados=0";
	return ejecuta($consulta,[$id],0);
}

function changeStatus($id,$mensaje){
	$consulta = "UPDATE destinatario SET estados = 0 WHERE id_usuario = $id AND id_datos = $mensaje AND estados = 1";
	completa($consulta);
}

?>
