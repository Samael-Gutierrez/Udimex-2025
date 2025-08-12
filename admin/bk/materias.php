<?php
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();
?>

<script>
	function muestra(v){
		if (v==1){
			ocultat();
			document.getElementById('prepa').style.display='block';
		}
		if (v==2){
			ocultat();
			document.getElementById('ceneval').style.display='block';
			document.getElementById('s27').style.display='block';
			document.getElementById('s38').style.display='none';
		}
		if (v==3){
			ocultat();
			document.getElementById('colbach').style.display='block';
			document.getElementById('s27').style.display='none';
			document.getElementById('s38').style.display='block';
		}
		if (v==4){
			ocultat();
			document.getElementById('p22').style.display='block';
		}
		if (v==11){
			oculta();
			document.getElementById('s11').style.display='block';
		}
		if (v==12){
			oculta();
			document.getElementById('s12').style.display='block';
		}
		if (v==13){
			oculta();
			document.getElementById('s13').style.display='block';
		}
		if (v==14){
			oculta();
			document.getElementById('s14').style.display='block';
		}
		if (v==15){
			oculta();
			document.getElementById('s15').style.display='block';
		}
		if (v==16){
			oculta();
			document.getElementById('s16').style.display='block';
		}
		if (v==41){
			oculta();
			document.getElementById('s41').style.display='block';
		}
		if (v==42){
			oculta();
			document.getElementById('s42').style.display='block';
		}
		if (v==43){
			oculta();
			document.getElementById('s43').style.display='block';
		}
		if (v==44){
			oculta();
			document.getElementById('s44').style.display='block';
		}
		if (v==45){
			oculta();
			document.getElementById('s45').style.display='block';
		}
		if (v==46){
			oculta();
			document.getElementById('s46').style.display='block';
		}

	}

	function oculta(){
		
		document.getElementById('s11').style.display='none';
		document.getElementById('s12').style.display='none';
		document.getElementById('s13').style.display='none';
		document.getElementById('s14').style.display='none';
		document.getElementById('s15').style.display='none';
		document.getElementById('s16').style.display='none';
		document.getElementById('s27').style.display='none';
		document.getElementById('s38').style.display='none';
		document.getElementById('s41').style.display='none';
		document.getElementById('s42').style.display='none';
		document.getElementById('s43').style.display='none';
		document.getElementById('s44').style.display='none';
		document.getElementById('s45').style.display='none';
		document.getElementById('s46').style.display='none';
	}

	function ocultat(){
		document.getElementById('prepa').style.display='none';
		document.getElementById('ceneval').style.display='none';
		document.getElementById('colbach').style.display='none';
		document.getElementById('p22').style.display='none';
	}
</script>
<title>Materias </title>
</head>
<body>

<?php
usuario();
menu_i();
	echo "<br><br><br><br><table border='0' width='95%' align='center'>
		<tr>
			<td  align='center' colspan=2>	
				<fieldset id='subtitulo'>Elige un plan de estudios</fieldset><br>
			</td>
		</tr>";
		$i=0;
		$datos=b_carrera();
		while($fila=mysqli_fetch_assoc($datos)){
			$i=$i+1;
			echo"<tr>
 			<td  align='center' width='20%'>	
				<div class=c1>
					<a href='#' id='al' name='al' onclick='muestra(".$fila['id_carrera'].");'>
					<img src='../imagen/".$fila['imagen']."' height='60'><br>".$fila['nombre']."</a>
				</div>					
			</td>";
			$tp=$fila['tipo'];
			if ($i==1){
				echo "<td rowspan='4'><div id='prepa' style='display:none;'>
				<div id='subtema' align='center'>Prepa Abierta</div><br><br>";
				semestre(1,1);
				semestre(1,2);
				semestre(1,3);
				semestre(1,4);
				semestre(1,5);
				semestre(1,6);
				echo "</div><br><div id='ceneval' style='display:none;'><div id='subtema' align='center'>CENEVAL
				</div><br><br>";
				semestre(2,7);
				echo "</div><br><div id='colbach' style='display:none;'><div id='subtema' align='center'>COLBACH
				</div><br><br>";
				semestre(3,8);
				echo "</div>";
				echo "<div id='p22' style='display:none;'>
				<div id='subtema' align='center'>Prepa Abierta 22 Módulos</div><br><br>";
				semestre(4,1);
				semestre(4,2);
				semestre(4,3);
				semestre(4,4);
				semestre(4,5);
				semestre(4,6);
				echo "</div></td>";
				
			}
			echo "</tr>";
		}
	echo "</table>";

function semestre($car,$sem){
	if ($car==1 or $car==4){
	
		echo "&nbsp; &nbsp; &nbsp; &nbsp; <input type='button' onclick='muestra($car$sem);' value='+'>".$sem."° Semestre";
		$datos=b_mat($sem,$car);
	}
	else{
		$datos=b_plan($car);
	}
	echo "<div id='s$car$sem' style='display:none;'><table border='0'>";

	while($fila=mysqli_fetch_assoc($datos)){
		echo "		<form method='POST' action='curso_tema.php'>
					<tr><td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td><td>".$fila['nombre']."
					<td><a href='ordena.php?mat=".$fila['id_materia']."'><input type='button' value='Opciones'></a></td></tr>
				</form>
			";
	}

	echo "</table></div><br>";
}


?>
</body>
</html>
