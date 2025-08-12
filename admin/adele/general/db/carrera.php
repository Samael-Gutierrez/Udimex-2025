<?php

function busca_carrera(){
	$consulta = "select * from carreras where estado>0 order by carrera asc";
	return ejecuta($consulta, [],0);
}


?>