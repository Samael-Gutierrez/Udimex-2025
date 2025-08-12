<?php

function buscaAcciones($ad){
	$consulta="SELECT * from ia_acciones $ad order by prioridad desc, id_accion asc";
	return completa($consulta);
}

function buscaPrioridadSiguiente($pr){
	$consulta="SELECT min(prioridad) as r from ia_acciones where prioridad>$pr and estado=1";
	return completa($consulta);
}

function cambiaPrioridad($id,$pr){
	$consulta="update ia_acciones set prioridad=$pr where id_accion=$id";
	completa($consulta);
}

function cambiaEstado($id,$estado){
	$consulta="update ia_acciones set estado=$estado where id_accion=$id";
	completa($consulta);
}

function actualiza_accion($accion, $valor, $estado){
	$consulta="update ia_acciones set realizado=$valor, estado=$estado where id_accion=$accion";
	completa($consulta);
}

function actualiza_accion2(){
	$consulta="update ia_acciones set realizado=0";
	completa($consulta);
}

function busca_dia(){
	$fecha=date('Y-m-d');
	$consulta="SELECT * from ia_variables WHERE nombre like 'dia' and valor<'$fecha'";
	return completa($consulta);
}


function actualiza_dia($id){
	$fecha=date('Y-m-d');
	$consulta="update ia_variables set valor='$fecha' where id_variable=$id";
	return completa($consulta);
}
?>
