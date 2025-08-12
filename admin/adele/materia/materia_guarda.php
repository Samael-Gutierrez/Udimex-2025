<?php
session_start();
include('../general/db/conecta.php');
include('../general/db/materia.php');

	$materia=trim($_POST['materia']);
	
	if(strlen($materia)>0){
		$datos=busca_materia($materia);
		if($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['id_materia'];
		}
		else{
			$id=guarda_materia($materia);
		}
		
		//Revisa si la materia ya existe en la carrera
		$datos=busca_materia_carrera($id,$_POST['carrera'],$_POST['cuatri']);
		if($fila=mysqli_fetch_assoc($datos)){
			$mc=$fila['id_mc'];
		}
		else{
			$mc=guarda_materia_carrera($id,$_POST['carrera'],$_POST['cuatri']);
		}
		
		$datos=busca_materia_profesor($mc,$_SESSION['id'],$_SESSION['periodo']);
		if ($fila=mysqli_fetch_assoc($datos)){
			
		}
		else{
			guarda_materia_profesor($mc,$_SESSION['id'],$_SESSION['periodo']);
		}
		

	}
	
header('location: index.php');
?>