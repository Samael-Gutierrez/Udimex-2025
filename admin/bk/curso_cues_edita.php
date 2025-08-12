<?php
include("../todos.php");
include("../consultas.php");
cabeza(2);
?>

</head>
<body>
<table border=1>

<?php
if ($_POST){
	e_res($_POST['id']);
	e_preg($_POST['id']);
}





$datos=cues($_GET['tema']," order by pregunta");

while($fila=mysqli_fetch_assoc($datos)){
	echo "<tr><td>".$fila['pregunta']."</td><td>";
	$datos2=res($fila['id_pregunta'],"order by tipo desc");
	while($fila2=mysqli_fetch_assoc($datos2)){
		
		if ($fila2['tipo']==1){
			$im="bien.png";
		}
		else{
			$im="mal.png";
		}
		echo "<img src='../imagen/$im' width='30px'> ".$fila2['respuesta']."<br>";
	}
	echo "</td>".accion($fila['id_pregunta'],1).accion($fila['id_pregunta'],0)."</tr>";
}

echo "</table>";

function accion($id,$tipo){
	if ($tipo==1){
		$met="method='GET'";
		$ac="action='curso_cuestionario.php'";
		$val='Editar';
	}
	else{
		$met="method='POST'";
		$ac="";
		$val='Eliminar';
	}

	echo "<td><form $met $ac>
		<input type='submit' value='$val'>
		<input type='hidden' value='$id' name='id'>
	</form></td>";
}

?>
</body>
</html>

