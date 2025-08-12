<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/asistencia.php');

$m=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

if (!isset($_SESSION['id'])){
	header('location:../index.php');
}

$verifica=verifica_cuenta();

if($_GET){
	$mp=$_GET['mp'];
	
	//Busca fechas
	$asiste="";
	$j=1;
	$fechas=busca_fechas($mp);
	$mes=0;
	$meses="";
	$c=1;
	
	while($f=mysqli_fetch_assoc($fechas)){
		$r=explode("-",$f['fecha']);
		if($r[1]==$mes){
			$c++;
		}
		else{
			if($mes>0){
				$meses=$meses."<th colspan=$c>".$m[intval($r[1])-1]."</th>";
			}
			$mes=$r[1];
			$c=1;
		}
		$asiste=$asiste."<th>".$r[2]."</th>";
		$fechas_array[$j]=$f['fecha'];
		$j++;
	}
	
	$meses=$meses."<th colspan=$c>".$m[intval($r[1])]."</th>";
	
	
	
	
	//Busca lista
	$alumnos="<tr><th rowspan='2'>N°</th><th rowspan='2'>Matrícula</th><th rowspan='2'>Nombre</th>$meses</tr><tr>$asiste</tr>";
	$i=1;
	$datos=busca_lista($mp);
	while($fila=mysqli_fetch_assoc($datos)){
		//busca asistencia del alumno
		$asistencia_alumno="";
		for($x=1;$x<$j;$x++){
			$estado='n';
			$datos2=busca_asistencia($fila['id_alumno'],$fechas_array[$x],$mp);
			if($fila2=mysqli_fetch_assoc($datos2)){
				$asistencia_alumno=$asistencia_alumno."<td>•</td>";
			}
			else{
				$asistencia_alumno=$asistencia_alumno."<td>x</td>";
			}
		}
		
		//Crea tabla
		$alumnos=$alumnos.
		"<tr><td>$i</td>
			<td>".$fila['matricula']."</td>
			<td>".$fila['ap']." ".$fila['am']." ".$fila['nombre']."</td>
			$asistencia_alumno
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
		
		<table border='1'>
		<?php
			echo $alumnos;
		?>
		</table>
		
		
		
    </div>

</body>
</html>


