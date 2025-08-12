<?php
/* Busca una carrera por condicioón y id */
function b_car($id){
	$consulta="select * from carrera where id_carrera$id";
	return completa($consulta);
}

/* Busca una carrera por estado */
function b_carrera($edo){
	$consulta="select * from carrera where estado$edo order by rank desc";
	return completa($consulta);
}


/* Selecciona todos los tipos de carreras*/
function b_tcarrera(){
	$consulta="SELECT * FROM carrera WHERE estado > 0 ORDER BY nombre ASC";
	return completa($consulta);
}



function b_nivel(){
	$consulta="select * from nivel where estado>0";
	return completa($consulta);
}

function b_nivel2($id){
	$consulta="select * from nivel where id_nivel=$id";
	return completa($consulta);
}

/* Guarda una carrera nueva */
function g_carrera($nom,$dur,$des,$im,$tp,$rank,$nivel){
	$consulta="insert into carrera values('','$nom',$dur,'$des','$im',$tp,$rank,$nivel,1)";
	completa($consulta);
}

/* Actualiza el ranking de una carrera */
function a_rank($idc){
	$consulta="update carrera set rank=rank+1 where id_carrera=$idc";
	completa($consulta);
}

/* Actualiza el ranking de una carrera */
function b_rank(){
	$consulta="select max(rank) as r from carrera";
	return completa($consulta);
}



?>
