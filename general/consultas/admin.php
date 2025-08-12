<?php

/*Inicia sesión de administrador
admin/login.php
*/

function sesion_inicio($us,$pas){
	$consulta="SELECT id_usuario, nombre, ap_pat, usuario FROM usuario where usuario like '$us' and clave like '$pas' and estado>0";
	return completa($consulta);	
	
}



/*--------------------------MODULO DE PUBLICIDAD----------------------------------------------------------------------------------------*/
/*Busca aplicaciones para acceso de cada usuario
admin/menu.php
*/
function b_acceso($id){
	$consulta="SELECT distinct(pl.id_app), nombre, url, icono, ar.descripcion as descr, ar.id_area
	FROM acceso as a, app as pl, area as ar 
	WHERE a.id_usuario = $id 
	and pl.id_app=a.id_app 
	and pl.id_area=ar.id_area 
	and pl.estado>0 order by ar.id_area, pl.nombre";
	return completa($consulta);
}

function b_app($cond){
	$consulta="SELECT * FROM app $cond order by nombre";
	return completa($consulta);
}

function b_area(){
	$consulta="SELECT * FROM area order by descripcion";
	return completa($consulta);
}


function b_pus($us, $app){
	$consulta="SELECT count(*) as r FROM acceso WHERE id_usuario=$us and id_app=$app";
	return completa($consulta);
}


function g_acc($us,$app){
	$consulta="insert into acceso values('',$us,$app)";
	completa($consulta);
}

function q_us($us){
	$consulta="delete from usuario where id_usuario=$us";
	completa($consulta);
}

function q_acc($us){
	$consulta="delete from acceso where id_usuario=$us";
	completa($consulta);
}

/*Inicia sesión de administrador
admin/login.php
*/

function c_clave($id){
	$consulta="SELECT e_cl FROM usuario where id_usuario=$id";
	return completa($consulta);	
}

function a_cl($us,$cl,$ecl){
	$consulta="update usuario set clave='$cl', e_cl=$ecl where id_usuario=$us";
	completa($consulta);
}


function a_us($id, $us, $nom, $ap, $am, $mail){
	$consulta="update usuario set usuario='$us', nombre='$nom', ap_pat='$ap', ap_mat='$am', correo='$mail' where id_usuario=$id";
	completa($consulta);
}

function b_cuenta($us){
	$consulta="SELECT id_cuenta, banco, cuenta from conta_cuenta where id_usuario=$us order by id_cuenta desc limit 1";
	return completa($consulta);
}



function b_banco($prom,$bn,$cta){
	$consulta="select count(id_cuenta) as r from conta_cuenta where id_usuario=$prom and banco='$bn' and cuenta=$cta";
	return completa($consulta);
}

function g_banco($us,$bn,$cta){
	$consulta="insert into conta_cuenta values('','$bn','$cta',$us)";
	completa($consulta);
}

function b_admin(){
	$consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario=u.id_usuario order by u.nombre;";
	return completa($consulta);
}


//made for boy hasware
// añadirPublicacion

function añadirPublicacion($nombre, $contenido, $imagen, $prioridad, $n_grupos, $lugar){
    // Insertar datos en la bd
    $consulta = "INSERT INTO publicidad_publicidades (nombre, contenido, imagen, prioridad, n_grupos, lugar, estado) VALUES ('$nombre', '$contenido', '$imagen', '$prioridad', '$n_grupos', '$lugar', 1)";
    completa($consulta);  
}
// Buscar publicidad por estado
function busca_publicidad($estado){
    $consulta = "SELECT nombre, contenido, id_publicidad from publicidad_publicidades where estado=$estado";
    $datos= completa($consulta);
    return $datos;
}
// Buscar publicidad por id (editarP)
function busca_publicidad2($id_publicidad){
    $consulta = "SELECT nombre, contenido, imagen, n_grupos, prioridad, estado, lugar FROM publicidad_publicidades WHERE id_publicidad = $id_publicidad";
    $datos= completa($consulta);
    return $datos;
}
function actualiza_publicidad($nombre, $contenido, $prioridad, $n_grupos, $lugar, $estado, $id_publicidad){
    $consulta = "UPDATE publicidad_publicidades SET nombre='$nombre', contenido='$contenido',  prioridad='$prioridad', n_grupos='$n_grupos', lugar='$lugar', estado='$estado' WHERE id_publicidad=$id_publicidad";
    completa($consulta); 
}
function actualiza_imagenP($imagen,$id_publicidad){
    $consulta = "UPDATE publicidad_publicidades SET imagen='$imagen' WHERE id_publicidad=$id_publicidad";
    return completa($consulta);
}
// borrar publicacion
function borrar($id){
    $consulta="delete from publicidad_publicidades where id_publicidad=$id";
    completa($consulta);
}


?>
