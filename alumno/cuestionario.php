<?php
session_start();
include("../general/funcion/basica.php");
include("../general/consultas/general.php");
include("../general/consultas/materias.php");
include("../general/consultas/basic.php");




	
	carga_estilo('../');
?>
	
	</head>
	<body>
<?php
	permiso();
	menu('../');
?>
	

<?php

$orden="order by rand()";


$mat=$_SESSION['mat'];
$tema=$_SESSION['tema'];
$sub=$_SESSION['sub'];

$datos=tema_sig($mat,$tema,$sub);

//if($fila=mysqli_fetch_assoc($datos) and $fila['titulo']!=""){
if($fila=mysqli_fetch_assoc($datos)){
	$ant=$fila['id']-2;
	echo "	<table border='0' width='100%' id='barra' rules='rows'>
			<tr bordercolor='#bcd35f'>
				<td rowspan='2' align='center' id='materia'>".$fila['nombre']."</td>
				<td align='right'>".$fila['titulo']." &nbsp; &nbsp; </td>
			</tr>
			<tr>
				<td align='right'>M&oacute;dulo ".$fila['modulo']." &nbsp; &nbsp; </td>
			</tr>
		</table>";


	$d1=cues($tema,$orden);

	$p=1;
	echo "<br><br><div id='tema'>Exámen de Autoevaluación</div><br><form method='POST' action='evalua.php'><ol>";
	while($f1=mysqli_fetch_assoc($d1)){
		echo "<li>".$f1['pregunta']."</li>";
		echo "<ol type='A'>";
		$d2=res($f1['id_pregunta'],"$orden");
		$r=1;
		while($f2=mysqli_fetch_assoc($d2)){
			echo "<li><input type='radio' id='r$p' name='p$p' value='".$f2['id_respuesta']."'>".$f2['respuesta']."</li>";
			$r=$r+1;
		}
		mysqli_free_result($d2);
		echo "</ol><br>";
		$p=$p+1;
	}
	mysqli_free_result($d1);
//	echo "</ol><center><input type='hidden' value='$p' name='tope'><input type='submit' value='Calificar'></center></form>";
	echo "</ol><center><input type='hidden' value='$p' name='tope'></center></form>";

}

mysqli_free_result($datos);



?>
	</body>
</html>
