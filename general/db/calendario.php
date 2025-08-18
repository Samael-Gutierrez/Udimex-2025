<?php

//**************************************
//********     Calendario      *********
//**************************************


//Busca los permisos generales para consulta en línea de un trámite
//calendario/calendario.php;

$hoy=date('Y-m-d');

function b_ev($fecha,$tp){
	$consulta="SELECT * FROM evento as e, evento_persona as p 
	WHERE e.id_evento=p.id_evento
	and fc=?
	and e.tipo=?
	and e.estado>0
	order by p.id_usuario";
	return ejecuta($consulta, [$fecha, $tp], 0);
}
//-----------------------------------------------------------------------------------


function b_ev2($tp, $us){
	global $hoy;
	$consulta="SELECT * FROM evento as e, evento_persona as p 
	WHERE e.id_evento=p.id_evento
	and fc<?
	and e.estado=?
	and p.id_usuario=?
	order by e.fc, e.hi";
	return ejecuta($consulta, [$hoy, $tp, $us], 0);
}

function b_ev3($tp, $us){
	global $hoy;
	$consulta="SELECT * FROM evento as e, evento_persona as p 
	WHERE e.id_evento=p.id_evento
	and fc<?
	and e.estado=?
	and not p.id_usuario=?
	order by e.fc, e.hi";
	return ejecuta($consulta, [$hoy, $tp, $us], 0);
}


function g_ev($titulo,$desc,$fc,$hi,$hf,$tp,$us){
	$fr=date('Y-m-d');
	$consulta="INSERT into evento values(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	return ejecuta($consulta, [$titulo, $desc, $fr, $fc, $hi, $hf, $tp, 1, $us], 1);
}

function a_ev($id,$desc,$fecha,$hi,$hf,$tp){
	$consulta="UPDATE evento set descripcion=?, fc=?, hi=?, hf=?, tipo=? where id_evento=?";
	ejecuta($consulta, [$desc, $fecha, $hi, $hf, $tp, $id], 0);
}

function a_ev2($id,$estado){
	$consulta="UPDATE evento set estado=? where id_evento=?";
	ejecuta($consulta, [$estado, $id], 0);
}

function g_ev_per($id,$us){
	$consulta="INSERT into evento_persona values(NULL, ?, ?)";
	ejecuta($consulta, [$id, $us], 0);
}

function a_ev_per($id,$us){
	$consulta="UPDATE evento_persona set id_usuario=? where id_evento=?";
	ejecuta($consulta, [$us, $id], 0);
}

function b_vista($us){
	global $hoy;
	$consulta="SELECT count(fecha) as r from visto where id_usuario=? and fecha>=?";
	return ejecuta($consulta, [$us, $hoy], 0);
}

function g_vista($us){
	global $hoy;
	$consulta="INSERT into visto values(NULL, ?, ?)";
	ejecuta ($consulta, [$hoy, $us], 0);
}

function c_evp($us){
	global $hoy;
	$consulta="SELECT count(e.id_evento) as r from evento as e, evento_persona as p where p.id_evento=e.id_evento and e.tipo=1 and e.f_sol=? and p.id_usuario=? and e.estado>0";
	return ejecuta ($consulta, [$hoy, $us], 0);
}

function c_evg(){
	global $hoy;
	$consulta="SELECT count(id_evento) as r from evento where tipo=0 and f_sol=? and estado>0";
	return ejecuta ($consulta, [$hoy], 0);
}

function r_evento(){
	global $hoy;
	$consulta="UPDATE evento set fc=? where fc<? and estado=1";
	ejecuta($consulta, [$hoy, $hoy], 0);
}
?>