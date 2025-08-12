<?php
/*Busca el pago no realizado de un alumno*/

//alumno/pagos_muestra.php

function b_pagos($us){
	$base=abrir();
	$consulta="SELECT *
	FROM pago
	WHERE id_usuario=$us 
	order by f_pago desc";
	return completa($consulta,0);
}

function b_fechaPago($us){
	$base=abrir();
	$consulta="SELECT f_pago
	FROM alumno
	WHERE id_usuario=$us 
	order by f_pago desc";
	return completa($consulta,0);
}

function b_pagos2($id){
	$consulta="SELECT sum(cantidad) as pagos FROM pago WHERE id_usuario=$id and concepto like 'Colegiatura'";
	
	return completa($consulta,0);
}

function b_p64($b64){
	$base=abrir();
	$consulta="SELECT p.*, u.nombre, u.ap_pat, u.ap_mat 
	FROM pago as p, usuario as u 
	WHERE To_base64(concat(p.id_pago,p.id_usuario,p.f_pago))='$b64'
	and p.id_usuario=u.id_usuario";
	return completa($consulta,0);
}

function b_up($us){
	$base=abrir();
	$consulta="SELECT max(f_pago) as r from pago where id_usuario=$us";
	return completa($consulta,0);
}


function colegiatura($us){
	$consulta="SELECT colegiatura 
	FROM alumno as a, usuario as u
	where a.id_usuario=u.id_usuario
	and u.id_usuario=$us";
	return completa($consulta,0);
}

function g_pago($us,$cant,$desc, $fa, $fc){
	$consulta="INSERT INTO pago VALUES ('', $cant, '$fa', '$fc', '$desc', $us);";
	return completa($consulta,1);
}




function a_fp($fpag,$alumno){
	$consulta="update alumno set f_pago='$fpag' where id_usuario=$alumno";
	return completa($consulta,0);
}


function fechasPago($id) {
	$consulta = "SELECT al.colegiatura, MAX(pa.f_caducidad) as caducidad 
				FROM usuario AS us, alumno AS al, pago AS pa
				WHERE us.id_usuario = ?
				AND us.id_usuario = al.id_usuario
				AND us.id_usuario = pa.id_usuario 
				";
	return ejecuta($consulta,[$id],0);
}

function b_cad($us){
	$fecha=date("Y-m-d");
	$consulta="SELECT max(f_caducidad) as cad from pago where id_usuario=? and f_caducidad>=?";
	return ejecuta($consulta,[$us,$fecha],0);
}

function b_ufp($us){
	echo "consulta duplicada, cambiar por b_cad";
}


function ordenFecha($fecha){
	$search  = array('01', '02', '03', '04', '05','06', '07', '08', '09', '10', '11', '12',);
	$replace = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio','agosto','septiembre','octubre','noviembre','diciembre');
	$primerFecha = explode('-', $fecha);
	$primerMes=str_replace($search, $replace, $primerFecha[1]);
	$fechaFinal = $primerFecha[2] . " de " . $primerMes . " del " . $primerFecha[0];
	return $fechaFinal;
}


?>

