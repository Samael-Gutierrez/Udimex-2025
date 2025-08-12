<?php
function b_inv($id){
	$consulta="SELECT count(id_inversionista) as r FROM inversionista where id_usuario=$id and estado>0";
	return completa($consulta);
}

function b_inv2(){
	$consulta="SELECT * FROM inversionista as i, usuario as u where i.id_usuario=u.id_usuario and i.estado>0 and u.estado>0 order by u.ap_pat, i.id_inversionista";
	return completa($consulta);
}


function b_depo($id){
	$consulta="SELECT * FROM inv_depo where id_usuario=$id and estado>0 order by fi";
	return completa($consulta);
}

function b_depo2($id){
	$consulta="SELECT sum(cantidad) as r FROM inv_depo where id_usuario=$id and estado>0";
	return completa($consulta);
}

function b_reserva($val){
	$consulta="SELECT * FROM inv_aux where nombre like '$val'";
	return completa($consulta);
}

function g_inv($cantidad,$us){
	$fecha=date('Y-m-d');
	$consulta="INSERT INTO inv_depo (fi, cantidad, id_usuario, estado) VALUES ('$fecha', $cantidad, $us, 1);";
	completa($consulta);
}

?>
