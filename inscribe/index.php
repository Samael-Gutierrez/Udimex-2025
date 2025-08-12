<?php 
include("../general/consultas/basic.php");
include("../general/consultas/promotor.php");
include("../general/consultas/carreras.php");
include("../general/consultas/usuario.php");

$mensaje="Bienvenido a la <b>Universidad Digital de México</b>. A continuación te pediremos algunos datos para activar tu plataforma en línea.
<br><br>";

$datos=b_nivel();
$carrera="<select name='carreras'>";
while($fila=mysqli_fetch_assoc($datos)){
	$carrera=$carrera."<option value='".$fila['id_nivel']."'>".$fila['nombre']."</option>";
}
$carrera=$carrera."</select>";

$modalidad="<input type='radio' value='1' name='mo' id='m'> Presencial<br>
<input type='radio' value='2' name='mo' id='g' selected> Línea<br>
<input type='radio' value='3' name='mo' id='x'> Mixto<br>";

$inscripcion="";
$inicio="";
$promocion="";

$tel='7226352407';
$promotor="Alfredo T. Dorado";
if ($_GET){
	$id=$_GET['id'];
	$mensaje="Bienvenido a la <b>Universidad Digital de México</b>, estás a punto de inscribirte al plan de estudios de <b>PREPARATORIA.</b><br>
	A continuación te pediremos algunos datos para activar tu plataforma en línea.<br><br>";

	$datos=b_liga2($id);
	if($fila=mysqli_fetch_assoc($datos)){
		$datos2=b_nivel2($fila['id_nivel']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$carrera=$fila2['nombre'];
		}

		
		$datos2=busca_tel2($fila['id_usuario']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$tel=$fila2['numero'];	
		}

		$datos2=b_us($fila['id_usuario']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$promotor=$fila2['nombre']." ".$fila2['ap_pat'];	
		}
			
	}
	if($fila['modalidad']==1){
		$modalidad=" Presencial";
	}
	if($fila['modalidad']==2){
		$modalidad=" En línea";
	}
	if($fila['id_promocion']>0){
		$datos2=b_promocion2($fila['id_promocion']);
		if($fila2=mysqli_fetch_assoc($datos2)){
				$promocion="<br><font color='#ff5555'>* Cuentas con una PROMOCIÓN ESPECIAL PARA TÍ</font><hr>".$fila2['descripcion'];		
		}

	}
	
	$inscripcion="<tr><td>Periodo de inscripción: </td><td>Del ".$fila['fi']." al ".$fila['ff']."</td></tr>";
	$inicio="<tr><td>Inicio de curso: </td><td>".$fila['fc']."</td></tr>";
	$cert="<tr><td>Certificación: </td><td>".$fila['certificado']."</td></tr>";
	$cins="<tr><td>Inscripción: </td><td>$600</td></tr>";
	$ccol="<tr><td>Mensualidad: </td><td>$1300</td></tr>";
	$ccert="<tr><td>Certificaión: </td><td>$4250</td></tr>";
}

	$tel2=str_split($tel);
	$tel2=$tel2[0].$tel2[1].$tel2[2]." ".$tel2[3].$tel2[4].$tel2[5]." ".$tel2[6].$tel2[7].$tel2[8].$tel2[9];
$whats="<h2>
		¿Tienes alguna duda? Contacta a tu asesor 
	</h2>
	<a href='https://api.whatsapp.com/send/?phone=521$tel&text=Hola%2C+estoy+realizando+mi+inscripci%C3%B3n+a+Udimex+por+internet%2C+pero+tengo+una+duda.+%C2%BFPuedes+apoyarme%3F' target='blank'>
	
		<table border='0'>
			<tr>
				<td><img src='../general/imagen/what.png' width='50px'></td>
				<td><h3>$tel2<br>$promotor</h3></td>
			</tr>
		</table>
	</a><br>";

$mensaje=$mensaje.$whats;

?>





<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script type='text/javascript' src='../general/js/jquery-1.6.4.js'></script>


<script>
	var error="";
	var cerror;

	function b_us1(){ 
		usuario=document.getElementById("user").value;
		var url= 'compara.php';
		$.ajax({
			type:'POST',
			data: {usuario:usuario},
			url: url,
			success: function(data){ 
				if(data==1){
					error=error+"◉ El usuario ya existe, intenta con otro<br>";
					document.getElementById('error').innerHTML=error;
					document.getElementById('error').style.display="block";
					document.getElementById('user').style.background='#ffdddd';
				}
				else{
					if(cerror==0){
						document.getElementById('error').innerHTML="";
						document.getElementById('error').style.display="none";
						document.getElementById('user').style.background='none';
					}
				}
			}
		});

	}

	function valida(){
		cerror=0;
		error="";

		blanco("user","◉ Debes escribir un nombre de usuario<br>");
		b_us1();
		blanco("clave","◉ Debes escribir una clave de acceso<br>");
		blanco("nombre","◉ Debes escribir tu nombre<br>");
		blanco("ap","◉ Debes escribir tu apellido paterno<br>");
		blanco("fdn","◉ Debes escribir tu fecha de nacimiento<br>");
		
		if(cerror==0){
			document.getElementById('dp').style.display="none";
			document.getElementById('dom').style.display="block";
		}
		else{
			document.getElementById('error').innerHTML=error;
			document.getElementById('error').style.display="block";
		}
		
	}

	function valida2(){
		cerror=0;
		error="";

		blanco("copo","◉ Debes escribir tu código postal<br>");
		blanco("edo","◉ Debes escribir el estado<br>");
		blanco("mun","◉ Debes escribir el municipio<br>");
		blanco("col","◉ Debes escribir la colonia<br>");
		blanco("enca","◉ Debes escribir la calle<br>");
		blanco("telef","◉ Debes escribir tu número telefónico<br>");
		
		
		if(cerror==0){
			//document.getElementById('dp').style.display="none";
			//document.getElementById('dom').style.display="block";
		}
		else{
			document.getElementById('error2').innerHTML=error;
			document.getElementById('error2').style.display="block";
		}
		
	}

	function blanco(elemento, mensaje){
		cad=document.getElementById(elemento).value;
		cad=cad.trim();
		if(cad.length<1){
			error=error+mensaje;
			cerror=cerror+1;
			document.getElementById(elemento).style.background='#ffdddd';
		}
		else{
			document.getElementById(elemento).style.background='none';
		}
	}

	function c_dir(){ 
		cp=document.getElementById("copo").value;
		var url= 'dir.php';
		$.ajax({
			type:'POST',
			data: {cp:cp},
			url: url,
			success: function(data){ 
				document.getElementById("dir").innerHTML=data;
			}
		});

	}
</script>


</head>
<body>

<?php










echo "
<center><img src='../general/imagen/logo.png' width='500px'>
<div style='width:90%' class='w3-margin w3-card'>
	<div class='w3-container w3-blue w3-margin' id='inicio'>
		<h3>Formato de Inscripción
		</h3>
	</div>

	$mensaje
	<form method='POST' action='g_prospecto.php'>
		<div style='width:70%' id='dp'>
			<div class='w3-card'><h4 class='w3-blue'>Acceso y Nombre</h4>
				Tu usuario y contraseña te dará acceso a nuestra plataforma.<br>¡Guarda tus datos en un lugar seguro !.<br><br>
			
				<div  align='center' >
					<input type='text' name='user' id='user' onchange='b_us1();' placeholder='Usuario'>
					<input type='password' name='clave' id='clave' placeholder='Clave'><br>
				</div>

				<br><hr>
				¿Cuál es tu nombre?<br><br>
				<input type='text' name='nombre' id='nombre' placeholder='Nombre(s)'>
				<input type='text' name='ap' id='ap' placeholder='Apellido Paterno'>
				<input type='text' name='am' id='am' placeholder='Apellido Materno'><br><hr>
				¿Cuál es tu fecha de nacimiento?<br><br><input type='date' name='fdn' id='fdn'>
				<br><br>
				<div class='w3-panel w3-red' id='error' hidden></div>
			</div><br><br>
			<input type='button' class='w3-button w3-purple w3-round-large' value='Siguiente' onclick='valida();' id='sig'>
		</div>


		<div id='dir'></div>

		<div style='width:70%' id='dom'>
			<div class='w3-card'><h4 class='w3-blue'>Domicilio y Contacto</h4>

				Escribe tu domicilio completo<br><br>
				<input maxlength='5' type='text' name='copo' id='copo' placeholder='Código Postal' onchange='c_dir();'>
				<input list='lestado' name='edo' id='edo' placeholder='Estado' autocomplete='off'>
				<input list='lmunicipio' name='mun' id='mun' placeholder='Municipio' autocomplete='off'>
				<input list='lcolonia' name='col' id='col' placeholder='Colonia' autocomplete='off'>
				<input list='lcalle' name='enca' id='enca' placeholder='Calle' autocomplete='off'>
				<input type='text' name='nume' id='nume' placeholder='Número' autocomplete='off'><hr>

				Escribe tu número de teléfono y tu correo electrónico<br><br>
				<input maxlength='10' type='text' name='telef' id='telef' placeholder='Teléfono'>
				<input type = 'email' name='ce' id='ce' placeholder='e-mail'>
				<br><br>
				<div class='w3-panel w3-red' id='error2' hidden></div>
			</div><br><br>
			<input type='button' class='w3-button w3-purple w3-round-large' value='Siguiente' onclick='valida2();' id='sig2'>
		</div>


		<div style='width:70%' id='dom'>
			<div class='w3-card'><h4 class='w3-blue'>Datos Escolares</h4>
				<table border='0'>
					<tr><td>Plan de estudios:</td><td>$carrera</td></tr>
					<tr><td>Modalidad:</td><td>$modalidad</td></tr>
					$inscripcion
					$inicio
					$cert
				</table>$promocion<br><br>
			</div><br><br>
			<input type='button' class='w3-button w3-purple w3-round-large' value='Siguiente' onclick='valida2();' id='sig2'>
		</div>
	</form>";




?>

</body>
</html>
