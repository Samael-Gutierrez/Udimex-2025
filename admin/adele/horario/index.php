<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/materia.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
}

$verifica=verifica_cuenta();

//Busca materias del profesor
$materias='';
$datos=busca_materia_profesor2($_SESSION['id'],$_SESSION['periodo']);
$c_mat=0;
while($fila=mysqli_fetch_assoc($datos)){
	$gr=$fila['materia']."<br>".$fila['siglas']." ".$fila['cuatrimestre'];
	$id=$fila['id_mp'];
	$materias=$materias."<button id='$id' onclick='grupo(\"$gr\",\"$id\")'>$gr</button>";
	$c_mat=$c_mat+1;
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/css/dashboard.css">
	<script src="../general/js/jquery-3.7.1.js"></script>

    <title>Dashboard</title>
</head>
<body>
<div id="overlay"></div>
<?php
	barra_lateral();
?>

    <div class="contenido">
        <div class="cabecera">
            <h1>Bienvenido al Dashboard</h1>
        </div>
		<?php
			echo $verifica."<div class='contenedor'>";
		?>
		
	<div class='tabla-contenedor'>
		<div class="group-buttons">
		<?php
			echo $materias;
		?>
			<button id="b" onclick="grupo('',0)">Borra</button>
		</div>
		<br><br>
		<table id="horario">
			<thead>
				<tr>
					<th>Hora/Día</th>
					<th>Lunes</th>
					<th>Martes</th>
					<th>Miércoles</th>
					<th>Jueves</th>
					<th>Viernes</th>
				</tr>
			</thead>
			<tbody>
				<tr><td>7:00 - 8:00</td><td id='11'></td><td id='12'></td><td id='13'></td><td id='14'></td><td id='15'></td></tr>
				<tr><td>8:00 - 9:00</td><td id='21'></td><td id='22'></td><td id='23'></td><td id='24'></td><td id='25'></td></tr>
				<tr><td>9:00 - 10:00</td><td id='31'></td><td id='32'></td><td id='33'></td><td id='34'></td><td id='35'></td></tr>
				<tr><td>10:00 - 11:00</td><td id='41'></td><td id='42'></td><td id='43'></td><td id='44'></td><td id='45'></td></tr>
				<tr><td>11:00 - 12:00</td><td id='51'></td><td id='52'></td><td id='53'></td><td id='54'></td><td id='55'></td></tr>
				<tr><td>12:00 - 13:00</td><td id='61'></td><td id='62'></td><td id='63'></td><td id='64'></td><td id='65'></td></tr>
				<tr><td>13:00 - 14:00</td><td id='71'></td><td id='72'></td><td id='73'></td><td id='74'></td><td id='75'></td></tr>
				<tr><td>14:00 - 15:00</td><td id='81'></td><td id='82'></td><td id='83'></td><td id='84'></td><td id='85'></td></tr>
				<tr><td>15:00 - 16:00</td><td id='91'></td><td id='92'></td><td id='93'></td><td id='94'></td><td id='95'></td></tr>
			</tbody>
		</table>
			
		</div>
	</div>
    <script>
		const datosGlobales = {
			texto: "",
			id: 0
		};
		
		document.addEventListener('DOMContentLoaded', function() {
		  const tabla = document.getElementById('horario');
		  
		  tabla.addEventListener('click', function(event) {
			if (event.target.tagName === 'TD') {
			  const id = event.target.id; // Obtenemos el ID del TD clickeado
			  
				document.getElementById(id).innerHTML=datosGlobales.texto;
				document.getElementById(id).style.background="#ff0000";
				
				guarda(id);
			  
				if(datosGlobales.texto.length<1){
					document.getElementById(id).style.background="transparent";
				}
			}
		  });
		});



		function grupo(texto, id) {
			datosGlobales.texto = texto;
			datosGlobales.id = id;
		}
		
		function guarda(id) {
			if(datosGlobales.id>0){		
				var celda = id;
				var id =datosGlobales.id;   
				
				$.ajax({
					url: "horario_guarda.php", 
					type: "POST",          
					data: {                
						id: id,
						celda: celda
					},
					success: function(respuesta) {	
					},
					error: function(xhr, status, error) {
					}
				});
			}
		}
    </script>
</body>
</html>

<?php
	busca_horario($_SESSION['id'])

?>
