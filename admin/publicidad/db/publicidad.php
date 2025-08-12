<?php
function buscaPublicidad(){
	$consulta="SELECT * FROM publicidad_publicidades WHERE n_grupos>0 and estado=1 order by n_grupos desc limit 1";
	return completa($consulta);
}

function busca_grupo($tipo,$estricto){
    if($estricto==0){
        $estricto="tipo<=".$tipo;
    }
    if($estricto==1){
        $estricto="tipo=".$tipo;
    }
	$fecha=date('Y-m-d');
	$consulta="select * from publicidad_grupos where acceso<'$fecha' and $estricto order by acceso asc limit 1";
	return completa($consulta);
}

function a_acceso($id){
	$fecha=date('Y-m-d');
	$consulta="update publicidad_grupos set acceso='$fecha' where id_grupo=$id";
	completa($consulta);
}

function busca_ngrupos(){
	$consulta="SELECT * FROM variables WHERE nombre like 'grupos'";
	return completa($consulta);
}

function suma_prioridad(){
	$consulta="SELECT sum(prioridad) as r FROM publicidad_publicidades WHERE estado=1";
	return completa($consulta);

}

function actualiza_grupos($t_grupos,$t_prioridad){
	$consulta="update publicidad_publicidades set n_grupos=($t_grupos/$t_prioridad)*prioridad";
	completa($consulta);
}

function actualiza_grupos2($id){
	$consulta="update publicidad_publicidades set n_grupos=n_grupos-1 where id_publicidad=$id";
	completa($consulta);
}



?>
