<?php

function busca_periodo(){
    $consulta = "SELECT * FROM periodo_anio as pa, periodo as p, periodo_inicio as pi 
	WHERE pa.estado=1
	and pa.id_periodo=p.id_periodo
	and p.id_periodo=pi.id_periodo";
    return ejecuta($consulta, [],0);
}

function busca_materia($materia){
    $consulta = "SELECT * FROM materias where materia like ?";
    return ejecuta($consulta, [$materia],0);	
}

function guarda_materia($materia){
    $consulta = "insert into materias values('',?)";
    return ejecuta($consulta, [$materia],1);	
}

function busca_materia_carrera($materia,$carrera,$cuatri){
	$consulta="SELECT * FROM materia_carrera WHERE id_materia=? and id_carrera=? and cuatrimestre=?";
	return ejecuta($consulta, [$materia,$carrera,$cuatri],0);	
}

function guarda_materia_carrera($materia,$carrera,$cuatri){
	$consulta="insert into materia_carrera values('',?,?,?)";
	return ejecuta($consulta, [$materia,$carrera,$cuatri],1);	
}


function guarda_materia_profesor($mc,$profesor,$periodo){
	$consulta="insert into materia_profesor values('',?,?,?)";
	return ejecuta($consulta, [$mc,$profesor,$periodo],0);	
}

function busca_materia_profesor($mc,$profesor,$periodo){
	$consulta="select * from materia_profesor where id_mc=? and id_profesor=? and id_pa=?";
	return ejecuta($consulta, [$mc,$profesor,$periodo],0);	
}

function busca_materia_profesor2($profesor,$periodo){
	$consulta="select * 
	from materia_profesor as mp, materias as m, carreras as c, materia_carrera as mc
	where mp.id_profesor=? 
	and mp.id_pa=?
	and mp.id_mc=mc.id_mc
	and mc.id_materia=m.id_materia
	and mc.id_carrera=c.id_carrera";
	return ejecuta($consulta, [$profesor,$periodo],0);	
}

function busca_grupo($lista,$profesor){
	$consulta="SELECT * FROM materia_profesor as mp, carreras as c, materia_carrera as mc
where mp.id_mp=? and mp.id_profesor=? and mp.id_mc=mc.id_mc and mc.id_carrera=c.id_carrera";
	return ejecuta($consulta, [$lista,$profesor],0);	
}
?>
