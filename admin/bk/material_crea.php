<?php
	include("../consultas.php");
	
	if ($_POST){
		$tema=$_POST['tema'];
	}
	
	if ($_GET){
		$tema=$_GET['tema'];
	}
	
	$dato=m_vacio();

	if($fila=mysqli_fetch_assoc($dato)){
		atc_mat($fila['id_material'], $tema);
		$id=$fila['id_material'];
	}
	else{
		$id=n_mat($tema);
		g_ord($id);
	}

	echo "<script type='text/javascript'> top.window.location='editor.php?cont=$id'; </script>";
?>
	
