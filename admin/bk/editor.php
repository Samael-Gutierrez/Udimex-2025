<?php 
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();
include("../js/mate.js");
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" lang="es-es">
	<link rel='stylesheet' href='estilo/ed_estilo.css'>
	<script type="text/javascript" src="../js/editor.js"></script>
	<script type='text/javascript' src='../js/jquery-1.6.4.js'></script> 

	<script>
		$(document).ready(function(){  	
			$('#guarda').click(function() {  
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
					success: function(){
						$('#guarda').html(data);
       						alert( "El tema se guardo satisfactoriamente");
      					},
					error: function(){
       						alert( "No se pudo guardar el tema !!!");
      					}
				});
    			});  
		
 	
			$('#bte').click(function() {  
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
						imagen(ima);
						
      					},
					error: function(){
       						alert( "No se pudo guardar el tema !!!");
      					}
				});
    			});
		}); 

	</script>
	<script>
		function nuevo(d){
			top.window.location="material_crea.php?tema="+d; 
		}
	</script>
</head>
<body>

<?php
usuario();
menu_i();

echo "<br><br><br>";

if ($_GET){
	$id=$_GET['cont'];
	$res=b_contenido($id,"orden");
	$fila=mysqli_fetch_assoc($res);
	mysqli_free_result($res);
	echo $fila['modulo'].".- ".$fila['nombre']."<br>".$fila['titulo']."<br>";

	$sub=$fila['subtitulo'];
	$cont=$fila['contenido'];
	$tema=$fila['id_tema'];

	form($sub,$cont,$tema,$id);
	
}

function form($sub,$cont,$tema,$id){
echo "
	<center><input type='text' name='sub' id='sub' value='$sub'></center>

<br>
	<div id='her'>
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


		<button onclick="html(1);" id='html' title='HTML'>HTML</button>
	</div>

	<div id='texto' hidden>
		<button onclick="html(2);" id='html' title='HTML'>TEXTO</button>
	</div>

	

<?php
	if ($cont==""){
		$cont="<link rel='stylesheet' href='estilo/ed_estilo.css'>&nbsp;";
	}
	echo "
	<div id='editor' contenteditable='true'>
		$cont
	</div>
	<input type='hidden' value='$tema' name='tema' id='tema'><center><br><br>

	<input type='hidden' value='$id' name='id' id='id'>
	<input type='submit' value='Actualizar' name='accion' id='guarda' style='width:100px; height:40px'>
	</center></div>";
}

?>

<?php

$directorio = opendir("../alf/im");
$i=0;

echo "<div id='galeria' class='flotante' hidden>
	<table border='0' width='100%'><tr><td width='30%'></td><th id='tit'>Imágenes</th><td align='right' width='30%'><a href='#' onclick='o_gal();'><img src='../imagen/cierra.png' title='Cerrar sesión' width='25px'></a></td></tr></table><hr>

<div align='center'><div id='subtema'>Selecciona la imagen que deseas subir </div><br><br>

<form method='POST' id='form' name='form'>
	<input type='file' name='archivo'><br><br>
	<input type='button' name='bte' id='bte' value='Subir'>
</form>
<div id='res'></div></div>

</div></div>

<div id='funciones' class='flotante' hidden><table border='0' width='100%'><tr><td width='30%'></td><th id='tit'>Funciones Matemáticas</th><td align='right' width='30%'><a href='#' onclick='o_fun();'><img src='../imagen/cierra.png' title='Cerrar sesión' width='25px'></a></td></tr></table><hr><div id='imagenes'>
<table border='0' align='center'>
	<tr><td></td><th>Num</th><th>Den</th></tr>
	<tr>
		<th align='right'>Fracción</th>
		<th><input type='text' id='num' size='8'></th>
		<th><input type='text' id='den' size='8'></th>
		<th><input type='button' value='Crear' onclick='i_fra();'></th>
	</tr>
	<tr><td><br></td></tr>
	<tr><td></td><th colspan='2'>Número</th></tr>
	<tr>
		<th align='right'>Raíz Cuadrada</th>
		<th colspan='2'><input type='text' id='n' size='16'></th>
		<th><input type='button' value='Crear' onclick='i_raiz();'></th>	
	</tr>
</table></div></div>";
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

<script>f_alin('iz');</script>
</body>
</html>
