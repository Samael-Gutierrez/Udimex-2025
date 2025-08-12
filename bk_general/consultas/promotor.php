<?php
function b_us_ins($prom){
	$consulta="
		select a.id_usuario, a.inscripcion, a.colegiatura, a.certificado, p.cantidad, p.f_pago, p.concepto, u.nombre
		from alumno as a, pago as p, usuario as u
		where p.id_usuario=a.id_usuario
		and a.id_promotor=$prom
		and a.id_usuario=u.id_usuario
		order by a.id_usuario desc, p.f_pago asc";
	return completa($consulta);
}

function b_pago($prom,$edo){
	$consulta="SELECT e.id_egreso, e.cantidad, c.f_sol, c.f_at, c.cta
		FROM conta_egreso as e, conta_comision as c
		where c.id_usuario=$prom
		and c.id_egreso=e.id_egreso
		and e.estado=$edo order by c.f_at desc";
	return completa($consulta);
}


function el_sol($id){
	$consulta="delete from conta_comision where id_egreso=$id";
	completa($consulta);
}

function el_egreso($id){
	$consulta="delete from conta_egreso where id_egreso=$id";
	completa($consulta);
}

function g_sol($us,$eg,$cta){
	$fe=date('Y-m-d');
	$consulta="insert into conta_comision(f_sol, cta, id_usuario, id_egreso) values('$fe','$cta',$us,$eg)";
	echo $consulta;
	return completa2($consulta);
}

function b_comision($id){
	$consulta="
		select c.* 
		from comision as c, alumno as a
		where a.id_usuario=$id
		and a.id_comision=c.id_comision";
	return completa($consulta);
}



function b_promotor(){
	$consulta="select * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario order by nombre;";
	return completa($consulta);
}	

function b_promotor1($id){
	$consulta="select * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario and a.id_usuario=$id;";
	 //echo $consulta;
	 return completa($consulta);
}
function b_prom($id){
	$consulta="select * from acceso as a,usuario as u where a.id_app=10 and a.id_usuario=u.id_usuario and a.id_usuario=$id;";
	return completa($consulta);
}

function b_liga($us){
	$consulta="select * from liga where id_usuario=$us;";
	return completa($consulta);
}

function b_liga2($id){
	$consulta="select * from liga where id_liga=$id;";
	return completa($consulta);
}

function b_promocion(){
	$consulta="select * from promocion where estado>0;";
	return completa($consulta);
}

function b_promocion2($id){
	$consulta="select * from promocion where id_promocion=$id;";
	return completa($consulta);
}


function busca_bono($id){
    $consulta="select * from promotor_bono where id_usuario=$id and estado=1";
	return completa($consulta);
}

?>
