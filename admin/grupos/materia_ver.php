
<?php
session_start();

$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."db/grupos.php");
include($dir."db/materias.php");

//permiso();
cabeza("Grupos - Udimex","<link rel='stylesheet' href='estilo_grupo.css'>", "");


if($_POST){
	q_matgr($_POST['id']);
	for($i=1;$i<=$_POST['mmax'];$i++){
		if (isset($_POST['mat'.$i])){
			ag_matgr($_POST['id'],$_POST['mat'.$i]);
		}
	}
}

$grupo = $_GET['id'];

?>

<!DOCTYPE HTML>
<script>
	function bloquea() {
	    document.getElementById('bloquea').style.display='block';
	    document.getElementById('emergente').style.display='block';
	}
</script>

<body>

<?php
	usuario("../../","index.php");
	echo "<center>";
	menu_i();
	echo "<br><br><br><br><fieldset id='subtitulo'>CONTROL DE GRUPOS</fieldset><div id='grupo_menu'>";

	$gr="";
	$datos=b_grupos();
	while($fila=mysqli_fetch_assoc($datos)){
		$gr=$gr."<a href='materia_ver.php?id=".$fila['id_grupo']."'>Grupo ".$fila['id_grupo']."</a><br>";
	}
	echo $gr;
	echo "</div><div id='grupo_cont'>";
	


	$datos=b_grupo2($_GET['id']);
	if($fila=mysqli_fetch_assoc($datos)){
		echo "Grupo ".$fila['id_grupo']."Días".$fila['dias']."Plan de estudios".$fila['nombre']."<hr>";
	}

	$materias="";
	$bloque='0';
	$i=0;
	$datos=b_materias($fila['id_carrera']);
	while($fila=mysqli_fetch_assoc($datos)){
		$i=$i+1;
		if ($fila['semestre']!=$bloque){
			$bloque=$fila['semestre'];
			$materias=$materias."<b>Bloque ".$bloque."</b><br>";
		}
		$materias=$materias."<input type='checkbox' value='".$fila['id_materia']."' name='mat$i'> ".$fila['nombre']."<br>";
	}
	$mmax="<input type='hidden' value='".$_GET['id']."' name='id'><input type='hidden' value='$i' name='mmax'>";

	$mat="Las materias activas para este grupo son:<br><img src='../../general/imagen/mas.png' width='40px' onclick='bloquea();'>";
	$datos=b_grm($_GET['id']);
	while($fila=mysqli_fetch_assoc($datos)){
		$mat=$mat."<div class='caja'><a href='materia_quita.php?gr=".$_GET['id']."&mt=".$fila['id_materia']."'>
		<img src='../../general/imagen/cierra.png' width='15px' align='right'></a><br>".$fila['nombre']."</div>";
	}
	echo $mat."<hr>";

	$i=0;
	$al="Los alumnos que pertenecen a este grupo son:<table border='0' bgcolor='#2e343d'><tr bgcolor='#dc748c'><th>#</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Nombre</th><th></th><th></th></tr>";
	$datos=b_algr($_GET['id']);
	while($fila=mysqli_fetch_assoc($datos)){
		$i=$i+1;
		$al=$al."<tr bgcolor='#748cb0'>
					<td>$i</td>
					<td>".$fila['ap_pat']."</td>
					<td>".$fila['ap_mat']."</td>
					<td>".$fila['nombre']."</td>
					<td>
						<a href='tareasAlumno.php?id=".$fila['id_alumno']."&grupo=$grupo'>Ver tareas</a>
					</td>
					<td>
						<a href='alumno_quita.php?id=".$fila['id_alumno']."&gr=".$_GET['id']."'>
							<img src='../../general/imagen/cierra.png' width='15px' align='right'>
						</a>
					</td>
				</tr>";
	}
	echo $al."</table><hr>";

	$sg="Si requieres agregar algún alumno a este grupo puedes seleccionarlo a continuación:<table border='0' bgcolor='##db0c4b'><tr bgcolor='#0e3b83'><th>Alumno</th>";
	$datos=b_algr(0);
	
	while($fila=mysqli_fetch_assoc($datos)){
		$sg=$sg."<form method='POST' action='alumno_agrega.php'>
					<tr bgcolor='#f4f4f4'>
						<td>".$fila['ap_pat']." ".$fila['ap_mat']." ".$fila['nombre']."</td>
						<td><input type='hidden' name='grupo' value='".$_GET['id']."'>
				        <td><input type='submit' class='bt_enviar' value='Guardar'></td>
					</tr>
					<input type='hidden' value='1' name='ct'>
					<input type='hidden' value='".$fila['id_alumno']."' name='alumno'>
				</form>";
	}
	echo $sg."</table><hr>";

	
?>
	

<div id='emergente' class='emergente'>
		<div align='center'><font size='6'>MATERIAS</font> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; <a href=''><input type='button' value='X'></a><hr>Selecciona las materias que deseas incluir para el grupo<br><br>
			<form method='POST'>
				<?php
					echo "<table border='0'><tr><td>".$materias."</td></tr></table>
					$mmax";
				?>
	
				<input type='submit' value='Guardar'>
			</form>
		</div>
	</div>
	<div id='bloquea' class='bloquea'>&nbsp;</div>

</body>
</html>


