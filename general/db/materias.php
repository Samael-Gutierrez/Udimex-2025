<?php
function g_calificacion($calif,$tema,$us){
	$fe = date('Y-m-d');
	$consulta="INSERT INTO calificacion(valor, fecha_registro, id_materia, id_alumno) VALUES(?, ?, ?, ?);";
	return ejecuta($consulta, [$calif,$fe,$tema,$us], 1);
}

function b_calificacion($us,$mat,$sub,$tema){
	$consulta="select count(*) as r  
	from calificacion as c,tema as t,material as m  where c.id_alumno=? and c.id_materia=? 
	and m.id_material=? and t.id_tema=c.id_materia and t.id_materia=?";
	return ejecuta($consulta,[$us,$tema,$sub,$mat],0);
}

function b_calificacion2($us){
	$consulta="select * from calificacion where id_alumno=?";
	return ejecuta($consulta,[$us],0);
}

//busca calificación por tema
function b_cal2($us){
	$consulta="SELECT * FROM calificacion as c, tema as t WHERE c.id_materia=t.id_tema and c.id_alumno=?";
	return ejecuta($consulta,[$us],0);
}

function c_cal($us){
	$consulta="SELECT COUNT(c.id_calificacion) as num
	FROM calificacion AS c 
	JOIN tema AS t ON c.id_materia = t.id_tema 
	WHERE c.id_alumno = ?;";
	return ejecuta($consulta,[$us],0);
}

//busca calificación por materia
function b_cal3($us){
	$consulta="SELECT * FROM calificacion as c, materia as m WHERE c.id_materia=m.id_materia and c.id_alumno=?;";
	return ejecuta($consulta,[$us],0);
}

function b_materias($carrera){
	$consulta="select m.nombre, m.id_materia, d.semestre 
	from materia as m, carrera as c, dmateria as d 
	where m.id_materia=d.id_materia 
	and c.id_carrera=d.id_carrera 
	and c.id_carrera=? 
	order by d.semestre, m.nombre";
	return ejecuta($consulta,[$carrera],0);
}

/*Muestra la carga horaria del alumno*/
function horario($al){
	$consulta="SELECT distinct(am.id_materia) as id, m.nombre, m.tipo, m.id_carrera, m.tipo 
	FROM alumno_materia as am, materia as m where am.id_alumno=? and am.id_materia=m.id_materia";
	return ejecuta($consulta,[$al],0);
}

/*Obtiene materias por id*/
function b_mat_al($us,$mat){
	$consulta="SELECT distinct(am.id_materia), m.nombre
		FROM materia as m, alumno_materia as am
		where am.id_materia=m.id_materia
		and am.id_alumno=?
		and m.id_materia=?";
	return ejecuta($consulta,[$us,$mat],0);
}


function b_ord($mat,$tabla, $al){
	$consulta="SELECT o.*, ml.subtitulo, t.titulo, t.modulo, t.id_tema
	FROM $tabla as o, material as ml, tema as t
	WHERE o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema
	and t.id_materia=?
	and o.id_alumno=?
	order by t.modulo, o.id_orden";
	return ejecuta($consulta,[$mat,$al],0);
}

function b_ord2($mat){
	$consulta="SELECT o.*, ml.subtitulo, t.titulo, t.modulo, t.id_tema
	FROM orden as o, material as ml, tema as t
	WHERE o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema
	and t.id_materia=?
	order by t.modulo, o.id_orden";
	return ejecuta($consulta,[$mat],0);
}

/*Actualiza el orden de un tema*/
function act_ord($viejo,$nuevo){
	$consulta="update orden set id_orden=? where id_orden=?";
	return ejecuta($consulta,[$nuevo,$viejo],0);
}


function g_raiz($id,$alumno){
	echo "Consulta repetida, reemplazar por g_orden_alumno";
}

//se agregó edo, si causa error, mandar por default con 0
function g_orden_alumno($al,$material){
	$fecha=date('Y-m-d H:i:s');
	$consulta="INSERT INTO orden_alumno VALUES (NULL, ?, ?, ?);";
	return ejecuta($consulta,[$material,$al,$fecha],0);
}


//busca el id_orden de un material
function b_orden($ml){
	$consulta="SELECT * from orden where id_material=?";
	return ejecuta($consulta,[$ml],0);
}

/*Busca un tema raíz*/
function b_raiz($mat, $otro){
	$consulta="SELECT min(id_orden) as raiz, o.id_material
	FROM orden as o, material as ml, tema as t 
	where o.id_material=ml.id_material 
	and ml.id_tema=t.id_tema 
	and t.id_materia=?
	and o.id_orden>?";
	return ejecuta($consulta,[$mat,$otro],0);
}

function b_raiz2($id,$id_alumno){
	$consulta="SELECT count(id_material) as r from orden_alumno where id_alumno=? and id_material=?";
	return ejecuta($consulta,[$id_alumno,$id],0);
}

function b_orden_alumno($al,$material){
	$consulta="SELECT * from orden_alumno where id_alumno=? and id_material=?";
	return ejecuta($consulta,[$al,$material],0);
}

function b_ant_sig($mat,$cd,$or,$al){
	$consulta="SELECT o.id_orden
	FROM orden_alumno as o, material as ml, tema as t 
	where o.id_material=ml.id_material 
	and t.id_tema=ml.id_tema 
	and t.id_materia=?
	and o.id_alumno=? $cd
	order by o.id_orden $or
	limit 1";
	return ejecuta($consulta,[$mat,$al],0);
}

function b_materia($id){
	$consulta="SELECT m.*, d.semestre 
	FROM materia as m, dmateria as d 
	WHERE m.id_materia=d.id_materia
	and m.id_materia=?";
	return ejecuta($consulta,[$id],0);
}

function b_materia2($id){
	$consulta="SELECT * FROM dmateria as d where id_materia=?";
	return ejecuta($consulta,[$id],0);
}

function b_tem_prof($mat,$prof){
	$consulta="SELECT id_tema, modulo, titulo
	FROM tema WHERE id_materia=? and id_profesor=? order by modulo";
	return ejecuta($consulta,[$mat,$prof],0);
}

//Busca el contenido de un tema
function curso_muestra($tema){
	$consulta= "SELECT id_material, subtitulo
	FROM material where id_tema=$tema order by id_material";
	return ejecuta($consulta,[$tema],0);
}

function mat_ord($id){
	$consulta="select * from orden where id_material=?";
	return ejecuta($consulta,[$id],0);
}

function b_contenido($apunte){
	$consulta="SELECT nombre, titulo, subtitulo, modulo, m.id_materia, t.id_tema
	FROM material ap
	INNER JOIN tema t ON ap.id_tema = t.id_tema
	INNER JOIN materia m ON t.id_materia = m.id_materia
	WHERE ap.id_material = ?;";
	return ejecuta($consulta,[$apunte],0);	
}

function g_almat($al,$mat){
	$consulta="INSERT INTO alumno_materia VALUES (NULL, 1, ?, ?);";
	ejecuta($consulta,[$al,$mat],0);
}

function q_almat($al){
	$consulta="delete from alumno_materia where id_alumno=? and not (id_materia=1)";
	ejecuta($consulta,[$al],0);
}

/*Guarda una materia nueva*/
function g_mat($car,$nom,$dur,$tip,$sem,$ba){
	$consulta="INSERT into materia values (NULL,?,0,?,?,?)";
	$mat=ejecuta($consulta,[$nom,$dur,$tip,$car],1);

	$consulta="INSERT into dmateria values(NULL,?,?,?)";
	ejecuta($consulta,[$sem,$ba,$mat],0);
}

function m_vacio(){
	$consulta="SELECT id_material FROM material WHERE subtitulo='' and contenido='' limit 1";
	return ejecuta($consulta,[],0);
}

function t_vacio(){
	$consulta="SELECT id_tema FROM tema where id_tema not in (Select id_tema from material) limit 1";
	return ejecuta($consulta,[],0);
}

/*Guarda tema nuevo*/
function g_tema($mat,$mod,$tit,$prof){
	$consulta="insert into tema values(NULL,?,?,?,?)";
	return ejecuta($consulta,[$mod,$tit,$mat,$prof],1);
}


/*Actualiza materia existente*/
function a_mat($mat,$car,$nom,$dur,$tip,$sem,$ba){
	$consulta="update materia set nombre=?, duracion=?, tipo=?, id_carrera=? where id_materia=?";
	ejecuta($consulta,[$nom,$dur,$tip,$car,$mat],0);

	$consulta="select count(id_dmateria) as r from dmateria where id_materia=?";
	$datos=ejecuta($consulta,[$mat],0);
	$fila=mysqli_fetch_assoc($datos);
		
	if ($fila['r']==0){
		$consulta="insert into dmateria values ('',?,?,?)";
	}
	else{
		$consulta="update dmateria set semestre=?, id_carrera=? where id_materia=?";
	}
		
	ejecuta($consulta,[$sem,$ba,$mat],0);
}

function n_mat($tema){
	$consulta="insert into material values('','','',?)";
	return ejecuta($consulta,[$tema],1);
}

/*Guarda el orden de un tema*/
function g_ord($id){
	$consulta="insert into orden values('',?,2)";
	return ejecuta($consulta,[$id],0);
}

function atc_mat($id, $tema){
	$consulta="update material set id_tema=? where id_material=?";
	ejecuta($consulta,[$tema,$id], 0);
}


//Actualizael contenido de un tema
function act_cont($id,$sub,$cont,$tema){
	$consulta="update material set subtitulo=?, contenido=?, id_tema=? where id_material=?";
	ejecuta($consulta,[$sub,$cont,$tema,$id],0);
}

function g_act($aral,$dent){
	$consulta="insert into material_actividad values(?,?)";
	ejecuta($consulta,[$aral,$dent],0);
}

function e_act($aral){
	$consulta="delete from material_actividad where id_mat_ac=?";
	ejecuta($consulta,[$aral],0);
}

function q_matgr($grupo){
	$consulta="delete from materia_grupo where id_grupo=?";
	ejecuta($consulta,[$grupo],0);
}

function q_matgr2($grupo, $mat){
	$consulta="delete from materia_grupo where id_grupo=? and id_materia=?";
	ejecuta($consulta,[$grupo,$mat],0);
}

//Se agregó el id_de profesor
function ag_matgr($gr,$mat){
	$consulta="insert into materia_grupo values('',?,?,1)";
	ejecuta($consulta,[$mat,$gr],0);
}

function max_apunte(){
	$consulta="select max(id_apunte) as m from apunte";
	return ejecuta($consulta,[],0);
}

function busca_material($id){
	$consulta="select * from material where id_material>? order by id_material limit 1";
	return ejecuta($consulta,[$id],0);
}

function guarda_apunte($id,$sub,$tema){
	$consulta="insert into apunte values(?,?,?)";
	ejecuta($consulta,[$id,$sub,$tema],0);	
}

function busca_indice_alumno($al,$mat){
	$consulta="select * from alumno_indice where id_alumno=? and id_materia=?";
	return ejecuta($consulta,[$al,$mat],0);
}


function busca_fecha_mat($mat){
	$consulta="SELECT max(fecha) as r FROM tema WHERE id_materia = ?";
	return ejecuta($consulta,[$mat],0);
}
?>