<?php
function certificados_pagados(){
	$consulta="SELECT * FROM pago as p, usuario as u WHERE p.concepto LIKE 'certificado' and p.id_usuario=u.id_usuario;";
	return ejecuta($consulta, [], 0);
}

function busca_seguimiento($id){
	$consulta="SELECT * FROM certificado WHERE id_usuario=?";
	return ejecuta($consulta, [$id], 0);
}

function guarda_seguimiento($id,$estado,$observacion){
	$fecha=date('Y-m-d');
	$consulta="INSERT into certificado values(NULL, ?, ?, ?, ?)";
	ejecuta($consulta, [$id, $fecha, $estado, $observacion], 0);
}

function busca_seguimiento_fecha(){
	$consulta="SELECT DISTINCT(id_usuario) FROM certificado order by fecha asc;";
	return ejecuta($consulta, [], 0);
}

function busca_datos_seguimiento($id){
	$consulta="SELECT * from certificado as c, usuario as u, certificado_estado as e
				where c.id_usuario=$id
				and c.id_usuario=u.id_usuario 
				and c.id_estado=e.id_estado
				order by id_certificado desc limit 1;";
	return ejecuta($consulta, [], 0);
}

function busca_estados(){
	$consulta="SELECT * FROM certificado_estado";
	return ejecuta($consulta, [], 0);
}
?>
