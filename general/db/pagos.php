<?php
/*Busca el pago no realizado de un alumno*/

function b_pagos($us){
	$consulta="SELECT * FROM pago WHERE id_usuario = ? ORDER BY f_pago DESC";
	return ejecuta($consulta, [$us], 0);
}

function b_fechaPago($us){
	$consulta="SELECT f_pago FROM alumno WHERE id_usuario = ? ORDER BY f_pago DESC";
	return ejecuta($consulta, [$us], 0);
}

function b_pagos2($id){
	$consulta="SELECT sum(cantidad) AS pagos FROM pago WHERE id_usuario = ? AND concepto LIKE 'Colegiatura'";
	return ejecuta($consulta, [$id], 0);
}

function b_p64($b64){
	$consulta="SELECT p.*, u.nombre, u.ap_pat, u.ap_mat 
				FROM pago AS p, usuario AS u 
				WHERE To_base64(concat(p.id_pago,p.id_usuario,p.f_pago)) = ?
				AND p.id_usuario=u.id_usuario";
	return ejecuta($consulta, [$b64], 0);
}

function b_up($us){
	$consulta="SELECT max(f_pago) AS r FROM pago WHERE id_usuario = ?;";
	return ejecuta($consulta, [$us], 0);
}


function colegiatura($us){
	$consulta="SELECT colegiatura 
				FROM alumno as a, usuario as u
				WHERE a.id_usuario=u.id_usuario
				AND u.id_usuario = ? ;";
	return ejecuta($consulta, [$us], 0);
}

function g_pago($us,$cant,$desc, $fa, $fc){
	$consulta="INSERT INTO pago VALUES (NULL, ?, ?, ?, ?, ?);";
	return ejecuta($consulta, [$cant, $fa, $fc, $desc, $us], 1);
}

function a_fp($fpag,$alumno){
	$consulta="UPDATE alumno SET f_pago = ? WHERE id_usuario = ?;";
	return ejecuta($consulta, [$fpag, $alumno], 0);
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
	$consulta="SELECT max(f_caducidad) AS cad FROM pago WHERE id_usuario=? AND f_caducidad>=?";
	return ejecuta($consulta,[$us,$fecha],0);
}

function totalesAntesPago($id,$pago){
	$pago ++;
	$consulta="SELECT COUNT(id_pago) AS totales FROM pago WHERE id_usuario = ? AND id_pago < ? ORDER BY id_pago DESC limit 2";
	return ejecuta($consulta, [$id, $pago], 0);
}

function getDatesRang($id, $pago){
	$pago ++;
	$consulta = "SELECT f_caducidad FROM pago WHERE id_usuario = ? AND id_pago < ? ORDER BY id_pago DESC limit 2";
	return ejecuta($consulta, [$id, $pago], 0);
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