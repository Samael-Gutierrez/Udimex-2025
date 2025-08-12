<?php 
include("../../general/consultas/alumno.php");
include("../../general/consultas/basic.php");

if($_POST){
	$tp=$_POST['tp'];
	$nom='';
	$ap='';
	$am='';

	if(strlen($_POST['nom'])>0){
		$nom=$_POST['nom'];
	}
	if(strlen($_POST['ap'])>0){
		$ap=$_POST['ap'];
	}
	if(strlen($_POST['am'])>0){
		$am=$_POST['am'];
	}

	if ($tp==0){
		$datos=b_us_edo($nom,$ap,$am,0,$tp);
		while($fila=mysqli_fetch_assoc($datos)){
			echo $fila['nombre'].$fila['ap_pat'].$fila['ap_mat']."<br>";
		}
	}
	
}





?>
