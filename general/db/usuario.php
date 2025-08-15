<?php

function b_ad(){
	$consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso AS a, usuario AS u WHERE a.id_usuario = u.id_usuario ORDER BY u.nombre";
	return ejecuta($consulta, [], 0);
}

/*Agrega usuario nuevo*/
function usuario_nuevo($us, $clave, $nom, $ap, $am, $mail, $ecl){
	//$fr=date("Y-m-d");
	//$consulta="INSERT into usuario values('','$us','$clave','$nom','$ap','$am','default.png','$mail',$ecl,1)";
	//return ejecuta($consulta,1);
	echo "Verifica consulta, la consulta está duplicada, cambiar por guarda_usuario";
}

function guarda_usuario($usuario,$clave,$nom,$apepa,$apema,$fechaden,$correoele){
	$consulta="INSERT INTO usuario VALUES(NULL, ?, ?, ?, ?, ?, ?,'default.png', ?, 0, 1, 4)";
	return ejecuta($consulta,[$usuario, $clave, $nom, $apepa, $apema, $fechaden, $correoele], 1);
}

function b_us($us){
	$consulta="SELECT * from usuario WHERE id_usuario=?";
	return ejecuta($consulta, [$us], 0);
}

function a_correo($us,$correo){
	$consulta="UPDATE usuario set correo=? where id_usuario=?";
	ejecuta($consulta, [$correo, $us], 0);
}


function guarda_domicilio($id,$esdo,$muni,$colo,$cp,$calle,$numer){
	$consulta="INSERT into domicilio values(NULL, ?, ?, ?, ?, ?, ?, ?)";
	ejecuta($consulta, [$calle, $colo, $numer, $muni, $esdo, $cp, $id], 0);
}

function b_dom($cp,$dato){
	$consulta="SELECT distinct($dato) as r from domicilio where cp=?";
	return ejecuta($consulta, [$cp], 0);
}

function busca_domicilio($id){
	$consulta="SELECT * from domicilio where id_usuario=?";
	return ejecuta($consulta, [$id], 0);
}


/*bUSCA SI EXISTE UN TELÉFONO*/
function busca_tel($tel){
	$consulta="SELECT * from telefono where numero like ?";
	return ejecuta($consulta, [$tel], 0);
}

/*bUSCA SI EXISTE UN TELÉFONO*/
function busca_tel2($us){
	$consulta="SELECT * from telefono where id_usuario=?";
	return ejecuta($consulta, [$us], 0);
}

function g_tel($num,$us){
	$consulta="INSERT into telefono values(NULL, ?, ?, 1)";
	return ejecuta($consulta, [$num, $us], 0);
}
function g_tel2($num,$us){
	$consulta="INSERT into telefono values(NULL, ?, ?, 1)";
	return ejecuta($consulta, [$num, $us], 0);
}
	
function e_tel($us){
	$consulta="DELETE from telefono where id_usuario=?";
	ejecuta($consulta, [$us], 0);
}

//ELIMINAR CONSULTA
function guarda_telefono($telefono,$id){
	echo "Consulta repetida, cambiar por g_tel";
}

//ELIMINAR CONSULTA
function guarda_telefono2($telefonop,$idt){
	echo "Consulta repetida, cambiar por g_tel";
}

function b_us2($usuario){
	$consulta="SELECT count(*) as r from usuario where usuario=?";
	return ejecuta($consulta, [$usuario], 0);
}

function usuario_app($app){
    $consulta="SELECT * FROM app, acceso as a WHERE app.id_app=? and app.id_app=a.id_app;";
    return ejecuta($consulta, [$app], 0);
}
?>