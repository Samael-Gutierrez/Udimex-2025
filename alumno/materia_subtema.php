<?php
	session_start();
	$dir="../general/";
	include($dir."php/alumno.php");
	include($dir."db/basica.php");
	include($dir."db/pagos.php");
	include($dir."db/materias.php");
	include($dir."db/tarea.php");
	
	
	cabeza("Estudiando ... - Udimex","<script src='".$dir."js/mate.js'></script>",$dir);

	permiso();
	include("../general/js/mate.js");
?>

	<body onload="">
<?php
	menu('../');
	$mat=$_SESSION['mat'];
	$tema=$_SESSION['tema'];
	$sub=$_SESSION['sub'];
	$ant=$_SESSION['ant'];
	$sig=$_SESSION['sig'];

	$hoy = date("today");

	if ($ant>0){
		$ant="<td  align='right'>
			<a href='materia_tema.php?mat=$mat&tema=$tema&sub=$ant'>
				<img src='../general/imagen/at.png' width='50'>
			</a>
		</td>";
	}
	else{
		$ant="";
	}

	if ($sig>0){
		$ad="<td>
			<a href='materia_tema.php?mat=$mat&tema=$tema&sub=$sig'>
				<img src='../general/imagen/ad.png' width='50'>
			</a>
		</td>";
		
		$_SESSION['siguiente']="materia_tema.php?mat=$mat&tema=$tema&sub=$sig";
	}
	else{
		$ad="";
		$_SESSION['siguiente']="";
	}

	$datos=b_contenido($sub,"orden_alumno");
	$fila=mysqli_fetch_assoc($datos);
	
	$subtitulo=$fila['subtitulo'];

	echo "<center><table border='0' width='800px' id='barra' rules='rows'>
			<tr bordercolor='#bcd35f'>
				<td rowspan='2' align='center' id='materia'><h3>".$fila['nombre']."</h3></td>
				<td align='right'><h6>".$fila['titulo']."&nbsp; &nbsp; </h6></td>
			</tr>
			<tr>
				<td align='right'><h6>Módulo ".$fila['modulo']."&nbsp; &nbsp; </h6></td>
			</tr>
		</table></center>";

	$fichero=$fila['apunte'];
	$archivo="apuntes/".$fichero.".alf";	
	$contenido = file_get_contents($archivo);
	
	$tarea="";
	$al=$_SESSION["g_id"];
	$datos2=b_tarea($fichero);
	$ct=0;

	// Contenedor de las tareas con flex
	$container_inicio ="<div class='container-tareas'>
							<h2 class='titulo-container'>Tareas</h2>
							<div class='container-cards'> ";

	$container_fin="</div>";

	// While para mostrar las tareas
	while($fila2=mysqli_fetch_assoc($datos2)){
		//Mostrar tarea
		$fichero=$fila2['id_tarea'];
		$archivo="tarea/".$fichero.".alf";	
		$archivo = file_get_contents($archivo);
		$dias=$fila2['dias'];

		// Genera la fecha a entregar
		$entrega=fecha_suma(date('Y-m-d'),$dias);

		// Contador de tareas
		$ct=$ct+1;

		// Cuenta cuantas tareas ya subio
		$datos = cuenta_tarea($fichero,$al);

		// Contador de tareas
		if($fila = mysqli_fetch_assoc($datos)){
			$contador = $fila['COUNT(id_alumno)'];
		}

		if($contador < 1) {
			$mensajeTarea = "<p class='incorrecta'>Sin archivos adjuntos</p>";
		}else{
			$mensajeTarea = "<p class='correcta'>Con $contador archivo/s adjuntos</p>";
		}

		//Verificar si la tarea ya existe para el alumno sino la agrega
		$datos=busca_tarea_alumno($fichero, $al);
		if($fila=mysqli_fetch_assoc($datos)){
			$entrega=$fila['fecha_solicitud'];
			$fe=explode('-',$entrega);
			$entrega=$fe[2]."-".$fe[1]."-".$fe[0];
		}
		else{
			$fe=explode('-',$entrega);
			guarda_tarea_alumno($fichero,$al,$fe[2]."-".$fe[1]."-".$fe[0],0,0);
		}	
		
		// Crea la card de la tarea
		$tarea = $tarea."
		<div class='card'>
			$archivo<hr>
			$mensajeTarea
			<p class='fecha'>Fecha de entrega:</p>
			<p class='entrega'>$entrega</p>	
		</div>";
	}

	// Imprime el contenido de la vista, titulo, subtitulo y materia
	echo "<br><br><center><div class='w3-card w3-padding-large' style='width:95%;'><h3 class='rojo_oficial'>$subtitulo</h3><br>";

	// Imprime el material del alumno
	echo "<div align='left'>$contenido<br></div></div>";

	// Verifica si tiene tareas
	if($ct != 0){
		// Link del detalle de la tarea
		$liga = "materia_tema.php?mat=$mat&tema=$tema&sub=$sub";

		// Se crea el boton de 'seccion de tareas'
		$seccion_tareas = "<a id='b_tarea' href='tarea_seccion.php'>Enviar evidencia</a>";

		// Se imprime la tarea junto a sus respectivos contenedores
		echo $container_inicio.$tarea.$container_fin.$seccion_tareas.$container_fin;

	}

	menu_navega($ant,$ad,$mat);
?>
	</body>
</html>
