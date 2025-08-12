<?php

function busca_estudios($id){
	$consulta = "select * from usuario_estudios where id_usuario=? order by nivel asc";
	return ejecuta($consulta, [$id],0);
}

function carrera_guarda($id,$acr,$carrera,$nivel){
	$consulta = "insert into usuario_estudios values('',?,?,?,?)";
	return ejecuta($consulta, [$acr,$carrera,$nivel,$id],0);	
}
?>