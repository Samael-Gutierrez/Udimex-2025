<?php
	session_start();
	include('../general/db/conecta.php');
	include('../general/db/alumno.php');
	include('../general/db/usuario.php');	
	include('../general/db/asistencia.php');	
	
	if($_POST){
		$mat=strtoupper($_POST['mat']);
		$ap=$_POST['ap'];
		$am=$_POST['am'];
		$nombre=$_POST['nom'];
		$car=intval($_SESSION['carrera']);
		$mp=$_SESSION['mp'];
		
		$estado=$_POST['tipo'];
		if($estado>0){
			$fecha=date('Y-m-d');
		}
		else{
			$fecha='';
		}

		
		//verifica que el alumno no se haya guardado antes
		$datos=busca_alumno($mat);
		if($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['id_alumno'];
		}
		else{
			//Guarda el usuario
			$id=guarda_usuario($nombre,$ap,$am,'','');
			//guarda el alumno
			guarda_alumno($id,$mat,$car);	
		}

		$datos=busca_pasistencia($mp,$id,'0000-00-00');
		if($fila=mysqli_fetch_assoc($datos)){
		}
		else{
			guarda_asistencia($mp,$id,'0000-00-00',0);
		}
		if($estado>0){
			$datos=busca_pasistencia($mp,$id,$fecha);
			if($fila=mysqli_fetch_assoc($datos)){
			}
			else{
				guarda_asistencia($mp,$id,$fecha,$estado);
			}
		}

		
		
		if ($_POST['tipo']==2){
			$datos=busca_pasistencia($mp,$id,$fecha,$estado);
			if($fila=mysqli_fetch_assoc($datos)){
			}		
			else{
				guarda_asistencia($mp,$id,$fecha,$estado);
			}
		}
		
		
		
		if($_POST['tipo']==1){
			header('location:lista.php?mp='.$mp);
		}
		
	}
	
?>