<?php
session_start();

$dir = "../general/";

include($dir."php/alumno.php");
include($dir."db/materias.php");
include($dir."db/cuestionario.php");
include($dir."db/basica.php");

$totales = compruebaRespuestas($_SESSION['sub'], $_SESSION['g_id']);
while ($total = mysqli_fetch_assoc($totales)) {
	$totals = $total['totales'];
}

if ($totals != 0) {
	header('location: ../alumno/index.php?m=1');
}

$usuario = $_SESSION["g_id"];
$tema = $_SESSION['tema'];
$tiempo = $_SESSION['tiempo'];

$orden = "order by rand()";
$tema = $_SESSION['tema'];

?>

<!DOCTYPE html>
<html lang="es-MX">
<head>
	<?php carga_estilo('../'); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='stylesheet' href='css/estilo.css'>
	<title>Resultado de examen</title>
	<style>
		.imagen {
			margin-top: 20px;
		}

		#temporizador {
			position: fixed;
			top: 130px;
			right: 20px;
			background-color: #222;
			color: #fff;
			padding: 10px 20px;
			font-size: 24px;
			font-family: 'Arial', sans-serif;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			z-index: 9999;
			transition: color 0.3s;
		}

		.alerta {
			color: #ff0000;
		}

		input[type="radio"] {
			width: 16px;
			height: 16px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id='temporizador' style='display:none;'>00:00:00</div>
<?php

permiso();
menu('../');

echo "
	<input type='hidden' value='$tiempo' id='tiempo'>

	<form id='hiddenForm' style='display:none;'>
        <input type='hidden' name='usuario' value=$usuario>
        <input type='hidden' name='tema' value=$tema>
    </form>
    ";

	$datos = cues_tot($tema);
	if ($fila = mysqli_fetch_assoc($datos)) {
		$tot = $fila['r'];
	}

	$d1 = cues($tema, "order by id_pregunta");
	$p = 1;
	echo "<form method='POST' action='evalua.php'><ol>";
	while ($f1 = mysqli_fetch_assoc($d1)) {
		$ad = "hidden";
		$ant = "<div onclick='visible($p,-1);' class='linea w3-button w3-deep-purple'>Anterior</div>";
		$sig = "<div onclick='visible($p,1);' class='linea w3-button w3-deep-purple'>Siguiente</div>";
		if ($p == 1) {
			$ad = "";
			$ant = "";
		}
		echo "<div id='preg$p' $ad style='text-align: justify;'>
		<h4 class='rojo_oficial' style='text-align: center;'>$p de $tot</h4><br>
		<div id='container-div' class='container-div' style='max-width: 80%; overflow: auto;' contenteditable='false' rows='4' cols='50'>" . $p . ".- " . $f1['pregunta'] . "</div><br><br>";
		echo "<ol type='A'>";
		$d2 = res($f1['id_pregunta'], "$orden");
		$r = 1;
		while ($f2 = mysqli_fetch_assoc($d2)) {
			echo "<li>
				<input type='radio' id='r$p' name='p$p' value='" . $f2['id_respuesta'] . "' onclick='g_respuesta(" . $f1['id_pregunta'] . "," . $f2['id_respuesta'] . ",$tema);'> &nbsp; " . trim($f2['respuesta']) .
				"</li>";
			$r = $r + 1;
		}
		mysqli_free_result($d2);
		echo "</ol><br><center>$ant &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; $sig</center></div>";
		$p = $p + 1;
	}
	mysqli_free_result($d1);

    //Si el examen es de acuerdo 286
	$mes = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
	if ($tema == 4114) {
		$fechaActual = new DateTime();
		$fechaActual->modify('next Wednesday');
		$fecha = $fechaActual->format('Y-m-d');

		$nuevaFecha = explode('-', $fecha);

		$resultado = "<br><br><br> Felicidades, has concluido tu examen de <b>Acreditación de Bachillerato por Acuerdo 286 de la SEP</b> con éxito, los resultados serán publicados el siguiente miércoles " . $nuevaFecha[2] . " de " . $nuevaFecha[1] . " del año " .
			$nuevaFecha[0] . ", debes estar al pendiente a partir del medio día. <br>
			<a href='../alumno/index.php'>Volver al inicio</a>
			";
	}else{
	    $resultado = "
			Felicidades, has concluido tu cuestionario, da clic en el siguiente botón para revisar tus respuestas. <br><br>
			<input type='submit'  value='Calificar' id='calificar'>";
	}

	echo "
		<center>
			<div id='preg$p' hidden >
				$resultado
				<input type='hidden' value='$p' name='tope'></center></form></div></div></div></center><br><br>";

	mysqli_free_result($datos);

	?>

	<div id='resultado'></div>
	<script type='text/javascript' src='../general/js/jquery-1.6.4.js'></script>
	<script>
	    
	    function visible(p, v) {
			n = p + v;
			document.getElementById('preg' + p).style.display = 'none';
			document.getElementById('preg' + n).style.display = 'block';
		}
	    
		document.addEventListener('DOMContentLoaded', function() {
			window.addEventListener('blur', function() {
				const formData = new FormData(document.getElementById('hiddenForm'));

				// Crear una solicitud AJAX
				const xhr = new XMLHttpRequest();
				xhr.open('POST', 'procesar_formulario.php', true);
				xhr.onload = function() {
					if (xhr.status === 200) {
						console.log('1s');
					} else {
						console.error('Error al enviar el formulario');
					}
				};
				xhr.send(formData);
			});
		});
		
		let minutos = parseFloat(document.getElementById('tiempo').value);
		const contador = document.getElementById('temporizador');

		if(minutos != 0){
			let segundos = (minutos * 60) + 1;
			contador.style.display = 'block'
			aviso();

			const intervalo = setInterval(() => {
				segundos--;
				contador.textContent = formatearTiempo(segundos);

				if (segundos <= 0) {
					clearInterval(intervalo);
					final();
				}
			}, 1000);
		}

		function formatearTiempo(segundos) {
			const horas = Math.floor(segundos / 3600);
			const minutos = Math.floor((segundos % 3600) / 60);
			const restoSegundos = segundos % 60;

			const hh = horas.toString().padStart(2, '0');
			const mm = minutos.toString().padStart(2, '0');
			const ss = restoSegundos.toString().padStart(2, '0');

			return `${hh}:${mm}:${ss}`;
		}

		function final() {
			alert('El tiempo ha finalizado.');
			cerrarExamen();
		}

		function cerrarExamen() {
			const cal = document.getElementById('calificar');
			cal.click();
		}

		function aviso() {
			alert('Tienes ' + minutos + ' minutos para contestar el examen, al finalizar el tiempo se cerrará automaticamente.');
		}


		function revisa() {
			var url = 'evalua.php';
			$.ajax({
				type: 'POST',
				url: url,
				data: $('#busca').serialize(),
				success: function(data) {
					$('#resp').html(data);

				}
			});
		}

		function g_respuesta(preg, res, mat) {
			$.ajax({
				url: 'guarda_respuesta.php?preg=' + preg + '&res=' + res + '&mat=' + mat,
				success: function(data) {
					$('#resultado').html(data);
				}
			});
		}
	</script>
</body>
</html>
