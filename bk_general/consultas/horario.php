<?php
//**************************************
//*****           HORARIOS         *****
//**************************************

/* Muestra los eventos de la agenda*/
function salida_activa($us,$tp,$es){
	$consulta="SELECT * FROM horario where id_colaborador=$us and tipo=$tp $es order by hi desc";
	return completa($consulta);
}

function guarda_salida($us,$hora,$tp){
	$consulta="insert into horario(id_colaborador,hi,tipo) values ($us,'$hora',$tp)";
	return completa($consulta);
	
}

function actualiza_salida($us,$hf,$es,$retardo,$tp){
	$consulta="update horario set hf='$hf', estado=$es, retardo=$retardo where id_colaborador=$us and estado=0 and tipo=$tp";
	return completa($consulta);
}

function b_textra($id,$cond){
	$consulta="SELECT sum(tiempo) as tiempo FROM t_extra WHERE id_colaborador=$id and tipo$cond";
	return completa($consulta);
}

function b_textra2($id){
	$consulta="SELECT * FROM t_extra WHERE id_colaborador=$id order by fecha";
	return completa($consulta);
}



?>
