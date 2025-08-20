<?php

function b_ing($fi,$ff){
	$consulta="SELECT SUM(cantidad) AS res FROM `pago` WHERE f_pago BETWEEN ? and ? and cantidad>1";
	return ejecuta($consulta, [$fi, $ff], 0);
}

function b_eg($fi,$ff,$edo){
	$consulta="SELECT SUM(cantidad) as res FROM conta_egreso WHERE fecha BETWEEN ? and ? and estado = ?;";
	return ejecuta($consulta, [$fi, $ff, $edo], 0);
}

//busca los egresos comprendidos en una fecha especificada
function b_egresos($fi,$ff,$edo){
	$consulta="SELECT * FROM conta_egreso WHERE fecha BETWEEN ? AND ? AND estado = ? ORDER BY fecha";
	return ejecuta($consulta, [$fi, $ff, $edo], 0);
}
function b_ingresos($fi,$ff,$id_usuario){
	$consulta="SELECT * FROM `pago` WHERE f_pago BETWEEN ? and ? and cantidad>1";
	return ejecuta($consulta, [$fi, $ff], 0);
}

function g_egreso($conc,$cant,$fecha,$edo){
	if ($fecha==''){
		$fecha=date('Y-m-d');
	}
	$consulta="INSERT INTO conta_egreso VALUES( NULL, ?, ?, ?, ?)";
	return ejecuta($consulta, [$conc, $cant, $fecha, $edo], 1);
}
function g_ingreso1($cant1,$fecha1,$descu){
	if ($fecha1==''){
		$fecha1=date('Y-m-d');
	}
	$consulta="INSERT INTO pago VALUES(NULL, ?, ?, ?, ?,0)";
	ejecuta($consulta, [$cant1, $fecha1, $fecha1, $descu], 0);
}

function b_sobrecargos($fi,$ff){
	$consulta = "SELECT SUM(cantidad) AS total FROM sobrecargo WHERE fecha_pago BETWEEN ? and ? and cantidad>1";
	return ejecuta($consulta, [$fi, $ff], 0);
}

function b_sobres($fi,$ff){
	$consulta = "SELECT * FROM sobrecargo WHERE fecha_pago BETWEEN ? AND ? AND cantidad>1";
	return ejecuta($consulta, [$fi, $ff], 0);
}

function getNameById($id){
	$consulta = "SELECT u.nombre, u.ap_pat FROM alumno AS a, usuario AS u WHERE a.id_usuario = ? AND a.id_usuario = u.id_usuario";
	return ejecuta($consulta, [$id], 0);
}

?>
