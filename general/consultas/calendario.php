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
	and fc='$fecha'
	and e.tipo=$tp
	and e.estado>0
	order by p.id_usuario";
	return completa($consulta);
}
//-----------------------------------------------------------------------------------


function b_ev2($tp, $us){
	global $hoy;
	$consulta="SELECT * FROM evento as e, evento_persona as p 
	WHERE e.id_evento=p.id_evento
	and fc<'$hoy'
	and e.estado=$tp
	and p.id_usuario=$us
	order by e.fc, e.hi";
	return completa($consulta);
}

function b_ev3($tp, $us){
	global $hoy;
	$consulta="SELECT * FROM evento as e, evento_persona as p 
	WHERE e.id_evento=p.id_evento
	and fc<'$hoy'
	and e.estado=$tp
	and not p.id_usuario=$us
	order by e.fc, e.hi";
	return completa($consulta);
}


function g_ev($titulo,$desc,$fc,$hi,$hf,$tp,$us){
	$fr=date('Y-m-d');
	$consulta="insert into evento values('','$titulo','$desc','$fr','$fc','$hi','$hf',$tp,1,$us)";
	return completa2($consulta);
}

function a_ev($id,$desc,$fecha,$hi,$hf,$tp){
	$consulta="update evento set descripcion='$desc', fc='$fecha',hi='$hi',hf='$hf',tipo=$tp where id_evento=$id";
	completa($consulta);
}

function a_ev2($id,$estado){
	$consulta="update evento set estado=$estado where id_evento=$id";
	completa($consulta);
}

function g_ev_per($id,$us){
	$consulta="insert into evento_persona values('',$id,$us)";
	completa($consulta);
}

function a_ev_per($id,$us){
	$consulta="update evento_persona set id_usuario=$us where id_evento=$id";
	completa($consulta);
}

function b_vista($us){
	global $hoy;
	$consulta="select count(fecha) as r from visto where id_usuario=$us and fecha>='$hoy'";
	return completa($consulta);
}

function g_vista($us){
	global $hoy;
	$consulta="insert into visto values('','$hoy',$us)";
	completa ($consulta);
}

function c_evp($us){
	global $hoy;
	$consulta="select count(e.id_evento) as r from evento as e, evento_persona as p where p.id_evento=e.id_evento and e.tipo=1 and e.f_sol='$hoy' and p.id_usuario=$us and e.estado>0";
	return completa ($consulta);
}

function c_evg(){
	global $hoy;
	$consulta="select count(id_evento) as r from evento where tipo=0 and f_sol='$hoy' and estado>0";
	return completa ($consulta);
}


function r_evento(){
	global $hoy;
	$consulta="update evento set fc='$hoy' where fc<'$hoy' and estado=1";
	completa($consulta);
}


?>

