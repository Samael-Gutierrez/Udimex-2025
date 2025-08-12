<?php
session_start();
include("../consultas.php");
include('funciones.php');
permiso();
cabeza();

echo "</head><body>";

usuario();
menu_i();
?>

<br><br><br><br><br>
			<div id='subtitulo1' align='center'>REGISTRO DE GRUPOS</div><br><br>
				<form method='POST' action='reg_us.php'>
			
					<table border='0'>
						<tr><th>Hora de Inicio</th><th>Hora Final</th><th colspan='2'>Días</th><th>Tipo</td></tr>
					<tr>
						<td>
							<input type='time' name='hi'>
						</td>
						<td>
							<input type='time' name='hf'>
						</td>
						<td>
							<input type='checkbox' name='lu' value='Lunes'> Lunes<br>
							<input type='checkbox' name='ma' value='Martes'> Martes<br>
							<input type='checkbox' name='mi' value='Miércoles'> Miércoles<br>
							<input type='checkbox' name='ju' value='Jueves'> Jueves<br>
							
						</td>
						<td>
							<input type='checkbox' name='vi' value='Viernes'> Viernes<br>
							<input type='checkbox' name='sa' value='Sábado'> Sábado<br>
							<input type='checkbox' name='do' value='Domingo'> Domingo<br><br>
						</td>
						<td>
							<select name='tipo'>
								<option value='1'>Preparatoria Abierta</option>
								<option value='2'>CENEVAL</option>
								<option value='3'>Secundaria Abierta</option>
								<option value='4'>Ingreso a la Universidad</option>
							</select>
						</td>
						<th><input type='hidden' value='5' name='con'><input type='submit' value='Guardar'></th></tr></table></form>	
<?php
$datos=prof_grupo($_SESSION['g_prof']);
echo "<table border='1'><tr><th>Días</th><th>Inicio</th><th>Fin</th><th>Tipo</th><th></th><th></th></tr>";
while($fila=mysqli_fetch_assoc($datos)){
	if ($fila['tipo']==1){
		$tp="Prepa Abierta";
	}
	if ($fila['tipo']==2){
		$tp="CENEVAL";
	}
	if ($fila['tipo']==3){
		$tp="Secundaria Abierta";
	}
	if ($fila['tipo']==4){
		$tp="Ingreso Universidad";
	}
	echo "<tr>
		<td>".$fila['dias']."</td>
		<td>".$fila['hora_inicio']."</td>
		<td>".$fila['hora_fin']."</td>
		<td>$tp</td>
		<th><form method='POST' action='reg_us.php'>
			<input type='hidden' value='6' name='con'>
			<input type='hidden' value='".$fila['id_grupo']."' name='grupo'>
			<input type='submit' value='Eliminar'>
		</form></th>
		<th><form method='POST' action='grupo_ver.php'>
			<input type='hidden' value='".$fila['id_grupo']."' name='grupo'>
			<input type='submit' value='Ver alumnos'>
		</form></th>
	</tr>";
}
?>		
</body>
</html>


