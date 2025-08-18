<?php
function b_us_ins($prom){
	$consulta="SELECT a.id_usuario, a.inscripcion, a.colegiatura, a.certificado, p.cantidad, p.f_pago, p.concepto, u.nombre
				from alumno as a, pago as p, usuario as u
				where p.id_usuario=a.id_usuario
				and a.id_promotor=?
				and a.id_usuario=u.id_usuario
				order by a.id_usuario desc, p.f_pago asc";
	return ejecuta($consulta, [$prom], 0);
}

function b_pago($prom,$edo){
	$consulta="SELECT e.id_egreso, e.cantidad, c.f_sol, c.f_at, c.cta
		FROM conta_egreso as e, conta_comision as c
		where c.id_usuario=?
		and c.id_egreso=e.id_egreso
		and e.estado=? order by c.f_at desc";
	return ejecuta($consulta, [$prom, $edo], 0);
}

function el_sol($id){
	$consulta="DELETE from conta_comision where id_egreso=?";
	ejecuta($consulta, [$id], 0);
}

function el_egreso($id){
	$consulta="DELETE from conta_egreso where id_egreso=?";
	ejecuta($consulta, [$id], 0);
}

function g_sol($us,$eg,$cta){
	$fe=date('Y-m-d');
	$consulta="INSERT INTO conta_comision(f_sol, cta, id_usuario, id_egreso) VALUES(?, ?, ?, ?)";
	return ejecuta($consulta, [$fe, $cta, $us, $eg], 1);
}

function b_comision($id){
	$consulta="SELECT c.* 
				from comision as c, alumno as a
				where a.id_usuario=?
				and a.id_comision=c.id_comision";
	return ejecuta($consulta, [$id], 0);
}

function b_promotor(){
	$consulta="SELECT * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario order by nombre;";
	return ejecuta($consulta, [], 0);
}	

function b_promotor1($id){
	$consulta="SELECT * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario and a.id_usuario=?;";
	 return ejecuta($consulta, [$id], 0);
}

function b_prom($id){
	$consulta="SELECT * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario and a.id_usuario=?;";
	return ejecuta($consulta, [$id], 0);
}

function b_liga($us){
	$consulta="SELECT * from liga where id_usuario=?;";
	return ejecuta($consulta, [$us], 0);
}

function b_liga2($id){
	$consulta="SELECT * from liga where id_liga=?;";
	return ejecuta($consulta, [$id], 0);
}

function b_promocion(){
	$consulta="SELECT * from promocion where estado>0;";
	return ejecuta($consulta, [], 0);
}

function b_promocion2($id){
	$consulta="SELECT * from promocion where id_promocion=?;";
	return ejecuta($consulta, [$id], 0);
}

function busca_bono($id){
    $consulta="SELECT * from promotor_bono where id_usuario=? and estado=1";
	return ejecuta($consulta, [$id], 0);
}