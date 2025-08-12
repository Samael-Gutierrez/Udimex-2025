<?php
	if ($_POST['tp']==1){
		$path = $_FILES['archivo']['tmp_name'];
		$ctl = $_POST['control'];
		$type = pathinfo($path, PATHINFO_EXTENSION);
		$data = file_get_contents($path);
		$base64 = 'data:image/'.$type.';base64,'.base64_encode($data);
		echo "IMAGEN@:@".$base64;
	}


	if ($_POST['tp']==2){
		
		$archivo=$_FILES['archivo'];
		$nombre=date('y').date('z').date('h').date('i').date('s');
		$carpeta="../../general/video/";
		$extension = explode(".",$archivo['name']);
		$num = count($extension)-1;
		$ext=".".$extension[$num];

		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}

		if (!file_exists($nombre)) {
			move_uploaded_file($_FILES['archivo']['tmp_name'],$carpeta.$nombre.$ext);
		}
		echo "VIDEO@:@$nombre$ext";
	}

	if ($_POST['tp']==4){
		$archivo=$_FILES['archivo'];
		$nombre=date('y').date('z').date('h').date('i').date('s');
		$carpeta="../../general/PDF/";
		$extension = explode(".",$archivo['name']);
		$num = count($extension)-1;
		$ext=".".$extension[$num];

		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}

		if (!file_exists($nombre)) {
			move_uploaded_file($_FILES['archivo']['tmp_name'],$carpeta.$nombre.$ext);
		}
		echo "PDF@:@$nombre$ext";
	}



?>

