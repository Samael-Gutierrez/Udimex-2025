<?php
	session_start();
	
	$dir="../general/";
	include($dir."php/alumno.php");
	include($dir."db/basica.php");
	include($dir."db/pagos.php");
	include($dir."db/materias.php");
	include($dir."db/tarea.php");
	
	// Referencias
	$adicional="<link rel='stylesheet' href='".$dir."css/tarea.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>";
	cabeza("Tarea - Udimex",$adicional,$dir);

	permiso();
?>
	
<body>
<div id='loader' class='loader'></div>
<?php
	if(isset($_GET['mensaje'])){
		$mensaje = $_GET['mensaje'];
		echo "
			<script>
				alert('$mensaje');
			</script>
		";
	}else{
		echo "
			<script>
				console.log('Todo correcto');
			</script>
		";
	}
	menu($dir);

	$mat=$_SESSION['materia'];
	$tema=$_SESSION['titulo'];
	$sub=$_SESSION['apunte'];
	$datos=b_contenido($sub,"orden_alumno");
	$fila=mysqli_fetch_assoc($datos);
	$subtitulo=$fila['subtitulo'];

	// Imprimer los datos de la materia
	echo "<center><table border='0' width='800px' id='barra' rules='rows'>
			<tr bordercolor='#bcd35f'>
				<td rowspan='2' align='center' id='materia'><h3>".$fila['nombre']."</h3></td>
				<td align='right'><h6>".$fila['titulo']."&nbsp; &nbsp; </h6></td>
			</tr>
			<tr>
				<td align='right'><h6>Módulo ".$fila['modulo']."&nbsp; &nbsp; </h6></td>
			</tr>
		</table></center>";

	// Ni idea flaco, bueno, creo que obtiene el contenido de las tareas
	//Obtiene el contenido de un material de estudio, NO lo obtiene de la bd aunque existe el campo, para aligerar la BD
	//se crearon fucheros txt con extensión .alf
	$fichero=$_SESSION['apunte'];
	$archivo="apuntes/".$fichero.".alf";	
	$contenido = file_get_contents($archivo);
	
	$tarea="";

	// Aún tengo dudas sobre lo que lo que hace pero creo que asigna lo obtenido de las tareas a la variable datos2
	//Aquí busca una tarea o tareas asociadas a un apunte, son también ficheros txt con extensión .alf
	$al=$_SESSION["g_id"];
	$datos2=b_tarea($fichero);
	
	$ct=0;
	$container_inicio =" <div class='main-container'>";		
	$container_fin="</div>";

	while($fila2=mysqli_fetch_assoc($datos2)){
		$fichero=$fila2['id_tarea'];
		$archivo="tarea/".$fichero.".alf";	
		$archivo = file_get_contents($archivo);
		$dias=$fila2['dias'];
		$entrega=fecha_suma(date('Y-m-d'),$dias);
		$hoy1 = date('d-m-y');
		$entrega_estimada = new DateTime($entrega);
		$hoy2 = new DateTime($hoy1);
		$diferencia = $hoy2->diff($entrega_estimada);

		$mensaje = ($hoy2 > $entrega_estimada) ? "<input type='hidden' value=0>" : "<input type='hidden' value=1>";

		$mensaje_alumno = ($hoy2 > $entrega_estimada) ? "<p class='incorrecta'>Último día de entrega: $entrega</p>" : "<p>Fecha de entrega: <span class='correcta'>".$entrega."</span></p>";

		$ct=$ct+1;

		$contadorTarea = cuenta_tarea($fichero,$al);

		while($fila = mysqli_fetch_assoc($contadorTarea)){
			$contador = $fila['r'];
		}

		if($contador < 1) {
			$mensajeTarea = "<p class='incorrecta'>Sin tareas registradas</p>";
			$contador = 0;
		}else{
			$mensajeTarea = "<p class='correcta'>Con $contador archivo/s registrado/s</p>";
		}

		// Crea la card de la tarea
		$tarea = $tarea."
		<div class='container-tareas'>
            <div class='toggle'>
                <p>Tarea $ct</p>
            </div>
            <div class='part1'>
                <label for='' class='campo'>Instrucciones</label>
                <div class='instrucciones max-min'>
                    <p>".$archivo."</p>"
					.$mensaje_alumno.
                "</div>
            </div>
            <div class='part2'>
                <form action='tarea_subir.php' method='POST' class='formulario-tarea' id='homeWork-$ct' enctype='multipart/form-data'>
                    <input type='hidden' value='$al' name='id_alumno' id='id_alumno-$ct'>
                    <input type='hidden' value='$fichero' name='id_tarea' id='id_tarea-$ct'>
					<input type='hidden' value='$contador' name='contador' id='contador-$ct'>
					<textarea style='display:none;' name='imagen' id='base64_$ct' required></textarea>
					<input type='hidden' value='20' id='calidad_$ct'>
					
					$mensajeTarea

					<label for='fileInput' class='campo'>Subir tarea</label>
                    <input 
						type='file' 
						id='archivo_$ct' 
						name='archivo'
						accept='.png, .jpg, .jpeg, .pdf, .docx, .xlsx, .pptx, .zip, .py'
						onchange='procesarArchivo($ct)'
					>

                    <label for='descripcion' class='campo'>Descripcion</label>
                    <textarea type='text' id='descripcion-$ct' name='descripcion' required placeholder='Coloca una descripción o algun comentario sobre la tarea'></textarea>
                    <div class='centrar-boton'>
                        <button disabled id='btn_form_$ct' onclick='enviarFormulario($ct)' type='submit' value='Subir' class='btn-tarea-disabled'><i class='bi bi-check-lg'></i></button>
                    </div>
                </form>
            </div>
        </div>
		";
		
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
	}

	echo "<br><br><center><div class='w3-card w3-padding-large' style='width:95%;'><h3 class='rojo_oficial'>$subtitulo</h3><br>";

	echo $container_inicio.$tarea.$container_fin;

	if($ct<=2){
		echo "<br><br><br><br>";
	}

	if($ct==0){
		echo "<p class='sin-tareas'>Felicidades, no tienes tareas pendientes</p>";
	}
?>
<script>

	function enviarFormulario(id){
		let textarea = document.getElementById(`base64_${id}`).value.trim();
		const inputFile = document.getElementById(`archivo_${id}`);
		
		if (textarea === "") {
			alert("Falta archivo por procesar.");
			return;
		}
		
		if (textarea === "1"){
			console.log('Todo bien');
		}else{
			inputFile.remove();
		}
	}

	function showLoader(){
		document.getElementById('loader').style.display = 'flex';
	}

	function hiddeLoader(mensaje){
		setTimeout(function() {
				document.getElementById('loader').style.display = 'none';
				alert(`${mensaje} para enviar.`);
        	}, 500);
	}

    async function procesarArchivo(id) {
		const inputFile = document.getElementById(`archivo_${id}`);
        const archivo = inputFile.files[0];
		const calidad = document.getElementById(`calidad_${id}`);
		const base64Input = document.getElementById(`base64_${id}`);
		const btn_form = document.getElementById(`btn_form_${id}`);

		if (archivo.type.startsWith("image/")) {
			showLoader();
        	console.log("El archivo es una imagen.");
			const blob = await comprimirImagen(archivo, parseInt(calidad.value));
			const base64Imagen = await blobToBase64(blob);
			base64Input.value = base64Imagen;
			hiddeLoader('Imagen lista');
        } else {
			showLoader();
			base64Input.value = '1';
			hiddeLoader('Archivo listo');
        }
		btn_form.disabled = false;
		btn_form.classList.remove("btn-tarea-disabled");
        btn_form.classList.add("btn-tarea");
	}

    function blobToBase64(blob) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(blob);
        });
    }

	const comprimirImagen = (imagencomoArchivo, porcentajeCalidad) => {
        return new Promise((resolve, reject) => {
            const canvas = document.createElement("canvas");
            const nva_imagen = new Image();

            nva_imagen.onload = () => {
                canvas.width = nva_imagen.width;
                canvas.height = nva_imagen.height;
                canvas.getContext("2d").drawImage(nva_imagen, 0, 0);
                canvas.toBlob(
                    (blob) => {
                        blob === null ? reject(blob) : resolve(blob);
                    }, "image/jpeg", 
                    porcentajeCalidad / 100
                );
            }
            nva_imagen.src = URL.createObjectURL(imagencomoArchivo);
        });
    }
</script>
</body>
</html>
