<?php
session_start();
$dir="../general/";
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."php/admin.php");

$mensaje='';
if($_POST){
	if($_POST['cln1']==$_POST['cln2']){
		a_cl($_SESSION["ad_id"],$_POST['cln1'],1);
	}
	else{
		$mensaje='Las claves no coinciden';
	}
}

$adicional="
<link rel='stylesheet' href='".$dir."css/menu.css'>
<link rel='stylesheet' href='".$dir."css/bloquea.css'>
<script src='".$dir."js/bloquea.js'></script>";

cabeza("Menu - Udimex",$adicional, $dir);

//permiso();
$nombre=$_SESSION['ad_nom']." ".$_SESSION['ad_ap'];
  
echo "
<body>
    <header>
        <nav class='navbar'>
            <a class='navbar-brand' href='#'>Menú</a>
            <div id='notification-latest' class='notification-dropdown'></div>
        </nav>
    </header>
	
	<main class='container'>
        <section class='welcome'>
            <h2>Bienvenid@, $nombre</h2>
            <a href='".$dir."php/salir.php' class='logout-btn'>Cerrar sesión</a>
        </section>
";

$menu="";
$tipo='';
$i=0;
$datos=b_acceso($_SESSION["ad_id"]);
while($fila=mysqli_fetch_assoc($datos)){
	$i=$i+1;

	if($tipo!=$fila['descr']){
		if($i>1){
			$menu=$menu."</div></fieldset>";
		}
		$menu=$menu."<fieldset>
                <legend>".$fila['descr']."</legend><div class='menu-grid'>";
		$tipo=$fila['descr'];
	}
	$menu=$menu."<div class='menu-item'>
		<a href='".$fila['url']."'><img src='".$dir."imagen/".$fila['icono']."' height='60' alt='".$fila['nombre']."'>
		<br>".$fila['nombre']."</a>
	</div>";
}
$menu=$menu."</div></fieldset><br><br><br>";



if ($i>0){
	echo "<section class='menu'>".$menu."</section></main>";
}
else{
	echo "<script type='text/javascript'> top.window.location='../admin'; </script>";
}


$datos=c_clave($_SESSION["ad_id"]);
$fila=mysqli_fetch_assoc($datos);
if ($fila['e_cl']==0){
	echo "<div id='emergente' class='emergente'>
		<div align='center'><font size='6'>CAMBIO DE CLAVE</font><hr>Se requiere el cambio tu clave de acceso<br><br>
			<form method='POST'>
				<table border='0'>
					<tr>
						<td>Clave nueva</td>
						<td>
							<input type='password' name='cln1' placeholder='Clave nueva' required='required' id='clave'>
						</td>
					</tr>
					<tr>
						<td>Confirma tu clave</td>
						<td><input type='password' name='cln2' placeholder='Confirma tu clave' required='required'></td>
					</tr>
					
				</table><br>
				<input type='submit' value='Guardar'>
			</form>
			<div class='alerta'>$mensaje</div>
		</div>
	</div>
	<div id='bloquea' class='bloquea'>&nbsp;</div>
	<script>bloquea(\"clave\");</script>";
}

?>

    <footer>
        <p>&copy; 2024 Udimex. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
