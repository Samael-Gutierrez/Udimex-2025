<?php
	include("../consultas.php");
	$campos=$_POST['total'];
	$pago=$_POST['id_pago'];
	if($campos>0){
		for($i=1;$i<=$campos;$i++){
			if (isset($_POST['c'.$i])){
				temas_semana($pago,$_POST['c'.$i]);
			}
		}
		echo "El pago se ha activado correctamente <a href='ver_alumno.php'>Regresar</a>";
	}
?>
