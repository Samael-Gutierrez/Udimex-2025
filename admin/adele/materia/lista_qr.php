<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/materia.php');
include('../general/db/asistencia.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
	die();
}

$verifica=verifica_cuenta();

if($_GET){
	//Mostrar datos de carrera, 
	//Mostrar datos del grupo
	$mp=$_GET['mp'];
	$datos=busca_grupo($_GET['mp'],$_SESSION['id']);
	if($fila=mysqli_fetch_assoc($datos)){
		$id_carrera=$fila['id_carrera'];
		$carrera=$fila['carrera'];
		$grupo=$fila['siglas']." ".$fila['cuatrimestre'];
	}
	
	//Mostrar la lista de alumnos
	$alumnos="";
	$i=1;
	$datos=busca_lista($mp);
	while($fila=mysqli_fetch_assoc($datos)){
		//Busca si un alumno ya paso lista hoy
		$datos2=busca_lista_hoy($mp,$fila['id_alumno']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$icono=['','F','J','A'];
			$herr=$icono[$fila2['estado']];
		}
		else{
			$herr="F J A";
		}
		$alumnos=$alumnos.
		"<tr><td>$i</td>
			<td>".$fila['matricula']."</td>
			<td>".$fila['ap']."</td>
			<td>".$fila['am']."</td>
			<td>".$fila['nombre']."</td>
			<td>$herr</td>
		</tr>";
		$i=$i+1;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/css/dashboard.css">
	<link rel="stylesheet" href="../general/css/grupo.css">
	<script src='../general/js/emergente.js'></script>
	<script src="../general/js/html5-qrcode.min.js"></script>
	<script type='text/javascript' src='../general/js/jquery-3.7.1.js'></script>
    <title>Dashboard</title>
	
</head>
<body>
<div id="oscuro"></div>

<?php
	barra_lateral();
?>

    <div class="contenido">
        <div class="cabecera">
            <h1>Bienvenido al Dashboard</h1>
        </div>
		
  <h1 align='center'>Coloca el QR del CURP frente el lector</h1>
    <div id="qr-reader"></div>
    <div id="qr-result"></div><br><br>
	<a href='lista.php'><button>Ver lista</button></a>
	
    <script>
		let actual="";
        function onScanSuccess(decodedText, decodedResult) {
			if(actual!=decodedText){
				document.getElementById('qr-result').innerText="";
				cadena=decodedText.split("|");
				f=cadena.length;

				for(i=0;i<f;i++){
					document.getElementById('qr-result').innerText=document.getElementById('qr-result').innerText + " " + cadena[i];
				}
				
				if(f>2){
					guarda_resultado(cadena[0],cadena[1],cadena[2],cadena[3])
				}

				suena();
				actual=decodedText;
			}
		}
		
		function guarda_resultado(mat,nom,ap,am){
			$.ajax({
					url: 'alumno_guarda.php',
					type: 'POST',
					data: {mat:mat,nom:nom,ap:ap,am:am,tipo:3},
					success: function (data) {
      					},
					error: function(){
      					}
				});
		}


        function onScanError(errorMessage) {
            console.warn(`Error en el escaneo: ${errorMessage}`);
        }

        let html5QrCode = new Html5Qrcode("qr-reader");
        html5QrCode.start({ facingMode: "environment" }, {
            fps: 10,
            qrbox: 300
        }, onScanSuccess, onScanError);
		
		function suena() {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            oscillator.type = 'triangle'; // Tipo de onda (sine, square, sawtooth, triangle)
            oscillator.frequency.setValueAtTime(700, audioContext.currentTime); // Frecuencia en Hz (440 es el A4)

            const gainNode = audioContext.createGain();
            gainNode.gain.setValueAtTime(1, audioContext.currentTime); // Volumen

            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);

            oscillator.start();
            oscillator.stop(audioContext.currentTime + 0.2); // Duración del beep en segundos
        }
    </script>
</body>





    </div>



</body>
</html>

