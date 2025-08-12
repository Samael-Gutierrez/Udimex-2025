<?php
session_start();
include("../general/funcion/basica.php");
include("../general/consultas/pagos.php");
include("../general/consultas/basic.php");
include("../general/consultas/general.php");

	carga_estilo('../');
?>
	
	</head>
	<body>
<?php
	permiso();
	menu('../');
?>
	

<?php




$us=$_SESSION["g_id"];
$mat=$_SESSION['mat'];
$tema=$_SESSION['tema'];
$sub=$_SESSION['sub'];
$ant=$_SESSION['ant'];
$sig=$_SESSION['sig'];
//$pago=$_SESSION['g_pago'];

//$prof=$_SESSION['prof'];

$bien=0;
$mal=0;

echo "<ol>";
if($tope=$_POST['tope']){
	for($i=1;$i<$tope;$i++){
		if(isset($_POST["p$i"])){
			$r=$_POST["p$i"];
			$d1=evalua($r);
			$f1=mysqli_fetch_assoc($d1);
			mysqli_free_result($d1);

			if ($f1['tipo']==1){
				$f='bien';
				$bien=$bien+1;
			}
			else{
				$f='mal';
				$mal=$mal+1;
				//$d2=g_rep($us,$f1['id_material']);
			}
			echo "<img src='../general/imagen/$f.png' align='left' width='30'><div id='$f'><li>".$f1['pregunta']."<br> R.- ".$f1['respuesta']."</li></div><br>";
		}
		else{
			echo "<img src='../general/imagen/mal.png' align='left' width='30'><div id='mal'><li>Pregunta NO contestada<br></li></div><br>";
			$mal=$mal+1;
		}
		
	}

	$calif=round(($bien*10/($bien+$mal)),1);
	echo "<div id='calif'>Calificación<br><center>$calif</center></div>";
}
echo "</ol>";





	if ($ant>0){
		$ant="<td  align='right'>
			<a href='materia_tema.php?mat=$mat&tema=$tema&sub=$ant'>
				<img src='../general/imagen/at.jpg' width='50'>
			</a>
		</td>";
	}
	else{
		$ant="";
	}

	if ($sig>0){
		$ad="<td>
			<a href='materia_tema.php?mat=$mat&tema=$tema&sub=$sig'>
				<img src='../general/imagen/ad.jpg' width='50'>
			</a>
		</td>";
	}
	else{
		$ad="";
	}




	
	echo "
		<table border='0' width='40%' align='center'>
			<tr>
				$ant
				<td align='center'>
					<a href='materia_indice.php?mat=".$mat."'><img src='../general/imagen/in.gif' width='50'></a>
				</td>
				$ad
			</tr>
		</table>";





?>






<?php
menu_c();
?>
	</body>
</html>
