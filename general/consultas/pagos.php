<?php
/*Busca el pago no realizado de un alumno*/

//alumno/pagos_muestra.php

function b_pagos($us){
	$base=abrir();
	$consulta="SELECT *
	FROM pago
	WHERE id_usuario=$us 
	order by f_pago desc";
	return completa($consulta);
}

function b_fechaPago($us){
	$base=abrir();
	$consulta="SELECT f_pago
	FROM alumno
	WHERE id_usuario=$us 
	order by f_pago desc";
	return completa($consulta);
}

function b_pagos2($id){
	$consulta="SELECT sum(cantidad) as pagos FROM pago WHERE id_usuario=$id and concepto like 'Colegiatura'";
	
	return completa($consulta);
}

function b_p64($b64){
	$base=abrir();
	$consulta="SELECT p.*, u.nombre, u.ap_pat, u.ap_mat 
	FROM pago as p, usuario as u 
	WHERE To_base64(concat(p.id_pago,p.id_usuario,p.f_pago))='$b64'
	and p.id_usuario=u.id_usuario";
	return completa($consulta);
}


function b_ufp($us){
	$base=abrir();
	$consulta="SELECT max(f_caducidad) as ufp from pago where id_usuario=$us";
	return completa($consulta);
}

function b_up($us){
	$base=abrir();
	$consulta="SELECT max(f_pago) as r from pago where id_usuario=$us";
	return completa($consulta);
}


function colegiatura($us){
	$consulta="SELECT colegiatura 
	FROM alumno as a, usuario as u
	where a.id_usuario=u.id_usuario
	and u.id_usuario=$us";
	return completa($consulta);
}

function g_pago($us,$cant,$desc, $fa, $fc){
	$consulta="INSERT INTO pago VALUES ('', $cant, '$fa', '$fc', '$desc', $us);";
	return completa2($consulta);
}

// Funciones Recibo de alumnos
function getDatesRang($id, $pago){
	$pago ++;
	$consulta = "SELECT f_caducidad FROM pago WHERE id_usuario = $id AND id_pago < $pago ORDER BY id_pago DESC limit 2";
	return completa($consulta);
}

function totalesAntesPago($id,$pago){
	$pago ++;
	$consulta="SELECT COUNT(id_pago) AS totales FROM pago WHERE id_usuario = $id AND id_pago < $pago ORDER BY id_pago DESC limit 2";
	return completa($consulta);
}

function getADate($idPago){
	$consulta = "SELECT id_pago, f_pago, f_caducidad FROM pago WHERE id_pago = $idPago";
	return completa($consulta);
}

function normalizarFecha($f1, $f2){
	$search  = array('01', '02', '03', '04', '05','06', '07', '08', '09', '10', '11', '12',);
	$replace = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio','agosto','septiembre','octubre','noviembre','diciembre');
	$primerFecha = explode('-',$f1);
	$segundaFecha = explode('-',$f2);
	$primerMes=str_replace($search, $replace, $primerFecha[1]);
	$segundoMes=str_replace($search, $replace, $segundaFecha[1]);
	$fechas_finales = $primerFecha[2] . " del " . $primerMes . " del " . $primerFecha[0] . " al " . $segundaFecha[2] . " del " . $segundoMes . " del " . $segundaFecha[0];
	return $fechas_finales;
}

// Funciones Guardar Pago
function diasPagados($cantidadPagada, $totalPagar) {
	$diasLey = ($cantidadPagada * 31)/$totalPagar;
	$diasFinales = round($diasLey);
	return $diasFinales;
}

function getDatePay($id){
	$consulta = "SELECT f_pago FROM alumno WHERE id_alumno = $id";
	return completa($consulta);
}

function b_cad($us){
	$fecha=date("Y-m-d");
	$consulta="SELECT max(f_caducidad) as cad from pago where id_usuario=$us and f_caducidad>='$fecha'";
	return completa($consulta);
}

function b_pago6($orden){
	$consulta="select id_alumno, id_material from orden_alumno where id_orden=$orden";
	return completa($consulta);
}

function a_fp($fpag,$alumno){
	$consulta="update alumno set f_pago='$fpag' where id_usuario=$alumno";
	return completa($consulta);
}

function fechasPago($id) {
	$consulta = "SELECT al.colegiatura, MAX(pa.f_caducidad) as caducidad 
				FROM usuario AS us, alumno AS al, pago AS pa
				WHERE us.id_usuario = $id
				AND us.id_usuario = al.id_usuario
				AND us.id_usuario = pa.id_usuario 
				";
	return completa($consulta);
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

