<?php
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/materias.php");

$car=$_GET['car'];


	if($_GET['mat']==0){
		$id=0;
		$nom="";
		$dur="";
		$tip="";
		//$car="";

		$sem=0;
		$ba=0;

		$b="Guardar";
		$t="Nueva Materia";
	}
	else{
		$datos=b_materia($_GET['mat']);
		$fila=mysqli_fetch_assoc($datos);
		$id=$fila['id_materia'];
		$nom=$fila['nombre'];
		$dur=$fila['duracion'];
		$tip=$fila['tipo'];
		$car=$fila['id_carrera'];



		$b="Actualizar";
		$t="Actualizar Materia";
	}


	//if ($car==1 or $car==4){
		$o="text";
		$datos=b_materia2($id);
		$fila=mysqli_fetch_assoc($datos);
		$sem=$fila['semestre'];
		//$ba=$fila['bachillerato'];
	/*}
	else{
		$o="hidden";
	}*/

echo "<br><br><br>$t<br><br>
	<form method='POST' action='mat_nueva2.php'>
		<input type='hidden' name='id' value='$id'>
		<input type='hidden' name='car' value='$car'>
		<table border='0' align='center'>
			<tr><td>Nombre: </td><td><input type='text' name='nom' value='$nom'></td></tr>
			<tr><td>Duración: </td><td><input type='number' name='dur' size='10' value='$dur'></td></tr>
			<tr><td hidden>Tipo: </td><td><input type='hidden' name='tip' value='le'></td></tr>

			<tr $o><td>Bloque: </td><td><input type='$o' name='sem' value='$sem'></td></tr>
			<tr hidden><td>bachillerato: </td><td><input type='$o' name='ba' value='$car'></td></tr>

			<tr><td colspan='2' align='center'><input type='submit' value='$b'></td></tr>
		</table>
	</form>";
?>
