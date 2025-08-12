<?php

function buscaAcciones($ad){
	$consulta="SELECT * from acciones $ad order by prioridad desc, id_accion asc";
	return completa($consulta);
}

function buscaPrioridadSiguiente($pr){
	$consulta="SELECT min(prioridad) as r from acciones where prioridad>$pr and estado=1";
	return completa($consulta);
}

function cambiaPrioridad($id,$pr){
	$consulta="update acciones set prioridad=$pr where id_accion=$id";
	completa($consulta);
}

function cambiaEstado($id,$estado){
	$consulta="update acciones set estado=$estado where id_accion=$id";
	completa($consulta);
}

function actualiza_accion($accion, $valor, $estado){
	$consulta="update acciones set realizado=$valor, estado=$estado where id_accion=$accion";
	completa($consulta);
}

function actualiza_accion2(){
	$consulta="update acciones set realizado=0";
	completa($consulta);
}

function busca_dia(){
	$fecha=date('Y-m-d');
	$consulta="SELECT * FROM variables WHERE nombre like 'dia' and valor<'$fecha'";
	return completa($consulta);
}


function actualiza_dia($id){
	$fecha=date('Y-m-d');
	$consulta="update variables set valor='$fecha' where id_variable=$id";
	return completa($consulta);
}
?>
