<?php

function busca_mensajes($ad){
	$fecha=date('Y-m-d');
	$consulta="SELECT * from mensaje where estado=1 and f_atencion<='$fecha' $ad order by f_atencion asc limit 1";
	return completa($consulta);
}


function actualiza_mensaje($id,$valor){
	$consulta="update mensaje set estado=$valor where id_mensaje=$id";
	completa($consulta);
}

function guarda_mensaje($mensaje,$destino,$tipo,$f_at){
	$f_sol=date('Y-m-d');
	$consulta="insert into mensaje values('','$mensaje','$destino','$tipo','$f_sol','$f_at',1)";
	completa($consulta);
}
?>
