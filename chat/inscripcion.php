<?php
$fecha_actual=date('Y-m-d');
$min=date("Y-m-d",strtotime($fecha_actual. "+ 10 days")); 
?>

<link rel='stylesheet' href='estilo/venta.css'>

<form id='form'>
<div id='inscripcion'>
	<div id='c1'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor' id='c_correo'>Escribe tu correo electrónico</div><br>
		<input type='text' name='correo' id='correo' placeholder='Escribe tu e-mail' class='dato inicio'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='valida_correo();' value=' > ' class='sig'>
	</div>
	<div id='c2' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor' id='cl1'>Elige una contraseña</div><br>
		<input type='password' name='clave' id='clave' placeholder='Escribe tu clave' class='dato inicio'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c1","c2");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c3","c2");' value=' > ' class='sig'>
	</div>
	<div id='c3' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Repite tu misma contraseña</div><br>
		<input type='password' name='clave2' id='clave2' placeholder='De nuevo tu clave' class='dato inicio'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c2","c3");' value=' < ' class='sig'>
		<input type='button' onclick='valida_cl();' value=' > ' class='sig'>
	</div>
	<div id='c4' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Escribe tu nombre</div><br>
		<input type='text' name='nombre' placeholder='Tu nombre(s)' class='dato'>
		<input type='text' name='ap' placeholder='Tu apellido paterno' class='dato'>
		<input type='text' name='am' placeholder='Tu apellido materno' class='dato'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c3","c4");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c5","c4");' value=' > ' class='sig'>
	</div>

	<div id='c5' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Escribe tu CURP</div><br>
		<input type='text' name='curp' placeholder='Tu CURP' class='dato inicio'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c4","c5");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c6","c5");' value=' > ' class='sig'>
	</div>
	<div id='c6' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Escribe tu Teléfono</div><br>
		<input type='text' name='tel' placeholder='Tu Teléfono' class='dato inicio'><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c5","c6");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c7","c6");' value=' > ' class='sig'>
	</div>
	<div id='c7' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>¿Que modalidad prefieres para terminar tu Prepa?</div><br><br>
		<input type='button' onclick='elige("22","c8","c7","mod");' value=' Prepa Examen único (aplicación gratuita) ' class='sig'>
		<input type='button' onclick='elige("18","c12","c7","mod"); guarda();' value=' Prepa 6 meses ' class='sig'>
		<input type='button' onclick='elige("17","c12","c7","mod"); guarda();' value=' Prepa 3 años (semiescolarizado) ' class='sig'><br><br>
		<input type='hidden' id='mod' name='mod'>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c6","c7");' value=' < ' class='sig'>
	</div>
	<div id='c8' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>¿Prefieres aplicar examen presencial o en línea?</div><br><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<input type='button' onclick='elige("1","c9","c8","linea");' value=' Presencial ' class='sig' selected>
		<input type='button' onclick='elige("2","c9","c8","linea");' value=' En línea ' class='sig'><br><br>
		<input type='hidden' id='linea' name='linea' value='0'>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c7","c8");' value=' < ' class='sig'>
	</div>

	<div id='c9' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Elige el día para aplicar tu examen<br><i>El horario es de 9 a 2 y puedes elegir cualquier día</i></div><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<?php echo "<input type='date' name='dia' min='$min'>"; ?><br><br>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c8","c9");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c10","c9");' value=' > ' class='sig'>
	</div>
	<div id='c10' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'><b>Importante:</b> Solo existe una oportunidad SIN COSTO para aplicar el examen, asegurate de tener el tiempo suficiente el día seleccionado, de lo contrario NO SE PODRÁ REPROGRAMAR LA APLICACIÓN.</div><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='guarda(); otra("c12","c10");' value=' Aceptar ' class='sig'>
	</div>

	<div id='c11' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Ficha de inscripción y guía de estudio</div><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='button' onclick='otra("c8","c9");' value=' < ' class='sig'>
		<input type='button' onclick='otra("c10","c9");' value=' > ' class='sig'>
	</div>

	<div id='c12' class='campos'>
		<div class='avt_prom'><img src='../imagen/udibot.png' width='30px'></div>
		<div class='promotor'>Tu inscripción se realizó correctamente en breve un compañero de control escolar te hará llegar el comprobante. <br><br>También te activaremos tu guía de estudio la cual puedes descargar ingresando con tu usuario y contraseña a nuestra plataforma <a href='http://udimex.net' target='_blank'>www.udimex.net</a><br>(Puede tardar hasta 24 horas en visualizarse)<br><br></div><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		
		<input type='button' value=' Terminar Chat ' class='sig'>
	</div>

</div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

	function valida_correo(){
		error="";
		correo=document.getElementById("correo").value;
		if(correo.length==0){
			error=error+"Debes escribir una dirección de correo electrónico";
		}

		if(error==""){
			otra("c2","c1");
		}
		else{
			document.getElementById("c_correo").innerHTML=error;
			document.getElementById("correo").value="";
		}
	}

	function valida_cl(){
		error="";
		cl1=document.getElementById("clave").value;
		cl2=document.getElementById("clave2").value;
		if (cl1.lenght==0){
			error=error+"Tu contraseña no puede estar vacía<br>";
		}

		if(cl1!=cl2){
			error=error+"Tus contraseñas no son iguales, intenta de nuevo.<br>";
		}

		if(error==""){
			otra("c4","c3");
		}
		else{
			otra("c2","c3");
			document.getElementById("cl1").innerHTML=error;
			document.getElementById("clave").value="";
			document.getElementById("clave2").value="";
		}
	}


	function otra(sig,act){
		document.getElementById(sig).style.display='block';
		document.getElementById(act).style.display='none';
	}

	function elige(val,sig,act,campo){
		document.getElementById(campo).value=val;
		otra(sig,act);
	}

	function guarda(){
		$.ajax({
			 
		    type:'POST', 
		    url: 'g_inscripcion.php',
		    data: $('#form').serialize(),
		    success:function(data){
				alert(data);
		   },
		   error:function(data){
		   }
		 });
	}
</script>
