<?php
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();

if ($_POST){
	if($_POST['c'] and $_POST['c']==1){
		$mat=$_POST['mat'];
		$mod=$_POST['mod'];
		$tit=$_POST['titulo'];
		g_tema($mat,$mod,$tit,$_SESSION["ad_prof"]);
	}
	else{
		$mat=$_POST['mat'];
		$_SESSION['mat']=$mat;
	}
}
else{
	$mat=$_SESSION['mat'];
}

		$dato=b_materia($mat);
		$fila=mysqli_fetch_assoc($dato);



?>

<script>
	function siguiente(){
		mod=document.getElementById('mod').value;
		if (mod>0){
			document.getElementById('oculta').style.display='block';
		}
		else{
			document.getElementById('oculta').style.display='none';
		}
	}
</script>



</head>

<body>
<?php
usuario();
menu_i();
echo "<br><br><br><center><font size='7' color='#ee9999'>".$fila['nombre']."</font></center>";
?>
<br><br><fieldset align='center'>NUEVO MÓDULO</fieldset><br><br>
<form method='POST'>
Módulo <select name='mod' onclick='siguiente();' id='mod'>

<?php
	for($i=0;$i<21;$i++){
		echo "<option value='$i'>$i</option>";
	}
	echo "

</select>
<div id='oculta' style='display:none;'>
Tema<input type='text' name='titulo' >
<input type='hidden' value='$mat' name='mat'>
<input type='hidden' value='1' name='c'>
<input type='submit' value='Crear Tema'>
</div>
</form><br><br><hr><br><br>";


	$dato=temas_prof($_SESSION['ad_prof'],$mat);
	echo "<table border='1'><tr><th>Módulo</th><th>Tema</th><td colspan='4'></td>";
	while($fila=mysqli_fetch_assoc($dato)){
		echo "<tr><th><form method='POST' action='material_crea.php'>
		".$fila['modulo']."</td><th>
		<input type='hidden' value='".$fila['id_tema']."' name='tema'>";
		echo $fila['titulo']."</td><td><input type='submit' value='Desarrollar Tema'></form></td>
		<td><a href='curso_edita.php?tema=".$fila['id_tema']."'>Editar</a></td>
		<td><a href='curso_cuestionario.php?tema=".$fila['id_tema']."'>Cuestionario</a></td>
		<td><a href='curso_cues_edita.php?tema=".$fila['id_tema']."'>Editar Cuestionario</a></td>
		</tr>";
	}

echo "</table><br><a href='materias.php'>Regresar</a>";

?>






</body>
</html>

