<?php

//**************************************
//******           BITACORA       ******
//**************************************

/*Registra en la bitácora*/

//function bitacora($us,$ac){
// Se movió a basic.php

//**************************************
//******           LIBROS       ******
//**************************************
function g_comentario($nom, $lug, $com){
	$consulta="insert into seguimiento (nombre, lugar, coment) values('$nom', '$lug', '$com')";
	return completa2($consulta);
}

function b_comentario($id_libro){
	$consulta="select * from libro_seg as ls,seguimiento as seg WHERE id_libro=$id_libro AND ls.id_seg=seg.id_seg";
	return completa($consulta);
}

function g_libcom($lib, $seg){
	$consulta="insert into libro_seg (id_libro, id_seg) values($lib, $seg)";
	completa($consulta);
}


//**************************************
//******           USUARIO        ******
//**************************************

//busca la colegiatura de un alumno
//function colegiatura($us){
//se movio a consultas/pago.php

//busca usuario por id
function b_us($us){
	$consulta="SELECT nombre, ap_pat, ap_mat
	FROM usuario
	where id_usuario=$us";
	return completa($consulta);
}



/*Comprueba si existe un usuario*/
function b_correo($correo){
	$base=abrir();
	$r=mysqli_query($base,"SELECT count(correo) as cuenta FROM usuario where correo like '$correo'");	
	mysqli_close($base);
	return $r;
}



/*Agrega usuario nuevo*/
//function usuario_nuevo($pas1,$nom,$ap,$am,$mail,$bach,$esc){
//se movio usuario.php



/*Inicia sesi&oacute;n*/
/*function sesion_inicio($us,$pas,$tabla){
	$consulta="
		SELECT u.id_usuario, u.nombre, u.ap_pat,u.foto, u.id_escuela, a.id_$tabla FROM $tabla as a, usuario as u
		where u.id_usuario=a.id_usuario
		and u.usuario='$us'
		and u.clave='$pas'";
	return completa($consulta);
	
}
Se cambio de consultas/generales a consultas/admin.php
*/






/*Cambia la clave de un usuario*/
function cambia($nueva,$mail){
	$consulta="update usuario set clave='$nueva' where correo='$mail'";
	completa($consulta);
}

/*elimina petici&oacute;n de cambio*/
function elimina_cam($mail){
	$consulta="delete from evento where nombre like '$mail'";
	completa($consulta);
}





//Actualiza la carrera de un alumno
function act_ba($id,$car){
	$consulta="update alumno set id_carrera=$car where id_usuario=$id";
	completa($consulta);
}



//**************************************
//******           CLASES      ******
//**************************************


/*Busca materias que pertenecen a un pago*/
function b_clase($car){
	$consulta="select * from clase
	where id_carrera=$car";
	return completa($consulta);
}



//**************************************
//******           MATERIAS       ******
//**************************************


/*Guarda una materia nueva*/
//function g_mat($car,$nom,$dur,$tip,$sem,$ba){
//Se movío a materias.php


/*Busca materias que pertenecen a un pago*/
function b_mat_pag($pag){
	$consulta="select pm.id_materia, pm.id_profesor from pago as p, pago_materia as pm
	where p.id_pago=pm.id_pago
	and p.id_pago=$pag";
	return completa($consulta);
}




/*Obtiene materias de tipo general*/
function b_semestre($sem,$tipo){
	$consulta="SELECT m.id_materia, m.nombre, m.tipo, m.duracion
		FROM materia as m, dmateria as d
		WHERE m.id_materia=d.id_materia
		and bachillerato=0
		and d.semestre=$sem".$tipo;
	return completa($consulta);
}

/*Obtiene materias por id*/
//si hay problemas con ceneval o colbach, activar la consulta de abajo
//function b_materia($id){
//se movió a materias.php


/*Obtiene materias por id
function b_materia2($id){
	$consulta="SELECT * FROM materia WHERE id_materia=$id";
	return completa($consulta);
}*/


/*Obtiene materias por id*/
//function b_materia_pago($us,$mat,$pago){
//se cambio a materias.php con el nombre de b_mat_al


/*Obtiene materias por semestre*/
function b_mat($sem,$car){
	$consulta="SELECT * FROM dmateria as d, materia as m where d.id_materia=m.id_materia and d.semestre=$sem and m.id_carrera=$car";
	return completa($consulta);
}

//function b_materia2($id){
//Se movio a materias.php


/*Obtiene todas las materias*/
/*cambiar el orden por una variable*/
function materia_muestra($orden){
	$consulta="SELECT * FROM materia order by $orden";
	return completa($consulta);
}

//Verificar duplicidad de funcion con a_mat
//Actualiza una materia*/
/*function act_mat($mat,$des,$sem,$dura,$id){
	$consulta="update materia set nombre='$mat', descripcion='$des', semestre=$sem, duracion=$dura where id_materia=$id";
	$base=abrir();
	$r=mysqli_query($base,$consulta);

	mysqli_close($base);
	return $r;
}*/
//NO MIGRADA POSIBLE DUPLICADO


/*Actualiza materia existente*/
//function a_mat($mat,$car,$nom,$dur,$tip,$sem,$ba){
// se movió a materias.php





/*Guarda tema nuevo*/
//function g_tema($mat,$mod,$tit,$prof){
//se movió a amaterias.php

/*Actualiza el titulo de un tema*/
function a_tema($mat,$mod,$tit,$prof,$id){
	$consulta="update tema set modulo=$mod, titulo='$tit', id_materia=$mat, id_profesor=$prof where id_tema=$id";
	return completa2($consulta);
}

//Actualizael contenido de un tema
//function act_cont($id,$sub,$cont,$tema){
//se cambió a materias.php


/*Guarda el contenido de un tema*/
/*function g_cont($sub,$cont,$tema){
	$consulta="insert into material values('','$sub','$cont',$tema)";
	completa($consulta);
}*/

/*Obtiene un tema específico*/
function b_tema($id){
	$consulta="SELECT nombre,modulo,titulo
	FROM tema AS t, materia AS m
	WHERE id_tema =$id
	AND m.id_materia = t.id_materia";
	return completa($consulta);
}


/*Obtiene el material de estudio por id*/
//Checar conlicto entre id_orden y id_material
//Error aparentemente corregido, se mantienen comentarios para verificar
//function b_contenido($id,$tabla){
//se movio a materias.php


//Obtiene los temas de una materia
function b_temas($mat){
	$consulta="SELECT id_tema, modulo, titulo
	FROM tema WHERE id_materia=$mat and order by modulo";
	return completa($consulta);
}

//function b_tem_prof($mat,$prof){
//Se movió a materias.php

/*Guarda el pago con su respectiva materia*/
function g_materia($pago,$mat,$prof,$estado){
	$consulta="INSERT INTO pago_materia VALUES ('',$estado,$pago,$mat,$prof)";
	completa($consulta);
	bitacora(0,"PAGO DE MATERIA");
}

//Busca el contenido de un tema
//function curso_muestra($tema){
//Se movió a materias.php



/*Busca el tema siguiente*/
function tema_sig($mat,$tema,$sub){
	$consulta="SELECT MIN( id_material ) AS id, subtitulo, contenido, titulo, nombre, modulo
	FROM material AS m, tema AS t, materia AS ma
	WHERE m.id_material>=$sub
	AND m.id_tema >=$tema
	and ma.id_materia=$mat
	AND t.id_tema = m.id_tema
	AND ma.id_materia = t.id_materia";
	return completa($consulta);
}

/*Busca orden de un tema*/
//function mat_ord($id){
//se movió a materias.php


/*Busca orden de un tema*/
//SE agrego la variable table, checar por si no funciona
//se agrego c_pago, agregar "and o.id_pago=$pagooooooo" en donde no funcione
//function b_ord($mat,$tabla){
//Se cambió a materias.php


//busca el id_orden de un material
//function b_orden($ml){
//se cambió a materias.php


/*Actualiza el orden de un tema*/
function act_ord($viejo,$nuevo){
	$consulta="update orden set id_orden=$nuevo where id_orden=$viejo";
	return completa($consulta);
}

/*Guarda el orden de un tema*/
//function g_ord($id){
//se movio a materias.php


/*Busca el material anterior*/
function b_mat_ant($ant,$id,$mat,$prof){
	$consulta="SELECT t.id_tema,t.titulo,t.modulo,ml.*, o.id_siguiente,o.id_anterior,m.nombre
	from materia as m, tema as t, material as ml, orden_alumno as o
	where m.id_materia=t.id_materia
	and t.id_tema=ml.id_tema
	and ml.id_material=o.id_material
	and m.id_materia=$mat
	and (o.id_anterior=$ant or o.id_material=$id)
	and t.id_profesor=$prof";
	return completa($consulta);
}

//Se movió a materias.php
//function b_ant_sig($mat,$cd,$or,$pago){


/*Busca un tema raíz*/
//function b_raiz($mat, $otro){
//se movió a materias.php



/*Busca una raiz existente*/
/*function b_raiz2($id,$pago){
	$consulta="SELECT count(id_material) as r from orden_alumno where id_pago=$pago and id_material=$id";
	return completa($consulta);
}*/

/*Guarda un tema raíz*/
//function g_raiz($id,$pago){
//se cambió a materias


function b_mor($mat,$pago){
	$consulta="SELECT COUNT(id_material) as r
	from orden_alumno as o, pago_materia as pm
	where pm.id_pago=o.id_pago
	and pm.id_materia=$mat
	and o.id_pago=$pago";
	return completa($consulta);
}

/*Busca el material creado por un profesor*/
function temas_prof($prof,$mat){
	$consulta="select t.id_tema,t.titulo,t.modulo, m.id_materia,m.nombre from profesor as p, tema as t, materia as m 
	where t.id_materia=m.id_materia 
	and t.id_profesor=p.id_profesor
	and t.id_profesor=$prof 
	and m.id_materia=$mat
	order by modulo";
	return completa($consulta);
}


// Obtiene materias para activar por semana
function t_sem($pago,$prof){
	$consulta="select id_tema, titulo 
	from pago as p, pago_materia as pm, materia as m, tema as t
	where t.id_materia=m.id_materia
	and m.id_materia=pm.id_materia
	and pm.id_pago=p.id_pago
	and p.id_pago=$pago
	and t.id_profesor=$prof";
	return completa($consulta);
}

// Obtiene tema ya activado
function b_semana($tema){
	$consulta="select count(id_tema) as total
	from material_semana
	where id_tema=$tema";
	return completa($consulta);
}

// Obtiene plan de estudios de una carrera
function b_plan($id){
	$consulta="select * from materia where id_carrera=$id or id_carrera=0";
	return completa($consulta);
}

//function m_vacio(){
//se movió a materias.php


//function t_vacio(){
//se movió a materias.php

//function n_mat($tema){
//se movió a materias.php


/*function atc_mat($id, $tema){
	$consulta="update material set id_tema=$tema where id_material=$id";
	completa($consulta);
}




//**************************************
//******          PAGOS           ******
//**************************************

/*Busca todos los pagos pendientes*/
function pen_pagos(){
	$consulta="SELECT p.id_pago, p.cantidad, p.fecha_solicitud, p.dias_caducidad, u.usuario, u.clave, u.nombre as alumno, u.ap_pat, u.ap_mat, u.correo, m.nombre as materia, m.semestre 
		FROM pago as p, usuario as u, pago_materia as pm, materia as m 
		WHERE p.tipo=0 
		and p.id_usuario=u.id_usuario 
		and pm.id_pago=p.id_pago 
		and pm.id_materia=m.id_materia order by p.fecha_solicitud desc";
	return completa($consulta);
}

/*Busca tarjeta de pago*/
function b_tarjeta($id){
	$consulta="select * from cuenta where id_cuenta=$id";
	return completa($consulta);
}

/*Registra el pago*/
function r_pago($cant,$al,$dias){
	$fecha=date("Y-m-d");
	$consulta="insert into pago values('',$cant,'$fecha','',$dias,'','',0,$al)";
	$r=completa2($consulta);
	bitacora($al,"REGISTRO DE PAGO");
	return $r;
}

function r_p_cupon($al,$dias,$cad,$cup){
	$fecha=date("Y-m-d");
	$base=abrir();
	mysqli_query($base,"insert into pago values('',0,'$fecha','$fecha',$dias,'$cad','$cup',2,$al)")or die ("El cup&oacute;n que escribiste no existe o ha expirado !!!");
	$r=mysqli_insert_id($base);
	mysqli_close($base);
	return $r;
}


/*Busca el pago no realizado de un alumno*/
//Se cambió consultas/pagos.php
//function b_pago($us){


function fecha($fecha){
	list($d,$m,$a) = explode("-",$fecha);
	return $a."-".$m."-".$d;
}

/*Busca el numero de materias y costo*/
function detalle_pago($pago){
	$consulta="SELECT COUNT( h.id_materia ) AS s_mat
FROM pago_materia AS h, materia AS m
WHERE h.id_pago =$pago
AND h.id_materia = m.id_materia";
	return completa($consulta);
}

function detalle_pago2($pago,$mat){
	$consulta="SELECT COUNT( h.id_materia ) AS s_mat
FROM pago_materia AS h, materia AS m
WHERE h.id_pago =$pago
and h.id_materia=$mat
AND h.id_materia = m.id_materia";
	return completa($consulta);
}


/*Busca el pago ya realizado de un alumno*/
function b_pago2($al){
	$consulta="SELECT *
	FROM pago
	WHERE fecha_pago >= fecha_solicitud
	AND id_usuario=$al 
	order by fecha_pago desc";
	return completa($consulta);
}

/*Borra un pago*/
function pago_borra($pago){
	$consulta="delete from pago where id_pago=$pago";
	completa($consulta);
	bitacora(0,"BORRO PAGO id=$pago");
}

/*Borra las materias corrtespondientes a un pago*/
function pago_mat_borra($pago){
	$base=abrir();
	mysqli_query($base,"delete from pago_materia where id_pago=$pago");
	mysqli_close($base);
}


/*Busca el pago por id */
function b_pago3($pago,$us){
	$consulta="SELECT m.*, duracion * colegiatura AS costo, d.semestre
	FROM pago_materia AS h, materia AS m, usuario AS u, alumno AS a, dmateria as d
	WHERE u.id_usuario = a.id_usuario
	AND h.id_materia = m.id_materia
	AND d.id_materia=m.id_materia
	AND u.id_usuario =$us
	AND id_pago =$pago";
	return completa($consulta);
}

/*Busca el pago por id */
function b_pago5($pago){
	$consulta="SELECT * FROM pago_materia WHERE id_pago=$pago";
	return completa($consulta);
}

function b_pago4($pago){
	$base=abrir();
	$r=mysqli_query($base,"select fecha_solicitud, cantidad, dias_caducidad
	from pago
	where id_pago=$pago");
	mysqli_close($base);
	return $r;
}

//Busca el pago por material de estudio
//function b_pago6($orden){
//Se movió a pagos.php


function act_pag($id,$fp,$fc,$ref,$cant,$tipo){
	$consulta="update pago 
	set fecha_pago='$fp', 
	fecha_caducidad='$fc', 
	referencia=$ref, 
	cantidad=$cant, 
	tipo=$tipo 
	where id_pago=$id";
	completa($consulta);
	act_pag_mat($id);
}

function act_pag_mat($id){
	$consulta="update pago_materia set estado=1 where id_pago=$id";
	completa($consulta);
}



//**************************************
//******       Cuestionarios     ******
//**************************************

/* Busca custionario sobre un tema */
//function cues($tema,$orden){
//se movio a materias.php


/* Busca las respuestas de un custionario */
//function res($preg,$orden){
//se movio a materias.php





/* Busca indice de repasos creados */
function b_rep1($us){
	$consulta="SELECT m.subtitulo, r.id_repaso
	FROM material AS m, repaso AS r
	WHERE m.id_material = r.id_material
	AND r.estado =0
	AND r.id_alumno =$us
	ORDER BY r.id_material ASC";
	return completa($consulta);
}

/* Busca si hay repasos*/
function b_rep2($us){
	$consulta="SELECT count(id_repaso) as cuenta
	FROM repaso
	WHERE estado =0
	AND id_alumno =$us";
	return completa($consulta);
}

/*Busca tema anterior de repaso */
function rep_ant($mat){
	$consulta="SELECT max(id_material) as mat, id_repaso
	FROM repaso
	WHERE id_material<$mat";
	return completa($consulta);
}



/* Guarda preguntas contestadas mal */
function g_rep($us,$mat){
	$base=abrir();
	$r=mysqli_query($base,"select count(id_repaso) as cuenta from repaso where id_material=$mat and id_alumno=$us and estado=0");
	$fila=mysqli_fetch_assoc($r);
	mysqli_free_result($r);

	if($fila['cuenta']<=0){
		mysqli_query($base,"insert into repaso values('',0,$mat,$us)");
	}
	mysqli_close($base);
}


/*Crea una nueva pregunta */

//function g_preg($p,$t){
//se  movió a materias.php


// Guarda la respuesta a una pregunta creada
//function g_res($r,$t,$id){
//se  movió a materias.php

/* Elimina las respuestas de una pregunta
function e_res($id){
	$consulta="delete from respuesta where id_pregunta=$id";
	return completa($consulta);
}

CAMBIADO A CUESTIONARIO
*/

// Elimina una pregunta
function e_preg($id){
	$consulta="delete from cuestionario where id_pregunta=$id";
	return completa($consulta);
}

/* Busca custionario sobre un tema 
function b_preg($id){
	$consulta="select * from cuestionario where id_pregunta=$id";
	return completa($consulta);
}

CAMBIADA A CUESTIONARIO
*/




//**************************************
//******        PROFESOR          ******
//**************************************
/* Selecciona todos los datos de un profe */
function b_profesor($id){
	$consulta="
		SELECT *
		FROM asesor AS a, usuario AS u
		WHERE a.id_usuario = u.id_usuario
		and a.id_asesor=$id";
	return completa($consulta);
}



/* Selecciona todos los profes */
function b_profesores(){
	$consulta="
		SELECT nombre, ap_pat, ap_mat, id_asesor
		FROM asesor AS a, usuario AS u
		WHERE a.id_usuario = u.id_usuario
		order by id_asesor";
	return completa($consulta);
}

/* Selecciona profesor de un grupo */
function b_prof_gru($gr){
	$consulta="
		SELECT nombre, ap_pat
		FROM asesor AS a, usuario AS u, grupo as g
		WHERE a.id_usuario = u.id_usuario
		and g.id_asesor=a.id_asesor
		and g.id_grupo=$gr
		order by nombre";
	return completa($consulta);
}


/* Selecciona los grupos de un profe */
function prof_grupo($id){
	$consulta="
		SELECT nombre, ap_pat, ap_mat, dias, hora_inicio, hora_fin, tipo, g.id_grupo
		FROM usuario AS u, profesor AS a, grupo AS g
		WHERE u.id_usuario = a.id_usuario
		AND g.id_profesor = a.id_profesor
		AND estado =1
		AND a.id_profesor =$id
		order by dias,hora_inicio";
	return completa($consulta);
}

/* Guarda un nuevo profesor */
function asesor_nuevo($nom,$ap,$am,$correo,$tel,$cel,$sexo,$e_civil,$f_na,$calle,$colonia,$numero,$municipio,$cp,$car){
	$base=abrir();
	$fr=date("Y-m-d");

	$r=mysqli_query($base,"SET AUTOCOMMIT=0;");
	$r=mysqli_query($base,"BEGIN;");

	$r=mysqli_query($base,"INSERT into usuario (id_usuario,nombre,ap_pat,ap_mat,correo,tel,cel,sexo,e_civil,f_na,fr,calle,colonia,numero,municipio,cp) 
	values('','$nom','$ap','$am','$correo','$tel','$cel','$sexo','$e_civil','$f_na','$fr','$calle','$colonia','$numero','$municipio','$cp')");
	
	$id=mysqli_insert_id($base);

	$r=mysqli_query($base,"INSERT into asesor 
	values('','$car',$id)");

	if ($r){
		mysqli_query($base,"COMMIT;");
	}
	else{
		mysqli_query($base,"ROLLBACK;");
	}
}

function asigna_prof($mat){
$consulta="select id_profesor
from tema
where id_materia=$mat
order by modulo desc, rand()
limit 1";
return completa($consulta);
}


function busca_prof($ml){
$consulta="select t.id_profesor
from tema as t, material as ml
where t.id_tema=ml.id_tema
and ml.id_material=$ml";
return completa($consulta);
}


//**************************************
//******         GRUPOS           ******
//**************************************
/* Selecciona todos los datos de un grupo */
//grupo() se cambió a consultas/grupo.php

function al_gru($id){
	$consulta="
		SELECT nombre, ap_pat, ap_mat
		FROM grupo AS g, alumno AS a, usuario AS u
		WHERE g.id_grupo = a.id_grupo
		AND u.id_usuario = a.id_usuario
		AND a.estado >0
		AND g.id_grupo =$id";
	return completa($consulta);
}

//function b_grupos(){
//se movió a materias.php


//Se cambió a consultas/grupos.php
//function g_grupo(


//Da de baja un grupo
//Se movió a consultas/grupos.php
//function e_grupo($gr){


//**************************************
//*****           AGENDA           *****
//**************************************

/* Muestra los eventos de la agenda*/
function m_evento($us,$estado){
	$consulta="SELECT * FROM evento where estado=$estado and id_us='$us' order by fecha";
	return completa($consulta);
}

function ev_act($id){
	//$consulta="select fecha from evento where id_evento=$id";
	//$datos=completa($consulta);

	//$fila=mysqli_fetch_assoc($datos);
	//$fe=$fila['fecha'];

	//$fe = strtotime ( '+1 day' , strtotime ( $fe ) ) ;
	//$fe=date('Y-m-d',$fe);
	$fe=date('Y-m-d');
	$consulta="update evento set fecha='$fe' where id_evento=$id";
	completa($consulta);
}

function ev_cump($id,$es){
	$consulta="update evento set estado=$es where id_evento=$id";
	completa($consulta);
}

function ev_guar($tit,$des,$us,$es){
	$fecha=date("Y-m-d");
	$consulta="insert into evento values('','$tit','$des','$fecha','',0,$es,$us)";
	completa($consulta);
}

function ev_rec($cad){
	$fecha=date("Y-m-d");
	$consulta="select * from evento where descripcion='$cad' and fecha='$fecha'";
	return completa($consulta);
}


//**************************************
//*****          CUPONES           *****
//**************************************

/* Guarda un nuevo cup&oacute;n */
function g_cupon($cup,$na,$nd,$ma,$fc,$prof){
	$consulta="insert into cupon values('','$cup',$na,$nd,'$fc',$ma,$prof)";
	completa($consulta);
}

/* Busca todos los cupones de un profesor */
function b_cupon($prof){
	$consulta="select * from cupon where id_profesor=$prof";
	return completa($consulta);
}


/* Busca un cupon usado por un alumno */
function b_cup_al($us,$cup){
	$consulta="SELECT count(*) as ex FROM pago WHERE id_usuario=$us and referencia like '$cup'";
	return completa($consulta);
}

function u_cupon($cup){
	$fecha=date("Y-m-d");
	$consulta="SELECT n_dias,id_materia,id_profesor, n_alumnos 
	FROM cupon
	WHERE f_caducidad>='$fecha'
	and n_alumnos>0
	and n_cupon like '$cup'";
	return completa($consulta);
}

function d_cupon($n_al,$cup){
	$consulta="update cupon set n_alumnos=$n_al
	WHERE n_cupon='$cup'";
	return completa($consulta);
}

function el_cupon(){
	$fecha=date("Y-m-d");
	$consulta="delete from cupon where f_caducidad<'$fecha' or n_alumnos=0";
	return completa($consulta);
}


//b_carrera se cambió a consultas/materias.php



/* Guarda una carrera nueva */
//function g_carrera($nom,$dur,$des,$im,$tp){
//Se movío a carrera


/* Actualiza los datos de una carrera */
function a_carrera($id,$nom,$dur,$des,$im,$tp){
	$consulta="update carrera set nombre='$nom', duracion=$dur, descripcion='$des', imagen='$im', tipo=$tp where id_carrera=$id";
	completa($consulta);
}

/* Busca la carrera de un alumno */
function b_alcar($id){
	$consulta="select id_carrera from alumno where id_usuario=$id";
	return completa($consulta);
}








?>

