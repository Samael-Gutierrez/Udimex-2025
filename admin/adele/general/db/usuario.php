<?php

function busca_usuario($correo) {
    $consulta = "SELECT * FROM usuarios WHERE correo like ?";
    return ejecuta($consulta, [$correo],0);
}

function guarda_usuario($nombre,$ap,$am,$email,$clave){
	$consulta = "insert into usuarios(nombre,ap,am,correo,clave,estado) values(?,?,?,?,?,1)";
    return ejecuta($consulta, [$nombre,$ap,$am,$email,$clave],1);
}

function guarda_telefono($id,$tel){
	$consulta = "insert into telefonos(numero,id_usuario) values(?,?)";
    ejecuta($consulta, [$tel,$id],0);
}

function busca_id($id){
	$consulta = "select * from usuarios where id_usuario = ?";
    return ejecuta($consulta, [$id],0);
}

function busca_acceso($id){
	$fecha=date('Y-m-d');
	$consulta = "SELECT * 
	FROM acceso as ac, aplicacion as app 
	WHERE ac.id_usuario=?
	and ac.fecha_expiracion>?
	and app.estado=1
	and ac.id_aplicacion=app.id_aplicacion
	order by categoria, app.id_aplicacion;";
    return ejecuta($consulta, [$id,$fecha],0);
}

function busca_desactivados() {
    $consulta = "SELECT * FROM usuarios WHERE estado=1";
    return ejecuta($consulta, [],0);
}

function activa_cuenta($id) {
    $consulta = "update usuarios set estado=2 where id_usuario=?";
	ejecuta($consulta, [$id],0);
}

function activa_aplicacion($id,$app,$fecha){
    $consulta = "insert into acceso (id_usuario,id_aplicacion,fecha_expiracion) values(?,?,?)";
	ejecuta($consulta, [$id,$app,$fecha],0);
}

function busca_tel($id){
	$consulta = "select * from telefonos where id_usuario=?;";
	return ejecuta($consulta, [$id],0);
}

function bAppHorario($us,$app){
	$consulta = "select * from acceso where id_usuario=? and id_aplicacion=?";
	return ejecuta($consulta, [$us,$app],0);
}
?>
