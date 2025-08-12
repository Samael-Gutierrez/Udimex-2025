<?php
/*function b_usu($us){
	$consulta="select * from usuario where id_usuario=$us";
	echo $consulta;
	return completa($consulta);
}*/
function b_prom($id){
	$consulta="select * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario and a.id_usuario=$id;";
	
	return completa($consulta);
}
function guarda_uprospecto($nom,$apepa,$apema){
	$consulta="insert into usuario values('','','','$nom','$apepa','$apema','','default.png','',0,1)";
	
	return completa2($consulta);
}

function guarda_prospecto($id,$liga,$ins,$cm,$ccer,$mo,$carrera,$prom){
	$consulta="insert into prospecto values($id,'$liga',$ins,$cm,$ccer,'$mo','$carrera',$prom)";
	return completa($consulta);

}
function g_pros_seg($id,$est,$obs){
	$fecha2=date('Y-m-d');
	$consulta="insert into prospecto_seguimiento values('',$id,'$fecha2','$est','$obs')";
	
	completa2($consulta);
}

function g_telpros($num,$us){
	$consulta="insert into telefono values('','$num',$us,1)";
	return completa($consulta);
}
function b_dat_pros($id){
	$consulta="select * from prospecto where id_prospecto=$id";
	
	return completa ($consulta);
}
function b_dat_segpros($id){
	$consulta="select * from prospecto_seguimiento where id_usuario=$id";
	return completa($consulta);
}
function b_usu($us){
	$consulta="SELECT nombre, ap_pat, ap_mat
	FROM usuario
	where id_usuario=$us";
	return completa($consulta);
}

//*****busca.php*****
function b_nomb($where){
	$consulta="SELECT u.id_usuario, nombre, ap_pat, ap_mat, t.id_usuario, numero, p.id_prospecto, id_promotor FROM usuario as u, telefono as t, prospecto AS p WHERE nombre like '%$where%' and t.id_usuario=u.id_usuario and p.id_prospecto=u.id_usuario";
	return completa($consulta);
}
function c_prom($cprom){
	$consulta="SELECT u.id_usuario, nombre, ap_pat, ap_mat FROM usuario as u WHERE u.id_usuario=$cprom";
	return completa($consulta);
}

//*****mis_prospectos.php*****
function b_u_pros($id){
	$consulta="select * from prospecto as p, usuario as u, telefono as t WHERE p.id_promotor=$id and p.id_prospecto=u.id_usuario and p.id_prospecto=t.id_usuario";
	
	return completa($consulta);

}
function ult_seg($id){
	$consulta="SELECT * FROM `prospecto_seguimiento` WHERE id_usuario=$id ORDER BY id_seguimiento DESC LIMIT 1";
	
	return completa($consulta);
}
//*****historial.php*****
function m_obs($id){
	$consulta="SELECT * FROM `prospecto_seguimiento` WHERE id_usuario=$id ";

	return completa($consulta);
}
//*****editar_funcion.php*****
function mod($id,$est,$obs){
	$fecha2=date('Y-m-d');
	$consulta="insert into prospecto_seguimiento values('',$id,'$fecha2','$est','$obs')";
	echo $consulta;
	return completa2($consulta);

}


?>

