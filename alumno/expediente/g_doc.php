<?php
session_start();
include("../general/todos.php");
include("../consultas/expediente.php");

if(strlen($_FILES['doc']['tmp_name'])>0){
		$desc=trim($_POST['desc']);
		$exp=$_POST['exp'];
		$emp=$_POST['emp'];

		if($desc==''){
			$desc='doc';
		}

		for($i=1;$i<100;$i++){
			$nombre=$exp."-".$i;
			$datos=b_doc($nombre);
			$fila=mysqli_fetch_assoc($datos);
			if ($fila['r']==0){
				$i=100;
			}
			
		}

		$archivo=$_FILES['doc'];
		$extension = explode(".",$archivo['name']);
		$num = count($extension)-1;
		$ext=".".$extension[$num];

		$carpeta="archivo/$exp/";
		if (!file_exists($carpeta)) {
		    mkdir($carpeta, 0777, true);
		}
			
		if (!file_exists($nombre)) {
			move_uploaded_file($_FILES['doc']['tmp_name'],$carpeta.$nombre.$ext);
		}

		g_doc($exp,$emp,$nombre,$ext,$desc);

}

$pagina='location: index.php?c=2#bot';

header($pagina);

?>
