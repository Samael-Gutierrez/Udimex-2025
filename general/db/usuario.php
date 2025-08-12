<?php

function b_ad(){
	$consulta="select distinct(a.id_usuario), u.* from acceso as a, usuario as u where a.id_usuario=u.id_usuario order by u.nombre";
	return ejecuta($consulta,[],0);
}

/*Agrega usuario nuevo*/
function usuario_nuevo($us, $clave, $nom, $ap, $am, $mail, $ecl){
	//$fr=date("Y-m-d");
	//$consulta="INSERT into usuario values('','$us','$clave','$nom','$ap','$am','default.png','$mail',$ecl,1)";
	//return ejecuta($consulta,[],1);
	echo "Verifica consulta, la consulta está duplicada, cambiar por guarda_usuario";
}

function guarda_usuario($usuario,$clave,$nom,$apepa,$apema,$fechaden,$correoele){
	$consulta="insert into usuario values('','$usuario','$clave','$nom','$apepa','$apema','$fechaden','default.png','$correoele',0,1,4)";
	return ejecuta($consulta,[],1);
}
function guarda_usuario2($usuario,$clave,$nom,$apepa,$apema,$fechaden,$correoele){
	//$consulta="insert into usuario values('','$usuario','$clave','$nom','$apepa','$apema','$fechaden','default.png','$correoele',0,1)";
	//return ejecuta($consulta,[],1);
	echo "Verifica consulta, la consulta está duplicada, cambiar por guarda_usuario";
}

function b_us($us){
	$consulta="select * from usuario where id_usuario=$us";
	return ejecuta($consulta,[],0);
}

function a_correo($us,$correo){
	$consulta="update usuario set correo='$correo' where id_usuario=$us";
	ejecuta($consulta,[],0);
}


function guarda_domicilio($id,$esdo,$muni,$colo,$cp,$calle,$numer){
	$consulta="insert into domicilio values('','$calle','$colo','$numer','$muni','$esdo','$cp',$id)";
	ejecuta($consulta,[],0);
}

function b_dom($cp,$dato){
	$consulta="select distinct($dato) as r from domicilio where cp=$cp";
	return ejecuta($consulta,[],0);
}

function busca_domicilio($id){
	$consulta="select * from domicilio where id_usuario=$id";
	return ejecuta($consulta,[],0);
}


/*bUSCA SI EXISTE UN TELÉFONO*/
function busca_tel($tel){
	$consulta="select * from telefono where numero like $tel";
	return ejecuta($consulta,[],0);
}

/*bUSCA SI EXISTE UN TELÉFONO*/
function busca_tel2($us){
	$consulta="select * from telefono where id_usuario=$us";
	return ejecuta($consulta,[],0);
}

function g_tel($num,$us){
	$consulta="insert into telefono values('','$num',$us,1)";
	return ejecuta($consulta,[],0);
}
function g_tel2($num,$us){
	$consulta="insert into telefono values('','$num',$us,1)";
	return ejecuta($consulta,[],0);
}
	

	


function e_tel($us){
	$consulta="delete from telefono where id_usuario=$us";
	ejecuta($consulta,[],0);
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
	$consulta="select count(*) as r from usuario where usuario='$usuario'";
	return ejecuta($consulta,[],0);
}


function usuario_app($app){
    $consulta="SELECT * FROM app, acceso as a WHERE app.id_app=? and app.id_app=a.id_app;";
    return ejecuta($consulta,[$app],0);

}

?>
