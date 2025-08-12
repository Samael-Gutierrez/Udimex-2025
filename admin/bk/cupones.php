<?php
session_start();
include("funciones.php");
include("../consultas/basic.php");
include("../consultas/generales.php");
include("../consultas/admin.php");
permiso();
cabeza();

echo "</head><body>";

usuario("../");
menu_i();

echo "<br><br><br><br><br><br><br><br><br><br><br><br>";

$prof=$_SESSION["ad_id"];

if ($_POST){	
	$na=$_POST['na'];
	$nd=$_POST['nd'];
	$ma=$_POST['ma'];
	$fc=$_POST['fc'];
	$cup=aleatorio(5);
	g_cupon($cup,$na,$nd,$ma,$fc,$prof);
	echo "<font color='#aa0000' size='5'> Se guardó el cupón serie: <b>$cup</b></font><br><br>";
}


?>

<form method='POST'>
	Nuevo Cupón
	<table border='0'>
		<tr><td>N° Alumno: </td><td><input type='number' name='na' size="2" min="1" max="50" value="1"></td></tr>
		<tr><td>N° Días: </td><td><input type='number' name='nd' size="2" min="10" max="99" value="10"></td></tr>
		<tr>
			<td>Materia: </td>
			<td>
				<select name='ma'>
				<?php
					$datos=materia_muestra('nombre');
					while ($fila=mysqli_fetch_assoc($datos)){
						echo "<option value='".$fila['id_materia']."'>".$fila['nombre']."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr><td>Fecha de caducidad: </td><td><input type='date' name='fc'></td></tr>
	</table>
	<input type='submit'>
</form>


<?php
	$datos=b_cupon($prof);
	echo "<br><br><br> Cupones Creados
	<table border='0'><tr><th>Cupon</th><th>Alumnos<br>Restantes</th><th>Días</th><th>Fecha de<br>caducidad</th><th>Materia</th></tr>";
	while($fila=mysqli_fetch_assoc($datos)){
		$datos2=b_materia($fila['id_materia']);
		$fila2=mysqli_fetch_assoc($datos2);
		echo "<tr><td align='center'>".$fila['n_cupon']."</td align='center'><td align='center'>".$fila['n_alumnos']."</td align='center'><td align='center'>".$fila['n_dias']."</td align='center'><td align='center'>".$fila['f_caducidad']."</td align='center'><td align='center'>".$fila2['nombre']."</td align='center'><td><a href='e_cupon.php?cup=".$fila['n_cupon']."'>Eliminar</a></td></tr>";
	}
	echo "</table>"
?>


</body>
</html>
