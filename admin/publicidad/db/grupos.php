<?php

function guarda_grupo($url,$op){
	$fecha="2000-01-01";
	$sesion=1;
	$consulta="insert into publicidad_grupos values('','$url','$fecha',$op,$sesion)";
	echo $consulta;
	completa($consulta);
}

function b_grupo($url){
	$consulta="select count(*) as r from publicidad_grupos where liga like '$url'";
	return completa($consulta);
}





?>
