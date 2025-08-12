<?php
session_start();
include("../general/consultas/admin.php");
include("../general/consultas/basic.php");
include("funciones.php");
include("../general/funcion/basica.php");

//permiso();

echo "
<html>
<head>



<script>
	function bloquea() {
	    document.getElementById('bloquea').style.display='block';
	    document.getElementById('emergente').style.display='block';
	}
</script>


	<title>Menú </title>
	<link rel='stylesheet' href='estilo/estilo.css'>
	<meta charset='utf-8'>
</head>
<body>
";


usuario("../","index.php");



if($_POST){
	if($_POST['cln1']==$_POST['cln2']){
		a_cl($_SESSION["ad_id"],$_POST['cln1'],1);
		$mensaje='';
	}
	else{
		$mensaje='Las claves no coinciden';
	}
}



$menu="";
$tipo='';



$i=0;
$datos=b_acceso($_SESSION["ad_id"]);
while($fila=mysqli_fetch_assoc($datos)){
	$i=$i+1;

	if($tipo!=$fila['descr']){
		$menu=$menu."<br><br><br><br><br><fieldset>MENÚ DE ".$fila['descr']."</fieldset><br>";
		$tipo=$fila['descr'];
	}
	$menu=$menu."<div class=c1>
		<a href='".$fila['url']."'><img src='../general/imagen/".$fila['icono']."' height='60'>
		<br>".$fila['nombre']."</a>
	</div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
}



if ($i>0){
	echo "<div align='center'>".$menu."</div>";

}
else{
	echo "<script type='text/javascript'> top.window.location='../alumno/horario_muestra.php'; </script>";
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
						<td><input type='password' name='cln1' placeholder='Clave nueva' required='required'></td>
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
	<script>bloquea();</script>";
}

?>
</body>
</html>
