<?php
session_start();
$dir="../general/";
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."php/admin.php");

$adicional="<link rel='stylesheet' href='".$dir."css/admin.css'>";

cabeza("Profesores y Administradores - Udimex",$adicional, $dir);

echo "<body><div class='cfon'>";

$res=0;
$tipo=0;
if ($_POST){
	$us=$_POST['us'];
	$pas=$_POST['pas'];
	$_SESSION["ad_id"]=0;

	if(strlen($us)>0 && strlen($pas)>0){

		$datos=sesion_inicio($us,$pas);
		if($fila=mysqli_fetch_assoc($datos)){
			$_SESSION["ad_id"] = $fila["id_usuario"];
			$_SESSION["ad_nom"] = $fila['nombre'];
			$_SESSION["ad_ap"] = $fila['ap_pat'];
			bitacora($_SESSION["ad_id"], "INICIA SESION");
			header("location:menu.php");
			//echo "<script type='text/javascript'>window.location='menu.php'; </script>";
		}
		else{
			login("<div class='resalta'>Error de acceso, intenta de nuevo</div><br><br>");	
		}	
	}
	else{
		login("<div class='resalta'>Error de acceso, llena usuario y clave</div><br><br>");
	}
}
else{
	login("");
	
}
echo "	</center></div>
	</body>
	</html>
";



	function login($mensaje){
		echo "
		

<center>
<div class='wrapper fadeInDown'>
  <div id='formulario'>
    <!-- Icon -->
    <div class='fadeIn first'>
      <div id='formularioCabeza'><img src='../general/imagen/logo.png' id='icon' alt='UDIMEX'></div>
	  <br>
	  <div class='titulo'>Profesores y Administradores</div><hr>
    </div>
	<br>
    <form method='POST'>
      <input type='text' id='login' class='fadeIn second' name='us' placeholder='Usuario'>
      <input type='password' id='password' class='fadeIn third' name='pas' placeholder='Contraseña'>
      <input type='submit' class='fadeIn fourth' value='Entrar'><br>
	<center>$mensaje</center>
    </form>

    <!-- Remind Passowrd -->
    <div id='formularioPie'>
      <a class='underlineHover' href='#'>¿Olvidaste tu clave?</a>
    </div>

  </div>
</div>



			
		";

	}
?>
