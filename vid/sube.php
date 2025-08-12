<?php
session_start();
include("consultas/consultas.php");

$pagina='location: index.php';

if(strlen($_FILES['doc']['tmp_name'])>0){
		$de=trim($_POST['de']);
		$para=trim($_POST['para']);
		$titulo=trim($_POST['titulo']);

		

		$datos=b_doc();
		$fila=mysqli_fetch_assoc($datos);
		$i=$fila['r']+1;
		$nombre="archivo".$i;




		$archivo=$_FILES['doc'];
		$extension = explode(".",$archivo['name']);
		$num = count($extension)-1;
		$ext=$extension[$num];

		if ($ext!='3gp'){

			$carpeta="video/";
			
			if (!file_exists($nombre)) {
				move_uploaded_file($_FILES['doc']['tmp_name'],$carpeta.$nombre.".".$ext);
			}

			$id=guarda("isa","isa",$titulo,$nombre,$ext);
			$_SESSION['video']=$id;
		}
		else{
			$pagina='location: formato.php';
		}

}



header($pagina);

?>
