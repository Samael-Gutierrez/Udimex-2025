<?php
session_start();
$dir="../general/";
include($dir."db/alumno.php");
include($dir."db/grupos.php");
include($dir."db/materias.php");
include($dir."db/admin.php");
include($dir."db/basica.php");

	$us=trim($_POST['us']);
	$pas=trim($_POST['pas']);
            
	$datos=sesion_inicio($us,$pas);

	if($fila= mysqli_fetch_assoc($datos)){
		$_SESSION["g_id"] = $fila['id_usuario'];
		$_SESSION["g_nom"] = $fila['nombre'];
		$_SESSION["g_ap"] = $fila['ap_pat'];

		//CARGA MATERIAS PARA UN ALUMNO
		q_almat($fila['id_usuario']);
		$datos=b_matgr2($fila['id_usuario']);
		while($fila=mysqli_fetch_assoc($datos)){
			g_almat($fila['id_usuario'],$fila['id_materia']);
		}
		//-----------------

		$datos2=b_ales2($_SESSION["g_id"]);
		$fila2=mysqli_fetch_assoc($datos2);
		$red='index.php';
		if ($fila2['estado']==6){
			$red='resultado.php';
		}

		bitacora($_SESSION["g_id"],'INICIA SESION');
		echo "<script type='text/javascript'> top.window.location='$red'; </script>";
}
else {
    // Display alert only if authentication fails
    echo "<script type='text/javascript'>alert('Usuario o contraseña incorrectos');</script>";
	echo "<script type='text/javascript'>window.location.href = 'http://udimex.net';</script>";
}

?>
