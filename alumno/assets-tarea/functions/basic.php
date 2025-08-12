<?php

include("../../../general/consultas/conecta.php");

/* Completa las consultas*/
function completa($consulta){
	$base=abrir();
	$r=mysqli_query($base,$consulta);
	mysqli_close($base);
	return $r;
}

?>