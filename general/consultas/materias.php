<?php
function g_calificacion($calif,$tema,$us){
    $fe=date('Y-m-d');
	$consulta="insert into calificacion values('',$calif, '$fe', $tema,$us)";
	return completa2($consulta);

}

function b_calificacion($us,$mat,$sub,$tema){
	$consulta="select count(*) as r  from calificacion as c,tema as t,material as m  where c.id_alumno=$us and c.id_materia=$tema 
	and m.id_material=$sub and t.id_tema=c.id_materia and t.id_materia=$mat";
	return completa($consulta);
}
function b_calificacion2($us){
	$consulta="select * from calificacion where id_alumno=$us";
	return completa ($consulta);
}


//busca calificación por tema
function b_cal2($us){
	$consulta="SELECT * FROM calificacion as c, tema as t WHERE c.id_materia=t.id_tema and c.id_alumno=$us;";
	return completa($consulta);
}
function c_cal($us){
	$consulta="
SELECT COUNT(c.id_calificacion) as num
FROM calificacion AS c 
JOIN tema AS t ON c.id_materia = t.id_tema 
WHERE c.id_alumno = $us;";
return completa($consulta);
}

//busca calificación por materia
function b_cal3($us){
	$consulta="SELECT * FROM calificacion as c, materia as m WHERE c.id_materia=m.id_materia and c.id_alumno=$us;";
	return completa($consulta);
}

/* Busca las respuestas de un custionario */
//SE MOVIO A CUESTIONARIO
/*function evalua($res){
*/



/*Buscar materias de una carrera
admin/materias/index.php*/

function b_materias($carrera){
	$consulta="select m.nombre, m.id_materia, d.semestre 
	from materia as m, carrera as c, dmateria as d 
	where m.id_materia=d.id_materia 
	and c.id_carrera=d.id_carrera 
	and c.id_carrera=$carrera 
	order by d.semestre, m.nombre";


	return completa($consulta);

}




/*Muestra la carga horaria del alumno*/
function horario($al){
	$consulta="SELECT distinct(am.id_materia) as id, m.nombre, m.tipo, m.id_carrera, m.tipo FROM alumno_materia as am, materia as m where am.id_alumno=$al and am.id_materia=m.id_materia";
	return completa($consulta);
}

/*Obtiene materias por id*/
function b_mat_al($us,$mat){
	$consulta="SELECT distinct(am.id_materia), m.nombre
		FROM materia as m, alumno_materia as am
		where am.id_materia=m.id_materia
		and am.id_alumno=$us
		and m.id_materia=$mat";
	return completa($consulta);
}


function b_ord($mat,$tabla, $al){
	$consulta="SELECT o.*, ml.subtitulo, t.titulo, t.modulo, t.id_tema
	FROM $tabla as o, material as ml, tema as t
	WHERE o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema
	and t.id_materia=$mat
	and o.id_alumno=$al
	order by t.modulo, ml.id_material";
	return completa($consulta);
}

function b_ord2($mat){
	$consulta="SELECT o.*, ml.subtitulo, t.titulo, t.modulo, t.id_tema
	FROM orden as o, material as ml, tema as t
	WHERE o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema
	and t.id_materia=$mat
	order by t.modulo, o.id_orden";
	return completa($consulta);
}

/*Actualiza el orden de un tema*/
function act_ord($viejo,$nuevo){
	$consulta="update orden set id_orden=$nuevo where id_orden=$viejo";
	return completa($consulta);
}

/*Guarda un tema raíz*/
function g_raiz($id,$alumno){
	$consulta="insert into orden_alumno values('',$id,$alumno,0)";
	return completa($consulta);
}

//busca el id_orden de un material
function b_orden($ml){
	$consulta="SELECT * from orden where id_material=$ml";
	return completa($consulta);
}

/*Busca un tema raíz*/
function b_raiz($mat, $otro){
	$consulta="SELECT min(id_orden) as raiz, o.id_material
	FROM orden as o, material as ml, tema as t 
	where o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema 
	and t.id_materia=$mat
	and o.id_orden>$otro";
	return completa($consulta);
}

/*Busca una raiz existente*/
function b_raiz2($id,$id_alumno){
	$consulta="SELECT count(id_material) as r from orden_alumno where id_alumno=$id_alumno and id_material=$id";
	return completa($consulta);
}


function b_ant_sig($mat,$cd,$or,$al){
	$consulta="SELECT o.id_orden
	FROM orden_alumno as o, material as ml, tema as t 
	where o.id_material=ml.id_material 
	and t.id_tema=ml.id_tema 
	and t.id_materia=$mat
	and o.id_alumno=$al
	$cd 
	order by o.id_orden $or 
	limit 1";
	return completa($consulta);
}

function b_materia($id){
	$consulta="SELECT m.*, d.semestre 
	FROM materia as m, dmateria as d 
	WHERE m.id_materia=d.id_materia
	and m.id_materia=$id";
	return completa($consulta);
}

function b_materia2($id){
	$consulta="SELECT * FROM dmateria as d where id_materia=$id";
	return completa($consulta);
}

function b_tem_prof($mat,$prof){
	$consulta="SELECT id_tema, modulo, titulo
	FROM tema WHERE id_materia=$mat and id_profesor=$prof order by modulo";
	return completa($consulta);
}

//Busca el contenido de un tema
function curso_muestra($tema){
	$consulta= "SELECT id_material, subtitulo
	FROM material where id_tema=$tema order by id_material";
	return completa($consulta);
}

function mat_ord($id){
	$consulta="select * from orden where id_material=$id";
	return completa($consulta);
}




/*Obtiene el material de estudio por id*/
//Checar conlicto entre id_orden y id_material
//Error aparentemente corregido, se mantienen comentarios para verificar
function b_contenido($id,$tabla){
	if ($tabla=="orden"){
		$cam="o.id_material";
	}
	else{
		$cam="o.id_orden";
	}
	$consulta="SELECT subtitulo,contenido,modulo,titulo,nombre, t.id_tema, mat.id_materia,  m.id_material as apunte
	FROM material as m, tema as t, materia as mat, $tabla as o 
	WHERE o.id_material=m.id_material 
	and m.id_tema=t.id_tema 
	and t.id_materia=mat.id_materia 
	and $cam=$id";
	return completa($consulta);
	
}

function g_almat($al,$mat){
	$consulta="INSERT INTO alumno_materia VALUES ('', 1, $al, $mat);";
	completa($consulta);
}

function q_almat($al){
	$consulta="delete from alumno_materia where id_alumno=$al and not (id_materia=1)";
	completa($consulta);
}

function g_ordi($al,$material){
	$consulta="INSERT INTO orden_alumno VALUES ('', $material, $al, 0);";
	completa($consulta);
}




/*Guarda una materia nueva*/
function g_mat($car,$nom,$dur,$tip,$sem,$ba){
	$consulta="insert into materia values ('','$nom',0,$dur,'$tip',$car)";
	$mat=completa2($consulta);

	$consulta="insert into dmateria values ('',$sem,$ba,$mat)";
	completa($consulta);
}

function m_vacio(){
	$consulta="SELECT id_material FROM material WHERE subtitulo='' and contenido='' limit 1";
	return completa($consulta);
}

function t_vacio(){
	$consulta="SELECT id_tema FROM tema where id_tema not in (Select id_tema from material) limit 1";
	return completa($consulta);
}

/*Guarda tema nuevo*/
function g_tema($mat,$mod,$tit,$prof){
	$consulta="insert into tema values('',$mod,'$tit',$mat,$prof)";
	return completa2($consulta);
}


/*Actualiza materia existente*/
function a_mat($mat,$car,$nom,$dur,$tip,$sem,$ba){
	$consulta="update materia set nombre='$nom', duracion=$dur, tipo='$tip', id_carrera=$car where id_materia=$mat";
	completa($consulta);
	//if ($car==1 or $car==4){
		$consulta="select count(id_dmateria) as r from dmateria where id_materia=$mat";
		$datos=completa($consulta);
		$fila=mysqli_fetch_assoc($datos);
		
		if ($fila['r']==0){
			$consulta="insert into dmateria values ('',$sem,$ba,$mat)";
		}
		else{
			$consulta="update dmateria set semestre=$sem, id_carrera=$ba where id_materia=$mat";
		}
		

		completa($consulta);
	//}
}

function n_mat($tema){
	$consulta="insert into material values('','','',$tema)";
	return completa2($consulta);
}

/*Guarda el orden de un tema*/
function g_ord($id){
	$consulta="insert into orden values('',$id,2)";
	return completa($consulta);
}

function atc_mat($id, $tema){
	$consulta="update material set id_tema=$tema where id_material=$id";
	completa($consulta);
}


//Actualizael contenido de un tema
function act_cont($id,$sub,$cont,$tema){
	$consulta="update material set subtitulo='$sub', contenido='$cont', id_tema=$tema where id_material=$id";
	echo $consulta;
	completa($consulta);
}


function g_act($aral,$dent){
	$consulta="insert into material_actividad values($aral,$dent)";
	completa($consulta);
}

function e_act($aral){
	$consulta="delete from material_actividad where id_mat_ac=$aral";
	completa($consulta);
}

function q_matgr($grupo){
	$consulta="delete from materia_grupo where id_grupo=$grupo";
	completa($consulta);
}

function q_matgr2($grupo, $mat){
	$consulta="delete from materia_grupo where id_grupo=$grupo and id_materia=$mat";
	completa($consulta);
}

//Se agregó el id_de profesor
function ag_matgr($gr,$mat){
	$consulta="insert into materia_grupo values('',$mat,$gr,1)";
	completa($consulta);
}

function max_apunte(){
	$consulta="select max(id_apunte) as m from apunte";
	return completa($consulta);
}

function busca_material($id){
	$consulta="select * from material where id_material>$id order by id_material limit 1";
	return completa($consulta);
}

function guarda_apunte($id,$sub,$tema){
	$consulta="insert into apunte values($id,'$sub',$tema)";
	completa($consulta);	
}

?>
