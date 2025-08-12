<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/materias.php");
include("../../general/consultas/carreras.php");
include("../../general/funcion/basica.php");
//permiso();
cabeza("","");


?>

<script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script>
<script>
	function ocultaplan(){
		lm=document.getElementById('maxcar').value;
		for (i=1;i<=lm; i++){
			pl="plan"+i
			document.getElementById(pl).style.display='none';
		}
	}

	function muestra(i,titulo,idc){
		ocultaplan();
		i="plan"+i;
		document.getElementById(i).style.display='block';
		document.getElementById('mats').style.display='block';
		document.getElementById('cont').style.display='block';
		document.getElementById('titulo').innerHTML=titulo;
		window.scroll(0,0);
		ranking(idc);
	}

	function desbloquea(){
		document.getElementById('mats').style.display='none';
		document.getElementById('cont').style.display='none';
	}

	function ranking(idc){
		$.ajax({               
			type: 'POST',                 
			url: 'ranking.php',                     
			data: {idc:idc}, 
			success: function(data)             
			{
			}
		});
	}
</script>
<title>Materias </title>
</head>
<body>

<?php
	usuario("../../","index.php");
	echo "<center>";
	menu_i();
	echo "<br><br>
		<fieldset id='subtitulo'>SELECCIONA UNA OPCIÓN</fieldset>";


		$i=0;
		$datos=b_carrera("=0");
		$materias="";
		$carrera="";
		while($fila=mysqli_fetch_assoc($datos)){	
			$i=$i+1;
			$titulo=$fila['nombre'];
			$idc=$fila['id_carrera'];
			$carrera=$carrera."
				<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px; inline-block; align='left'>
	    				<header class='w3-container align='center' style='height:100px;'>
	     					<h3 onclick='muestra($i,\"$titulo\",$idc);'>$titulo</h3>
					</header>
					<div class='w3-container' width='138px'>

	      					
						<div align='center'>
							<div id='al' name='al' onclick='muestra($i,\"$titulo\",$idc);'>
								<img src='".$fila['imagen']."' height='60'>
							</div>
						</div>
						<hr>
					</div>
					<div class='w3-padding w3-block'>
						<div id='al' name='al' onclick='muestra($i,\"$titulo\",$idc);' style='display:inline-block; margin:0px 25px;'>
							<h3>Ver materias</h3>
						</div>
						<a href='../plan/plan.php?car=".$fila['id_carrera']."' align='right' style='display:inline-block; margin:0px 10px;'>
							<img src='../../general/imagen/conf.png' width='20px'>
						</a>
					</div>
				</div>				
			";


			$sec=0;
			$semestre=0;
			$datos2=b_materias($fila['id_carrera']);
			
			$materias=$materias."<div id='plan$i' hidden><table>";
			while($fila2=mysqli_fetch_assoc($datos2)){
				if($semestre!=$fila2['semestre']){
					$sec=$sec+1;
					$materias=$materias."

					</table>
					
					<! Comienza la sección !>
					<table border='0' class='columnas'><tr><th colspan='2'><br><br>".$fila2['semestre']."° BLOQUE</th></tr>";
					$semestre=$fila2['semestre'];
				}
	
				$materias=$materias."
				<tr>
					<td><a href='ordena.php?mat=".$fila2['id_materia']."'>".$fila2['nombre']."</a>&nbsp; &nbsp; </td>
					<td><a href='ordena.php?mat=".$fila2['id_materia']."'><input type='button' value='Temas' class='bt'></a></td>
				</tr>";
			}
			$materias=$materias."</table></div>";
			
		}

			$carrera=$carrera."
				<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px; inline-block; align='left'>
	    				<a href='index.php' id='al' name='al'>
						<header class='w3-container align='center' style='height:100px;'>
		     					<h3>Regresar</h3>
						</header>
							Regresar a materias Activas
					</a>
				</div>				
			";

echo "<input type='hidden' value='$i' id='maxcar'>";
echo "<br><br><br>
<div class='linea'>$carrera</div>
<br><br><br><br>
<div class='materias4' id='mats' onclick='desbloquea();'></div>
<div id='cont'><img src='../../general/imagen/cierra.png' title='Cerrar' width='25px' id='bcerrar' onclick='desbloquea();'><center><h2 id='titulo'></h2></center>$materias</table></div>
</div></center>";




?>


</body>
</html>
