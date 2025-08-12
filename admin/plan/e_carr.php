<?php 
session_start();
include("../funciones.php");
include("../../general/consultas/materias.php");
include("../../general/consultas/carreras.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/funcion/basica.php");
//permiso();
cabeza("Carreras-Udimex","");

if ($_POST){
	$id=$_POST['id'];
	$nom=$_POST['nom'];
	$dur=$_POST['dur'];
	$des=$_POST['des'];
	$tp=$_POST['tp'];
	$nivel=$_POST['nivel'];

	$path = $_FILES['archivo']['tmp_name'];
	//$ctl = $_POST['control'];
	$type = pathinfo($path, PATHINFO_EXTENSION);
	$data = file_get_contents($path);
	$im = 'data:image/' . $type . ';base64,' . base64_encode($data);


	if($id==0){
		$dato=b_rank();
		$fila=mysqli_fetch_assoc($dato);
		$rank=$fila['r'];
		g_carrera($nom,$dur,$des,$im,$tp,$rank,$nivel);
	}
	else{
		a_carrera($id,$nom,$dur,$des,$im,$tp);
	}

	echo "<script type='text/javascript'> top.window.location='../plan'; </script>";
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
usuario("../../","index.php");
menu_i();

	$datos=b_nivel();
	$res=ciclo1("<option value='" , "'>", "</option>",$datos,"id_nivel", "nombre");
	$nivel="<tr><td>Nivel</td><td><select name='nivel'>$res</select></td></tr>";


	echo "<br><br><br><br><br><hr><p align='center'>$t</p><hr>
	<form method='POST' enctype='multipart/form-data'>
		<input type='hidden' name='id' value='$id'>
		<table border='0' align='center'>
			<tr><td>Nombre: </td><td><input type='text' name='nom' value='$nom'></td></tr>
			<tr><td>Duración: </td><td><input type='number' name='dur' size='10' value='$dur'></td></tr>
			$nivel
			<tr><td>Descripción: </td><td><textarea cols='50' rows='5' name='des'>$des</textarea></td></tr>
			<tr><td>Imagen: </td><td><input type='file' name='archivo'><br><br></td></tr>
			<tr><td>Tipo: </td><td><input type='radio' name='tp' value='1'> Examen único<br><input type='radio' name='tp' value='2'> Varios exámenes</td></tr>
			<tr><td colspan='2' align='center'><input type='submit' value='$b'></td></tr>
		</table>
	</form>
	<br><br><br><hr><br><br>";


?>
</body>
</html>
