<?php
function guarda_horario($id,$dia,$hora,$celda){
	$consulta = "insert into horario values('',?,?,?,?)";
    ejecuta($consulta, [$id,$dia,$hora,$celda],0);
}

function busca_horario($profesor){
	$consulta="SELECT * 
	FROM periodo_anio as pa, materia_profesor as mp, horario as h
	WHERE pa.estado=1
	and pa.id_pa=mp.id_pa
	and mp.id_mp=h.id_mp
	and mp.id_profesor=?";
    return ejecuta($consulta, [$profesor],0);
}


?>