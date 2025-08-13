<?php
function b_inv($id){
	$consulta="SELECT count(id_inversionista) AS r FROM inversionista WHERE id_usuario = ? AND estado>0";
	return ejecuta($consulta, [$id], 0);
}

function b_inv2(){
	$consulta="SELECT * FROM inversionista as i, usuario as u WHERE i.id_usuario=u.id_usuario AND i.estado>0 AND u.estado>0 ORDER BY u.ap_pat, i.id_inversionista";
	return ejecuta($consulta, [], 0);
}

function b_depo($id){
	$consulta="SELECT * FROM inv_depo WHERE id_usuario = ? AND estado>0 ORDER BY fi";
	return ejecuta($consulta, [$id], 0);
}

function b_depo2($id){
	$consulta="SELECT sum(cantidad) as r FROM inv_depo WHERE id_usuario = ? AND estado>0";
	return ejecuta($consulta, [$id], 0);
}

function b_reserva($val){
	$consulta="SELECT * FROM inv_aux WHERE nombre LIKE ? ;";
	return ejecuta($consulta, [$val], 0);
}

function g_inv($cantidad,$us){
	$fecha=date('Y-m-d');
	$consulta="INSERT INTO inv_depo (fi, cantidad, id_usuario, estado) VALUES(?, ?, ?, ?);";
	ejecuta($consulta, [$fecha, $cantidad, $us, 1], 0);
}

?>
