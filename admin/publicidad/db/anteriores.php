<?php

function b_control(){
	$consulta="SELECT * from ia_control where control=1 order by id_control desc limit 1";
	return completa($consulta);
}

function b_cuenta($fecha){
	$consulta="SELECT * from ia_grupo_cuenta where fecha like '$fecha'";
	return completa($consulta);
}

function a_cuenta($fecha){
	$consulta="update ia_grupo_cuenta set fecha='$fecha',cuenta=0";
	return completa($consulta);
}





function a_cuenta2(){
	$consulta="update ia_grupo_cuenta set cuenta=cuenta+1";
	return completa($consulta);
}


function a_control($id,$control){
	$consulta="update ia_control set control=$control where id_control=$id";
	completa($consulta);
}


?>
