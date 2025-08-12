<?php 
session_start();
$dir="../../general/";
include($dir."php/admin.php");
include($dir."db/materias.php");
include($dir."db/basica.php");
include($dir."db/admin.php");
include($dir."db/tarea.php");

//permiso();
cabeza("Editor","",$dir);
include("../../general/js/mate.js");

?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" lang="es-es">
	<link rel='stylesheet' href='../estilo/ed_estilo.css'>
	<script type="text/javascript" src="../../general/js/editor.js"></script>
	<script type='text/javascript' src='../../general/js/jquery-2.1.1.js'></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 

	<script>
		$(document).ready(function(){  	

		
 	
			$('#bte').click(function() {  
				document.getElementById("carga").style.display='block';
				document.getElementById("editor").focus();
				

				var form = $('#form')[0];
				var data = new FormData(form);
				data.append("control", "correcto");
				$.ajax({
					url: 'c_img.php',
					type: 'POST',
					enctype: 'multipart/form-data',
					data: data,
					processData: false,
					contentType: false,
					cache: false,
					timeout: 600000,
					success: function (data) {
						ima=data;
						media(ima);
						document.getElementById("carga").style.display='none';
      					},
					error: function(){
       						alert( "No se pudo cargar el archivo, intenta de nuevo");
      					}
				});
    		});
			
			
			$('#b_tarea').click(function() {  
				dias=document.getElementById('dias').value;
				line=document.getElementById('lineamientos').innerHTML;
				ap=document.getElementById('id_apunte').value;
				
				
				$.ajax({
					url: 'guarda_tarea.php',
					type: 'POST',
					async: true,
					data: {
						dias: dias,
						ap: ap,
						line: line
					},
					success: function (data) {
						//guarda el apunte y recarga la página
						guarda();
					},
					error: function(){
						alert( "No se pudo guardar la tarea, intenta de nuevo");
					}
				});
    		});
			

			$('#bte2').click(function() {  

				document.getElementById("editor").focus();
				codigo="<center>"+document.getElementById("codigo").value + "</center><br>";
				youtube(codigo);
				
    			});
		});


	function media(datos){
		cadena=datos.split("@:@");
		tam=document.getElementById("tmed").value;

		if(cadena[0]=="IMAGEN"){
			imagen(cadena[1],tam);
		}
		if(cadena[0]=="VIDEO"){
			video(cadena[1],tam);
		}
		if(cadena[0]=="PDF"){
			pdf(cadena[1],tam);
		}
	}


	function med(tp){
		document.getElementById('tp').value=tp;
		if(tp==1){
			document.getElementById('fsub').style.display='block';
			document.getElementById('fvid').style.display='none';
			document.getElementById('tins').innerHTML='Selecciona una imagen en tu equipo';
		}
		if(tp==2){
			document.getElementById('fsub').style.display='block';
			document.getElementById('fvid').style.display='none';
			document.getElementById('tins').innerHTML='Selecciona una video en tu equipo';
		}
		if(tp==3){
			document.getElementById('fsub').style.display='none';
			document.getElementById('fvid').style.display='block';
		}
		if(tp==4){
			document.getElementById('fsub').style.display='block';
			document.getElementById('fvid').style.display='none';
			document.getElementById('tins').innerHTML='Selecciona una documento PDF en tu equipo';
		}
	}



	function guarda() {  
		v_sub=document.getElementById('sub').value;
		v_cont = document.getElementById("editor").innerHTML;
		v_tema = document.getElementById('tema').value;
		v_id = document.getElementById('id').value;
		$.ajax({
			url: 'curso_guarda.php',
			type: 'POST',
			async: true,
			data: {
        		sub: v_sub,
        		cont: v_cont,
        		tema: v_tema,
			id: v_id
    		},
			success: function(data){
				location.reload();
      		},
			error: function(){
      		}
		});
    }

	</script>
	<script>
		function nuevo(d){
			top.window.location="material_crea.php?tema="+d; 
		}
	</script>
<body>
<?php
usuario("../../","index.php");
menu_i();

echo "<br><br><br>";

if ($_GET){
	$id=$_GET['cont'];
	$res=b_contenido($id,"orden");
	$fila=mysqli_fetch_assoc($res);
	mysqli_free_result($res);

	echo $fila['modulo'].".- <a href='ordena.php?mat=".$fila['id_materia']."'>".$fila['nombre']."</a><br>".$fila['titulo']."<br>";

	$sub=$fila['subtitulo'];
	$tema=$fila['id_tema'];
	
	//Se cambio resultado de consulta contenido por fichero de contenido
	//$cont=$fila['contenido'];
	$archivo="../../alumno/apuntes/".$id.".alf";
	
	$cont = file_get_contents($archivo);
	form($sub,$cont,$tema,$id);
	
}




function form($sub,$cont,$tema,$id){



echo "
	<center><input type='text' name='sub' id='sub' value='$sub' required></center>

<br>
	<div id='her'>
		<input type='submit' value='Guardar' name='accion' id='guarda' style='width:100px; height:40px' onclick='guarda();'>
		
		<button onclick='nuevo($tema)' id='neg' title='Negrita'>+</button>";
?>
		<select name='tam' onChange="tam();" id='tam' title='Tamaño'>
			<option value='1'>Pequeña</option>
			<option value='2'>Chica</option>
			<option value='3' selected>Normal</option>
			<option value='4'>Mediana</option>
			<option value='5'>Grande</option>
			<option value='6'>Enorme</option>
			<option value='7'>Gigante</option>
		</select>
		<button onclick="ejecuta('bold');" id='neg' title='Negrita'>N</button>
		<button onclick="ejecuta('italic');" id='cur' title='Cursiva'>K</button>
		<button onclick="ejecuta('underline');" id='sub' title='Subrayado'>S</button>
		<button onclick="ch_color();" id='col' title='Color'>A</button>
		<button title='Alineación' id='fig_alin' onclick='ch_al();'></button>

		<button onclick="ejecuta('insertUnorderedList');" id='vin' title='Viñetas'>
			
			· -
			
		</button>
		<button onclick="ejecuta('insertOrderedList');" id='numero' title='Numeración'>
			1.- 
		</button>

		
		<button onclick="ch_gal();" id='fig_alin' title='Galería'>
			<svg height="25px" width="25px" class='c_alin'>
				<polygon points="1,24 6,15 12,20 18,15 24,25"/>
				<circle cx=12 cy=5 r=4 />
			</svg>
		</button>

		<button onclick="ch_fun();" id='fun' title='Insertar Funciones'><i>M</i><sup>2</sup></button>
		
		

		<button onclick="ch_gal();" id='fig_alin' title='imagen' hidden>
			<svg height="25px" width="25px" class='c_alin'>
				
				<rect width="4" height="4" x=1 y=1 />
				<rect width="4" height="4" x=11 y=1 />
				<rect width="4" height="4" x=21 y=1 />

				<polygon points="8,8 8,16 20,12"/>

				<rect width="4" height="4" x=1 y=20 />
				<rect width="4" height="4" x=11 y=20 />
				<rect width="4" height="4" x=21 y=20 />
			</svg>
		</button>
		
		<button onclick="ch_tarea();" id='fun' title='Guardar Tarea'>Tarea</button>



		<button onclick="html(1);" id='html' title='HTML'>HTML</button>
	</div>

	<div id='texto' hidden>
		<button onclick="html(2); guarda();" id='html' title='HTML'>TEXTO</button>
	</div>

	

<?php
	//Buscar tareas del apuntes/
	$tareas="";
	$datos=b_tarea($id);
	$inicio = "
		<div class='main-container'>
	";
	$fin = "</div>";

	while($fila=mysqli_fetch_assoc($datos)){
		$archivo="../../alumno/tarea/".$fila['id_tarea'].".alf"; 
		if(file_exists($archivo)){
			$archivo = file_get_contents($archivo);
			$id_tarea=$fila['id_tarea'];
			$ad="días";
			if($fila['dias']==1){
				$ad="día";	
			}
			$tareas = $tareas.
			"<div class='second-container'>
				<div class='botones'>
					<a onclick='enviarForm($id_tarea)'<i class='bi bi-pencil-fill'></i></a>
					<a onclick='borrarTarea($id_tarea)'><i class='bi bi-trash-fill'></i></a>
				</div>
				<div class='content'>
					<p>Entregar en <b>".$fila['dias']."</b> $ad</p>
					<div id='div-$id_tarea' contenteditable='true' class='tarea'>$archivo</div>
					<form method='POST' id='editar-$id_tarea' action='editarBorrar.php'>
						<input type='hidden' id='input-$id_tarea' name='tarea'>
						<input type='hidden' name='id' value='$id_tarea'>
						<input type='hidden' name='tipo' value='1'>
					</form>
					<form method='POST' id='borrar-$id_tarea' action='editarBorrar.php'>
						<input type='hidden' name='id' value='$id_tarea'>
						<input type='hidden' name='tipo' value='2'>
					</form>
				</div>
			</div>
			<script>
				const div$id_tarea = document.getElementById('div-$id_tarea');
				div$id_tarea.addEventListener('input', () => {
					const input$id_tarea = document.getElementById('input-$id_tarea');
					input$id_tarea.value = div$id_tarea.innerHTML;
				});
			</script>
			"
			;
		}
	}

	if ($cont==""){
		$cont="<link rel='stylesheet' href='../general/estilo/ed_estilo.css'>&nbsp;";
	}
	echo "
	<div id='editor' contenteditable='true'>
		$cont
	</div>
	$inicio $tareas $fin

	<input type='hidden' value='$tema' name='tema' id='tema'><center><br><br>

	<input type='hidden' value='$id' name='id' id='id'>
	</center></div>";
}




//$directorio = opendir("../../alf/im");
$i=0;

echo "<div id='galeria' class='flotante' hidden>
	<table border='0' width='100%'><tr><td width='30%'></td><th id='tit'>Medios Digitales</th><td align='right' width='30%'><a href='#' onclick='o_gal();'><img src='../../general/imagen/cierra.png' title='Cerrar sesión' width='25px'></a></td></tr></table><hr>

<div align='center'><div id='subtema'>Selecciona el tipo de archivo que deseas subir</div><br><br>

<img src='../../general/imagen/imagen.png' height='50px' onclick='med(1);'> &nbsp; &nbsp; &nbsp; &nbsp; 
<img src='../../general/imagen/video.png' height='50px' onclick='med(2);'> &nbsp; &nbsp; &nbsp; &nbsp; 
<img src='../../general/imagen/youtube.png' height='50px' onclick='med(3);'> &nbsp; &nbsp; &nbsp; &nbsp; 
<img src='../../general/imagen/pdf.png' height='50px' onclick='med(4);'><br><hr>


<div id='fsub' hidden><form method='POST' id='form' name='form'>
	<div class='tgris' id='tins'></div><br><br>
	<input type='file' name='archivo'><br>
	Tamaño en porcentaje: <input type='number' min='0' max='100' value='80' step='10' size='5' id='tmed'>%<br><br>
	<input type='hidden' name='tp' id='tp'>
	<input type='button' name='bte' id='bte' value='Subir'><br><br>
	<img src='../../general/imagen/carga.gif' width='10%' hidden id='carga'>
</form></div>



<div id='fvid' hidden>

<form method='POST' id='form' name='form'>
	<div class='tgris'>Videos de YouTube</div>
	<table border='0'><tr><td>
	1.- Entra a <a href='http://youtube.com' target='_blank'>Youtube</a><br>
	2.- Busca tu video y da clic en compartir<br>
	3.- Copia y pega en el recuadro de abajo el código que apaece en la opción 'Insertar'
	</td></td></table><br>
	<textarea name='codigo' id='codigo' cols='50' rows='7'></textarea>
<br>
	<input type='button' name='bte2' id='bte2' value='Insertar'>
</form></div>


<div id='res'></div></div>

</div></div>

<div id='funciones' class='flotante' hidden><table border='0' width='100%'><tr><td width='30%'></td><th id='tit'>Funciones Matemáticas</th><td align='right' width='30%'><a href='#' onclick='o_fun();'><img src='../../general/imagen/cierra.png' title='Cerrar sesión' width='25px'></a></td></tr></table><hr><div id='imagenes'>
<table border='0' align='center'>
	<tr><td></td><th>Num</th><th>Den</th></tr>
	<tr>
		<th align='right'>Fracción</th>
		<th><input type='text' id='num' size='8'></th>
		<th><input type='text' id='den' size='8'></th>
		<th><input type='button' value='Crear' onclick='i_fra(); guarda();'></th>
	</tr>
	<tr><td><br></td></tr>
	<tr><td></td><th colspan='2'>Número</th></tr>
	<tr>
		<th align='right'>Raíz Cuadrada</th>
		<th colspan='2'><input type='text' id='n' size='16'></th>
		<th><input type='button' value='Crear' onclick='i_raiz(); guarda();'></th>	
	</tr>
</table></div></div>";

// <img src='../../general/imagen/cierra.png' title='Cerrar sesión' width='25px'>

//Muestra la sección de tareas
echo "<div id='tarea' class='flotante' hidden>
	<table border='0' width='100%'>
		<tr>
			<td width='30%'></td>
			<th id='tit'>Tareas</th>
			<td align='right' width='30%'>
				<a href='#' onclick='o_tarea();'><i class='bi bi-x-circle-fill exit'></i></a>
			</td>
		</tr>
	</table><hr>

<div align='center'><div id='subtema'>Escribe las instrucciones y lineamientos para la tarea</div>


<form method='POST' id='f_tarea' name='f_tarea'>
	<div name='lineamientos' id='lineamientos' contenteditable='true'></div>
	<label for='dias' id='label-dias'>Días para entrega:</label>
	<input type='number' name='dias' id='dias' min='1' value='1'><br>
	<input type='hidden' name='id_apunte' id='id_apunte' value='$id'>
	<input type='button' name='b_tarea' id='b_tarea' value='Guardar Tarea'><br><br>
	<img src='../../general/imagen/carga.gif' width='10%' hidden id='carga'>
</form></div></div>";
?>

	<div id='colores' hidden>
		<button onclick="cambia_color('#000000');" id='b_color' style='background:#000000;'></button>
		<button onclick="cambia_color('#e60000');" id='b_color' style='background:#e60000;'></button>
		<button onclick="cambia_color('#ff9900');" id='b_color' style='background:#ff9900;'></button>
		<button onclick="cambia_color('#ffff00');" id='b_color' style='background:#ffff00;'></button>
		<button onclick="cambia_color('#008a00');" id='b_color' style='background:#008a00;'></button>
		<button onclick="cambia_color('#0066cc');" id='b_color' style='background:#0066cc;'></button>
		<button onclick="cambia_color('#9933ff');" id='b_color' style='background:#9933ff;'></button><br>

		<button onclick="cambia_color('#ffffff');" id='b_color' style='background:#ffffff;'></button>
		<button onclick="cambia_color('#facccc');" id='b_color' style='background:#facccc;'></button>
		<button onclick="cambia_color('#ffebcc');" id='b_color' style='background:#ffebcc;'></button>
		<button onclick="cambia_color('#ffffcc');" id='b_color' style='background:#ffffcc;'></button>
		<button onclick="cambia_color('#cce8cc');" id='b_color' style='background:#cce8cc;'></button>
		<button onclick="cambia_color('#cce0f5');" id='b_color' style='background:#cce0f5;'></button>
		<button onclick="cambia_color('#ebd6ff');" id='b_color' style='background:#ebd6ff;'></button><br>

		<button onclick="cambia_color('#bbbbbb');" id='b_color' style='background:#bbbbbb;'></button>
		<button onclick="cambia_color('#f06666');" id='b_color' style='background:#f06666;'></button>
		<button onclick="cambia_color('#ffc266');" id='b_color' style='background:#ffc266;'></button>
		<button onclick="cambia_color('#ffff66');" id='b_color' style='background:#ffff66;'></button>
		<button onclick="cambia_color('#66b966');" id='b_color' style='background:#66b966;'></button>
		<button onclick="cambia_color('#66a3e0');" id='b_color' style='background:#66a3e0;'></button>
		<button onclick="cambia_color('#c285ff');" id='b_color' style='background:#c285ff;'></button><br>

		<button onclick="cambia_color('#888888');" id='b_color' style='background:#888888;'></button>
		<button onclick="cambia_color('#a10000');" id='b_color' style='background:#a10000;'></button>
		<button onclick="cambia_color('#b26b00');" id='b_color' style='background:#b26b00;'></button>
		<button onclick="cambia_color('#b2b200');" id='b_color' style='background:#b2b200;'></button>
		<button onclick="cambia_color('#006100');" id='b_color' style='background:#006100;'></button>
		<button onclick="cambia_color('#0047b2');" id='b_color' style='background:#0047b2;'></button>
		<button onclick="cambia_color('#6b24b2');" id='b_color' style='background:#6b24b2;'></button><br>

		<button onclick="cambia_color('#444444');" id='b_color' style='background:#444444;'></button>
		<button onclick="cambia_color('#5c0000');" id='b_color' style='background:#5c0000;'></button>
		<button onclick="cambia_color('#663d00');" id='b_color' style='background:#663d00;'></button>
		<button onclick="cambia_color('#666600');" id='b_color' style='background:#666600;'></button>
		<button onclick="cambia_color('#003700');" id='b_color' style='background:#003700;'></button>
		<button onclick="cambia_color('#002966');" id='b_color' style='background:#002966;'></button>
		<button onclick="cambia_color('#3d1466');" id='b_color' style='background:#3d1466;'></button><br>
	</div>

	<div id='alin' hidden>
		<button id='iz' onclick="f_alin('iz');">
			<svg height="25px" width="25px" class='c_alin'>
				<line x1="3" y1="5" x2="17" y2="5" />	
			  	<line x1="3" y1="10" x2="22" y2="10" />
				<line x1="3" y1="15" x2="17" y2="15" />			
				<line x1="3" y1="20" x2="22" y2="20" />
			</svg>
		</button>

		<button id='ce' onclick="f_alin('ce');">
			<svg height="25px" width="25px" class='c_alin'>
				<line x1="6" y1="5" x2="20" y2="5" />
			  	<line x1="3" y1="10" x2="23" y2="10" />
				<line x1="6" y1="15" x2="20" y2="15" />			
				<line x1="3" y1="20" x2="23" y2="20" />
			</svg>
		</button><br>

		<button id='de' onclick="f_alin('de');">
			<svg height="25px" width="25px" class='c_alin'>
				<line x1="8" y1="5" x2="22" y2="5" />
			  	<line x1="3" y1="10" x2="22" y2="10" />
				<line x1="8" y1="15" x2="22" y2="15" />			
				<line x1="3" y1="20" x2="22" y2="20" />
			</svg>
		</button>

		<button id='ju' onclick="f_alin('ju');">
			<svg height="25px" width="25px" class='c_alin'>	
			  	<line x1="3" y1="5" x2="22" y2="5" />
				<line x1="3" y1="10" x2="22" y2="10" />
				<line x1="3" y1="15" x2="22" y2="15" />
				<line x1="3" y1="20" x2="22" y2="20" />
			</svg>
		</button>
	</di>

<script>
	f_alin('iz');

	function enviarForm(id){
		var formData = $('#editar-'+id).serialize();
		$.ajax({
			url: 'editarBorrar.php',
			type: 'POST',
			data: formData,
			success: function(respuesta) {
				console.log('Respuesta del servidor:', respuesta);
				location.reload();
			},
			error: function(xhr, status, error) {
				console.error('Error al enviar el formulario:', error);
				alert('Hubo un error al enviar el formulario');
			}
		});
	}

	function borrarTarea(id){
		var formData = $('#borrar-'+id).serialize();
		$.ajax({
			url: 'editarBorrar.php',
			type: 'POST',
			data: formData,
			success: function(respuesta) {
				console.log('Respuesta del servidor:', respuesta);
				location.reload();
				alert('Tarea eliminada.');
			},
			error: function(xhr, status, error) {
				console.error('Error al enviar el formulario:', error);
				alert('Hubo un error al enviar el formulario');
			}
		});
	}
</script>


</body>
</html>
