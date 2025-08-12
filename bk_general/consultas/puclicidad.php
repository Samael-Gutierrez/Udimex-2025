<?php

function b_publicidad($id){
	$consulta="select * from publicidad where id_publicidad=$id and estado=1 ";
	echo $consulta;
	return completa($consulta);
	

}

function b_alumno_c($id_usuario){
	$consulta="select * from alumno where id_usuario=$id_usuario";
	echo $consulta;
	return completa($consulta);
}


function b_alu_b_c_b_e($id_usuario,$id_alumno,$id_carrera,$id_publicidad){
$consulta="select * from alumno as a,publicidad as pwhere a.idusuario=$id_usuario and a.id_carrera=p.id_carrera and p.estado > 0
order by rand() limit 3";
return completa($consulta);
 

}

/*function b_publicidad2($url){
	$r="select * from carrera_publicidad where servicios=$url";
	return completa($r);
}
/*
$datos=b_publicidad2($carrera);
if($fila=mysqli_fetch_assoc($datos)){
	echo $fila['url'];
}*/




function busca_pu($id_usuario){
	$res="SELECT distinct * from  alumno as a, carrera_publicidad as cp, publicidad as p where a.id_alumno=$id_usuario and a.id_carrera=cp.id_carrera and cp.id_publicidad=p.id_publicidad order by rand () limit 3";
	return completa ($res);
}

function b_a($id_usuario){
$consulta="select * from usuario where id_usuario=$id_usuario;
select * de alumno where id_alumno=$id_usuario ";
echo $consulta;
return $consulta;
}


?>

