<?php
session_start();
include("../db/basica.php");
include("../db/chat.php");

if($_POST){
	$variable=$_POST['variable'];
	$info=$_POST['dato'];
	$pregunta=$_POST['pregunta'];

	$_SESSION['mensajes']=$_SESSION['mensajes']."<div align='right'><div class='prospecto'>
				$info
		</div>
		<div class='avt_pros'><img src='imagen/usuario.png' width='30px'></div></div><br>";

	if ($variable=='correo'){
		$dato=busca_correo($info);
		$fila=mysqli_fetch_assoc($dato);

		if ($fila['r']==0){
			$_SESSION['id_usuario']=g_correo($info);
			echo 1;
		}
		else{
			$_SESSION['correo']=$info
			echo 0;
		}
	}
}



?>
