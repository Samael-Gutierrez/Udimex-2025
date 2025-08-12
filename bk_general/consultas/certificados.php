<?php
function certificados_pagados(){
	$consulta="SELECT * FROM pago as p, usuario as u WHERE p.concepto LIKE 'certificado' and p.id_usuario=u.id_usuario;";
	return completa($consulta);
}

function busca_seguimiento($id){
	$consulta="SELECT * FROM certificado WHERE id_usuario=$id";
	return completa($consulta);
}

function guarda_seguimiento($id,$estado,$observacion){
	$fecha=date('Y-m-d');
	$consulta="insert into certificado values('',$id,'$fecha',$estado,'$observacion')";
	completa($consulta);
}

function busca_seguimiento_fecha(){
	$consulta="select DISTINCT(id_usuario) FROM certificado order by fecha asc;";
	return completa($consulta);
}

function busca_datos_seguimiento($id){
	$consulta="select * 
from certificado as c, usuario as u, certificado_estado as e
where c.id_usuario=$id
and c.id_usuario=u.id_usuario 
and c.id_estado=e.id_estado
order by id_certificado desc limit 1;";
	return completa($consulta);
}

function busca_estados(){
	$consulta="SELECT * 
	FROM certificado_estado";
	return completa($consulta);
}
?>
