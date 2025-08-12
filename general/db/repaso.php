<?php


function busca_solicitud(){
	$consulta="SELECT count(id_repaso) as r FROM repaso where estado=0;";
	return completa($consulta);
}



?>
