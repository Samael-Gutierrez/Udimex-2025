<?php
session_start();
include("../general/consultas/basic.php");
include("../general/consultas/admin.php");

// <link rel='stylesheet' href='estilo/estilo.css'>

echo "
<html>
<head>
	<title>Login</title>
	<link rel='stylesheet' href='estilo/styles.css'>
	<meta charset='utf-8'>
</head>
<body>
";

if ($_POST){
	$us=$_POST['us'];
	$pas=$_POST['pas'];
	$_SESSION["ad_id"]=0;

	$datos=sesion_inicio($us,$pas);
	$fila=mysqli_fetch_assoc($datos);
		$_SESSION["ad_id"] = $fila["id_usuario"];
		echo $fila['id_usuario'];
		//$_SESSION["ad_prof"] = $fila['id_profesor'];
		$_SESSION["ad_nom"] = $fila['nombre'];
		$_SESSION["ad_ap"] = $fila['ap_pat'];	
	
echo $_SESSION["ad_id"];
//echo $_SESSION["id_usuario"];
	if ($_SESSION["ad_id"]>0){
		echo "<script type='text/javascript'>window.location='menu.php'; </script>";
	}
	else{
		login("Error de acceso, intenta de nuevo");
		
	}	
}
else{
	login("");
	
}
echo "
	</body>
	</html>
";



	function login($mensaje){
		// echo "
		// 	<div id='cuerpo'>

		// 		<form method='POST'>
		// 			Usuario:<br><input type='text' name='us' id='caja_texto'><br><br>
		// 			Clave:<br><input type='password' name='pas' id='caja_texto'><br>
		// 			<p align='center'>
		// 			&nbsp; &nbsp; &nbsp; &nbsp;
		// 			<input type='submit' value='Entrar' id='boton'></p>
		// 		</form>
		// 	</div>
		// ";

	echo "<div class='container-main dfcr'>
        	<div class='flotante'>
        	</div>
        	<form class='login dfcr dfcc' method='POST'>
            	<div>
                	<img src='estilo/img/logo.png' alt='logo.udimex'>
            	</div>
            	<div class='label-input'>
                	<p>Usuarios</p>
            	</div>
            	<div class='input-text'>
                	<input type='text' placeholder='Escribe tu Usuario' class='cp' name='us'>
            	</div>
            	<div class='label-input'>
                	<p>Contraseña</p>
            	</div>
            	<div class='input-text'>
                	<input type='password' placeholder='Escribe tu Contraseña' class='cs' name='pas'>
            	</div>

            	<input class='btn-ingresar' type='submit' value='Ingresar' id='boton'>
        	</form>
			<p>$mensaje</p>
    	</div>";
	}
?>
