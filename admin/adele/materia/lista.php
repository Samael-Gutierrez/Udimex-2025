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
	$_SESSION['mp']=$mp;
	$datos=busca_grupo($_GET['mp'],$_SESSION['id']);
	if($fila=mysqli_fetch_assoc($datos)){
		$id_carrera=$fila['id_carrera'];
		$_SESSION['carrera']=$id_carrera;
		$carrera=$fila['carrera'];
		$grupo=$fila['siglas']." ".$fila['cuatrimestre'];
	}
	
	//Mostrar la lista de alumnos
	$alumnos="";
	$i=1;
	$datos=busca_lista($mp);
	while($fila=mysqli_fetch_assoc($datos)){
		//Busca si un alumno ya paso lista hoy
		$datos2=busca_pasistencia($mp,$fila['id_alumno'],date('Y-m-d'));
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
		
	<?php echo $carrera."<br>".$grupo; ?>
	<a href='lista_qr.php'><img src='../general/im/qr.png'></a>
	<a href='lista_reporte.php?mp=<?php echo $mp; ?>'><img src='../general/im/qr.png'></a>
	<div class="tabla-contenedor">
		<table border='1'>
			<thead>
				<tr>
					<th>#</th>
					<th>Matrícula</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Apellido Nombre(s)</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<form method='POST' action='alumno_guarda.php'>
					<tr><td></td>
						<td><input type='text' name='mat' id='mat' placeholder='Matricula' required></td>
						<td><input type='text' name='ap' id='ap' placeholder='Apellido Paterno' required></td>
						<td><input type='text' name='am' id='am' placeholder='Apellido Materno' required></td>
						<td><input type='text' name='nom' id='nom' placeholder='Nombre' required></td>
						<td><input type='submit' id='guarda' value='+'></td>
						<input type='text' name='tipo' id='tipo' required value='0'>
					</tr>
				</form>
				<?php echo $alumnos; ?>
			</tbody>
    </div>



</body>
</html>

