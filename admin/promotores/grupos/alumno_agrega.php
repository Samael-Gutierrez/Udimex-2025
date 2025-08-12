<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/grupos.php");


//función dupliucada, optimizar cuando sea posible pagos.php
if($_POST){
	//Control de grupo para asignar a grupo
		act_gru($_POST['alumno'],$_POST['grupo']);
		if($_POST['grupo']==0){
			act_es($_POST['alumno'],0, "alumno");
		}
		else{
			act_es($_POST['alumno'],1, "alumno");
			act_es($_POST['alumno'],1, "usuario");
		}
}

$red="location:materia_ver.php?id=".$_POST['grupo'];
header($red);
?>

