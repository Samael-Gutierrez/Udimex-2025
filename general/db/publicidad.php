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
/*$consulta="select * from usuario where id_usuario=$id_usuario;
select * de alumno where id_alumno=$id_usuario ";
echo $consulta;
return $consulta;*/
}


function b_publicaciones($us,$estado){
	$consulta="SELECT * FROM publicidad_publicidades where id_usuario=? and estado=?";
	return ejecuta($consulta,[$us,$estado],0);
}


//made for boy hasware
// añadirPublicacion

function añadirPublicacion($nombre, $contenido, $imagen, $prioridad, $n_grupos, $lugar,$us){
    // Insertar datos en la bd
    $consulta = "INSERT INTO publicidad_publicidades VALUES (NULL,?,?,?,?,?,?,1,?)";
    ejecuta($consulta,[$nombre,$contenido,$imagen,$prioridad,$n_grupos,$lugar,$us],0);  
}
// Buscar publicidad por estado
function busca_publicidad($estado){
    $consulta = "SELECT nombre, contenido, id_publicidad from publicidad_publicidades where estado=$estado";
    $datos= ejecuta($consulta,[],0);
    return $datos;
}
// Buscar publicidad por id (editarP)
function busca_publicidad2($id_publicidad){
    $consulta = "SELECT nombre, contenido, imagen, n_grupos, prioridad, estado, lugar FROM publicidad_publicidades WHERE id_publicidad = $id_publicidad";
    $datos= ejecuta($consulta,[],0);
    return $datos;
}
function actualiza_publicidad($nombre, $contenido, $prioridad, $n_grupos, $lugar, $estado, $id_publicidad){
    $consulta = "UPDATE publicidad_publicidades SET nombre='$nombre', contenido='$contenido',  prioridad='$prioridad', n_grupos='$n_grupos', lugar='$lugar', estado='$estado' WHERE id_publicidad=$id_publicidad";
    ejecuta($consulta,[],0); 
}
function actualiza_imagenP($imagen,$id_publicidad){
    $consulta = "UPDATE publicidad_publicidades SET imagen='$imagen' WHERE id_publicidad=$id_publicidad";
    return ejecuta($consulta,[],0);
}
// borrar publicacion
function borrar($id){
    $consulta="delete from publicidad_publicidades where id_publicidad=$id";
    ejecuta($consulta,[],0);
}


?>

