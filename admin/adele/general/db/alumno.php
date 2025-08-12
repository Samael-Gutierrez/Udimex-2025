<?php
function guarda_alumno($id,$mat,$carrera){
	$consulta = "insert into alumno values(?,?,?,1)";
    ejecuta($consulta, [$id,$mat,$carrera],0);
}

function busca_alumno($mat){
	$consulta = "select * from alumno where matricula=?";
    return ejecuta($consulta, [$mat],0);
}

?>
