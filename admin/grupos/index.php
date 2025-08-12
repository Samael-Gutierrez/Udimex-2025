<?php
session_start();
$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."db/grupos.php");
include($dir."db/carreras.php");

//permiso();
cabeza("Grupos - Udimex","","");

if ($_POST){
	if($_POST['con']==5){
		$dias=$_POST['lu']." ".$_POST['ma']." ".$_POST['mi']." ".$_POST['ju']." ".$_POST['vi']." ".$_POST['sa']." ".$_POST['do'];
		$gr=g_grupo($dias,$_POST['tipo']);
	}
	
	if($_POST['con']==6){
	    elimina_alumno_grupo($_POST['grupo']);
		e_grupo($_POST['grupo'],0);
	}
header("location:materia_ver.php?id=$gr");	
die();
}
?>



<body>

<?php
	usuario("../../",'index.php');
	echo "<center>";
	menu_i();
	echo "<br><br><br><br>
		<fieldset id='subtitulo'>REGISTRO DE GRUPOS</fieldset>";

	$car="";
	$datos=b_car(">0");
	while($fila=mysqli_fetch_assoc($datos)){
		$car=$car."<option value='".$fila['id_carrera']."'>".$fila['nombre']."</option>";
		//$carrera[$fila['id_carrera']]=$fila['nombre'];
	}
?>
	
<?php
$datos=b_grupos();
echo "<table border='0' bgcolor='#aaaaaa'><tr bgcolor='#ffffff'><th></th><th>#</th><th>Días</th><th>Tipo</th><th></th></tr>";
while($fila=mysqli_fetch_assoc($datos)){
    $datos2=grupo_alumnos($fila['id_grupo']);
    $fila2=mysqli_fetch_assoc($datos2);
    if($fila2['r']==0){
        //Elimina los grupos que no tengan alumnos
        e_grupo($fila['id_grupo'],0);
    }
    else{
        e_grupo($fila['id_grupo'],1);
    	echo "<tr bgcolor='#ffffff'>
    		<td><form method='POST'>
    			<input type='hidden' value='6' name='con'>
    			<input type='hidden' value='".$fila['id_grupo']."' name='grupo'>
    			<input type='submit' value='X'>
    		</form></td>
    		<td>Grupo ".$fila['id_grupo']."</td>
    		<td>".$fila['dias']."</td>
    		<td>".$fila['nombre']."</td>
    		<th><a href='materia_ver.php?id=".$fila['id_grupo']."'><input type='button' value='Ver detalles'></a></th>
    	</tr>";
    }
}
?>
</table>
<hr>
<form method='POST'>
	<table border='0' width='50%'>
		<tr>
			<th colspan='2'>Días</th>
			<th colspan='2'>Plan de Estudios</th>
		</tr>
		<tr>
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
			<td rowspan='2'>
				Selecciona el plan de estudios<br>
				<select name='tipo'>
					<?php echo $car; ?>
				</select><br><br><center><input type='submit' value='Guardar'></center>
				<input type='hidden' value='5' name='con'>
			</td>
		</tr>
	</table>
</form>		
</body>
</html>


