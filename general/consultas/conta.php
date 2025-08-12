<?php

function b_sobres($fi,$ff){
	$consulta = "SELECT * FROM sobrecargo WHERE fecha_pago BETWEEN '$fi' and '$ff' and cantidad>1";
	return completa($consulta);
}

function getNameById($id){
	$consulta = "SELECT u.nombre, u.ap_pat FROM alumno AS a, usuario AS u WHERE a.id_usuario= $id AND a.id_usuario = u.id_usuario";
	return completa($consulta);
}

function b_ing($fi,$ff){
	$consulta="SELECT SUM(cantidad) as res FROM `pago` WHERE f_pago BETWEEN '$fi' and '$ff' and cantidad>1";
	return completa($consulta);
}

function b_sobrecargos($fi,$ff){
	$consulta = "SELECT SUM(cantidad) as total FROM sobrecargo WHERE fecha_pago BETWEEN '$fi' and '$ff' and cantidad>1";
	return completa($consulta);
}

function b_eg($fi,$ff,$edo){
	$consulta="SELECT SUM(cantidad) as res FROM conta_egreso WHERE fecha BETWEEN '$fi' and '$ff' and estado=$edo";
	return completa($consulta);
}

/*function g_egreso($cant,$desc,$fecha,$tp){
	$consulta="insert into conta_egreso values('','$desc',$cant,'$fecha',$tp)";
	completa($consulta);
}*/


//busca los egresos comprendidos en una fecha especificada
function b_egresos($fi,$ff,$edo){
	$consulta="SELECT * FROM conta_egreso where fecha BETWEEN '$fi' and '$ff' and estado=$edo order by fecha";
	return completa($consulta);
}
function b_ingresos($fi,$ff,$id_usuario){
	$consulta="SELECT * FROM `pago` WHERE f_pago BETWEEN '$fi' and '$ff' and cantidad>1";
	return completa($consulta);
}

function g_egreso($conc,$cant,$fecha,$edo){
	if ($fecha==''){
		$fecha=date('Y-m-d');
	}
	$consulta="insert into conta_egreso values('','$conc',$cant,'$fecha',$edo)";
	return completa2($consulta);
}
function g_ingreso1($cant1,$fecha1,$descu){
	if ($fecha1==''){
		$fecha1=date('Y-m-d');
	}
	$consulta="insert into pago values('',$cant1,'$fecha1','','$descu',0)";
	echo $consulta;
	return completa($consulta);
}



?>
