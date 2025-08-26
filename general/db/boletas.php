<?php 

//Buscar nombre alumno y pago
function b_usual($where){
	$consulta="SELECT u.id_usuario, nombre, ap_pat, ap_mat FROM usuario as u, alumno as a WHERE nombre LIKE '%$where%' and a.id_alumno=u.id_usuario";
	return ejecuta($consulta, [], 0);
}

function b_pago($id){
	$consulta="SELECT u.id_usuario, MAX(p.f_caducidad) as f_caducidad FROM pago as p, usuario as u WHERE p.id_usuario=? and p.id_usuario=u.id_usuario";
	return ejecuta($consulta, [$id], 0);
}
function b_usu($us){
	$consulta="SELECT id_usuario, nombre, ap_pat, ap_mat FROM usuario where id_usuario=?";
	return ejecuta($consulta, [$us], 0);
}
function b_cole($id){
	$consulta="SELECT id_alumno, colegiatura FROM `alumno` WHERE id_alumno=?";
	return ejecuta($consulta, [$id], 0);
}
?>