<?php

/*Inicia sesión de administrador
admin/login.php
*/

function sesion_inicio($us,$pas){
	$consulta="SELECT id_usuario, nombre, ap_pat, usuario FROM usuario where usuario like '$us' and clave like '$pas' and estado>0";
	return completa($consulta,0);	
	
}



/*--------------------------MODULO DE PUBLICIDAD----------------------------------------------------------------------------------------*/
/*Busca aplicaciones para acceso de cada usuario
admin/menu.php
*/
function b_acceso($id){
	$consulta="SELECT distinct(pl.id_app), nombre, url, icono, ar.descripcion as descr, ar.id_area
	FROM acceso as a, app as pl, area as ar 
	WHERE a.id_usuario = $id 
	and pl.id_app=a.id_app 
	and pl.id_area=ar.id_area 
	and pl.estado>0 order by ar.id_area, pl.nombre";
	return completa($consulta,0);
}

function b_app($cond){
	$consulta="SELECT * FROM app $cond order by nombre";
	return completa($consulta,0);
}

function b_area(){
	$consulta="SELECT * FROM area order by descripcion";
	return completa($consulta,0);
}


function b_pus($us, $app){
	$consulta="SELECT count(*) as r FROM acceso WHERE id_usuario=$us and id_app=$app";
	return completa($consulta,0);
}


function g_acc($us,$app){
	$consulta="insert into acceso values('',$us,$app)";
	completa($consulta,0);
}

function q_us($us){
	$consulta="delete from usuario where id_usuario=$us";
	completa($consulta,0);
}

function q_acc($us){
	$consulta="delete from acceso where id_usuario=$us";
	completa($consulta,0);
}

/*Inicia sesión de administrador
admin/login.php
*/

function c_clave($id){
	$consulta="SELECT e_cl FROM usuario where id_usuario=$id";
	return completa($consulta,0);	
}

function a_cl($us,$cl,$ecl){
	$consulta="update usuario set clave='$cl', e_cl=$ecl where id_usuario=$us";
	completa($consulta,0);
}


function a_us($id, $us, $nom, $ap, $am, $mail){
	$consulta="update usuario set usuario='$us', nombre='$nom', ap_pat='$ap', ap_mat='$am', correo='$mail' where id_usuario=$id";
	completa($consulta,0);
}

function b_cuenta($us){
	$consulta="SELECT id_cuenta, banco, cuenta from conta_cuenta where id_usuario=$us order by id_cuenta desc limit 1";
	return completa($consulta,0);
}



function b_banco($prom,$bn,$cta){
	$consulta="select count(id_cuenta) as r from conta_cuenta where id_usuario=$prom and banco='$bn' and cuenta=$cta";
	return completa($consulta,0);
}

function g_banco($us,$bn,$cta){
	$consulta="insert into conta_cuenta values('','$bn','$cta',$us)";
	completa($consulta,0);
}

function b_admin(){
	$consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario=u.id_usuario order by u.nombre;";
	return completa($consulta,0);
}




?>
