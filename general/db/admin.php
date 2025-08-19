<?php

/*Inicia sesión de administrador
admin/login.php
*/

function sesion_inicio($us,$pas){
	$consulta="SELECT id_usuario, nombre, ap_pat, usuario FROM usuario where usuario like ? and clave like ? and estado>0";
	return ejecuta($consulta, [$us, $pas], 0);	
	
}

function b_acceso($id){
	$consulta="SELECT distinct(pl.id_app), nombre, url, icono, ar.descripcion as descr, ar.id_area
	FROM acceso as a, app as pl, area as ar 
	WHERE a.id_usuario = ?
	and pl.id_app=a.id_app 
	and pl.id_area=ar.id_area 
	and pl.estado>0 order by ar.id_area, pl.nombre";
	return ejecuta($consulta, [$id], 0);
}

function b_app($cond){
	$consulta="SELECT * FROM app $cond ORDER BY nombre";
	return ejecuta($consulta, [], 0);
}

function b_area(){
	$consulta="SELECT * FROM area order by descripcion";
	return ejecuta($consulta, [], 0);
}


function b_pus($us, $app){
	$consulta="SELECT count(*) as r FROM acceso WHERE id_usuario = ? and id_app = ?";
	return ejecuta($consulta, [$us, $app], 0);
}


function g_acc($us,$app){
	$consulta="INSERT INTO acceso VALUES(NULL, ?, ?)";
	ejecuta($consulta, [$us, $app], 0);
}

function q_us($us){
	$consulta="DELETE from usuario where id_usuario = ?";
	ejecuta($consulta, [$us], 0);
}

function q_acc($us){
	$consulta="DELETE from acceso where id_usuario = ?";
	ejecuta($consulta, [$us], 0);
}

/*Inicia sesión de administrador
admin/login.php
*/

function c_clave($id){
	$consulta="SELECT e_cl FROM usuario where id_usuario=?";
	return ejecuta($consulta, [$id], 0);	
}

function a_cl($us,$cl,$ecl){
	$consulta="UPDATE usuario SET clave = ?, e_cl = ? where id_usuario = ?";
	ejecuta($consulta, [$cl, $ecl, $us], 0);
}


function a_us($id, $us, $nom, $ap, $am, $mail){
	$consulta="UPDATE usuario SET usuario = ?, nombre = ?, ap_pat = ?, ap_mat = ?, correo = ? where id_usuario = ?";
	ejecuta($consulta, [$us, $nom, $ap, $am, $mail, $id], 0);
}

function b_cuenta($us){
	$consulta="SELECT id_cuenta, banco, cuenta from conta_cuenta where id_usuario=? order by id_cuenta desc limit 1";
	return ejecuta($consulta, [$us], 0);
}

function b_banco($prom,$bn,$cta){
	$consulta="SELECT count(id_cuenta) as r from conta_cuenta where id_usuario=? and banco=? and cuenta=?";
	return ejecuta($consulta, [$prom, $bn, $cta], 0);
}

function g_banco($us,$bn,$cta){
	$consulta="INSERT into conta_cuenta values(NULL, ?, ?, ?)";
	ejecuta($consulta, [$bn, $cta, $us], 0);
}

function b_admin(){
	$consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario=u.id_usuario order by u.nombre;";
	return ejecuta($consulta, [], 0);
}
?>