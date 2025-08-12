<?php 
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();

if ($_POST){
	$id=$_POST['id'];
	$nom=$_POST['nom'];
	$dur=$_POST['dur'];
	$des=$_POST['des'];
	$im=$_POST['im'];
	$tp=$_POST['tp'];

	if($id==0){
		g_carrera($nom,$dur,$des,$im,$tp);
	}
	else{
		a_carrera($id,$nom,$dur,$des,$im,$tp);
	}

	echo "<script type='text/javascript'> top.window.location='carrera.php'; </script>";
}
else{
	$id=$_GET['car'];

	if ($id==0){
		$t="NUEVA CARRERA";
		$b="Guardar";
		
		$nom="";
		$dur="";
		$des="";
		$im="";
	}
	else{
		$t="EDITAR CARRERA";
		$b="Actualizar";
		$datos=b_car($id);

		$fila=mysqli_fetch_assoc($datos);

		$nom=$fila['nombre'];
		$dur=$fila['duracion'];
		$des=$fila['descripcion'];
		$im=$fila['imagen'];
	}
}
?>
</head>
<body>

<?php
usuario();
menu_i();


	echo "<br><br><br><br><br><hr><p align='center'>$t</p><hr>
	<form method='POST'>
		<input type='hidden' name='id' value='$id'>
		<table border='0' align='center'>
			<tr><td>Nombre: </td><td><input type='text' name='nom' value='$nom'></td></tr>
			<tr><td>Duración: </td><td><input type='number' name='dur' size='10' value='$dur'></td></tr>
			<tr><td>Descripción: </td><td><textarea cols='50' rows='5' name='des'>$des</textarea></td></tr>
			<tr><td>Imagen: </td><td><input type='text' name='im' value='$im'></td></tr>
			<tr><td>Tipo: </td><td><input type='radio' name='tp' value='1'> Examen único<br><input type='radio' name='tp' value='2'> Varios exámenes</td></tr>
			<tr><td colspan='2' align='center'><input type='submit' value='$b'></td></tr>
		</table>
	</form>
	<br><br><br><hr><br><br>";


?>
</body>
</html>
