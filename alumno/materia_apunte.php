<?php
	session_start();
	$dir="../general/";
	include($dir."php/alumno.php");
	include($dir."db/basica.php");
	include($dir."db/pagos.php");
	include($dir."db/materias.php");
	include($dir."db/tarea.php");
	
	$mat=$_SESSION['materia'];
	$apunte=$_GET['apunte'];
	$_SESSION['apunte']=$apunte;
	$al=$_SESSION["g_id"];
	$ant="";
	$sig="";
	$tarea="";
	
	cabeza("Estudiando ... - Udimex","<script src='".$dir."js/mate.js'></script>",$dir);

	//verifica que la sesión de usuario exista
	permiso();
	
	//verifica que el alumno tenga pago vigente
	$datos=b_cad($al);
	if($fila=mysqli_fetch_assoc($datos)){
	}
	else{
		echo "<script>window.location.href ='../alumno/index.php'</script>";
	}
	
	//verifica que el material corresponda a la materia


	$datos=b_contenido($apunte);
	if($fila=mysqli_fetch_assoc($datos)){
		//Verifica que el material corresponda a la materia
		if($fila['id_materia']!=$mat){
			echo "<script>window.location.href ='materia_indice.php?mat=$mat'</script>";
		}
		
		$materia=$fila['nombre'];
		$titulo=$fila['titulo'];
		$modulo=$fila['modulo'];
		$subtitulo=$fila['subtitulo'];
		
		$_SESSION['titulo']=$titulo;

		$encabezado="<center><table border='0' width='800px' id='barra' rules='rows'>
				<tr bordercolor='#bcd35f'>
					<td rowspan='2' align='center' id='materia'><h3>$materia</h3></td>
					<td align='right'><h6>$titulo&nbsp; &nbsp; </h6></td>
				</tr>
				<tr>
					<td align='right'><h6>Módulo $modulo&nbsp; &nbsp; </h6></td>
				</tr>
			</table></center>";

		$archivo="apuntes/".$apunte.".alf";	
		$contenido = file_get_contents($archivo);
		
		$contenido="<br><br>
		<center>
			<div class='w3-card w3-padding-large' style='width:95%;'>
				<h3 class='rojo_oficial'>$subtitulo</h3><br>
				<div align='left'>$contenido<br></div>
			</div>";
		
		$tarea="";

		$datos2=b_tarea($apunte);
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
				$contador = $fila['r'];	
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
		
		// Verifica si tiene tareas
		if($ct>0){
			// Se crea el boton de 'seccion de tareas'
			$seccion_tareas = "<a id='b_tarea' href='tarea_seccion.php'>Enviar evidencia</a>";

			// Se imprime la tarea junto a sus respectivos contenedores
			$tarea=$container_inicio.$tarea.$container_fin.$seccion_tareas.$container_fin;
		}
		
		//Guarda el material en orden_alumno solo para indicar que ya se habilitó el tema
		g_orden_alumno($al,$apunte);
		
		
		echo "	<body>";
	
		menu($dir);
		
		//Imprime el encabezado de la materia
		echo $encabezado;

		// Imprime el apunte
		echo $contenido;

		//Imprime tareas
		echo $tarea;
		
		
		echo "</center>";

	}
	
	//obtiene elementos del índice completo
	$pagina=$_SESSION['pagina'];
	
	//Obtiene la posición del apunte actual dentro del índice
	$posicion = array_search($apunte, $pagina);
	$max=count($pagina)-1;
	
	if($posicion>0){
		$ant=$posicion-1;
		$ant=$pagina[$ant];
		$ant="<td align='left'>
			<a href='materia_apunte.php?apunte=$ant'>
				<img src='../general/imagen/at.png' width='50'>
			</a>
		</td>";
	}

	if($posicion<$max){
		$sig=$posicion+1;
		$sig=$pagina[$sig];
		$sig="<td align='right'>
			<a href='materia_apunte.php?apunte=$sig'>
				<img src='../general/imagen/ad.png' width='50'>
			</a>
		</td>";
	}
	
	menu_navega($ant,$sig,$mat,$dir);
?>
		
	</body>
</html>
