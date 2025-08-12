<?php

function b_publicidad($id){
	$consulta="SELECT * FROM publicidad WHERE id_publicidad = ? AND estado = 1;";
	return ejecuta($consulta, [$id], 0);
}

function b_alumno_c($id_usuario){
	$consulta="SELECT * FROM alumno WHERE id_usuario = ?;";
	return ejecuta($consulta, [$id_usuario], 0);
}

function b_alu_b_c_b_e($id_usuario,$id_alumno,$id_carrera,$id_publicidad){
    $consulta="SELECT * FROM alumno AS a,publicidad AS p WHERE a.idusuario= ? AND a.id_carrera=p.id_carrera AND p.estado > 0 ORDER BY RAND() LIMIT 3";
    return ejecuta($consulta, [$id_usuario], 0);
}


function busca_pu($id_usuario){
	$consulta="SELECT DISTINCT * FROM  alumno AS a, carrera_publicidad AS cp, publicidad AS p 
				WHERE a.id_alumno = ?
				AND a.id_carrera=cp.id_carrera 
				AND cp.id_publicidad=p.id_publicidad ORDER BY RAND() LIMIT 3";
	return ejecuta($consulta, [$id_usuario], 0);
}

function b_publicaciones($us,$estado){
	$consulta="SELECT * FROM publicidad_publicidades WHERE id_usuario=? AND estado=?";
	return ejecuta($consulta,[$us,$estado],0);
}


//made for boy hasware
// añadirPublicacion
function añadirPublicacion($nombre, $contenido, $imagen, $prioridad, $n_grupos, $lugar,$us){
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

