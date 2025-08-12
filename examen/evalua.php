<?php
session_start();

$dir = "../general/";

include($dir."php/alumno.php");
include($dir."php/notificacion.php");
include($dir."db/pagos.php");
include($dir."db/basica.php");
include($dir."db/materias.php");
include($dir."db/cuestionario.php");
include($dir."db/notificacion.php");
include($dir."db/usuario.php");

$us=$_SESSION["g_id"];
$tema=$_SESSION['tema'];
$sub=$_SESSION['sub'];



$bien=0;
$mal=0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultado de examen</title>
    <link rel='stylesheet' href='css/estilo.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

	<?php  
		carga_estilo('../');
	?>
	

<style>
/* Estilos generales */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.inicio {
	padding: 5px 8px;
	color: white;
	background-color:rgb(5, 39, 112);
	text-transform: uppercase;
	border-radius: 10px;
	margin-top: 20px;
}

h1 {
    text-align: center;
    color: #333;
}

.review-list {
    list-style-type: none;
    padding: 0;
}

.review-list li {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.review-list li:last-child {
    border-bottom: none;
}

.review-list i {
    margin-right: 10px;
    font-size: 1.5em;
}

.correcto {
    color: #28a745; /* Verde para respuestas correctas */
}

.incorrecto {
    color: #dc3545; /* Rojo para respuestas incorrectas */
}

.pending {
    color: #ffc107; /* Amarillo para respuestas pendientes */
}

</style>

</head>
<body>

  	<?php
    	permiso();
	    menu('../');
	?>

    <div class="container">
        <h1>Revisión del Examen</h1>
        <ul class="review-list">

<?php
if($tope=$_POST['tope']){
	for($i=1;$i<$tope;$i++){
		if(isset($_POST["p$i"])){
			$r=$_POST["p$i"];
			$d1=evalua($r);
			$f1=mysqli_fetch_assoc($d1);
			mysqli_free_result($d1);

            $clase="fas fa-exclamation-circle pending";
			if ($f1['tipo']==1){
			    $clase="fas fa-check-circle correcto";
				$bien=$bien+1;
			}else{
				$clase="fas fa-times-circle incorrecto";
				$mal=$mal+1;
			}

			echo "<li><i class='$clase'></i> ".$f1['pregunta']."<br> R.- ".$f1['respuesta']."</li>";
		}
		else{
		   	$f='mal';
			$mal=$mal+1;
			echo "<img src='../general/imagen/mal.png' align='right' width='30'><div id='mal'><li class=''>".$f1['pregunta']."<br> R.- NO CONTESTADA</li></div><br>";
		}
	}
	
	echo "</ul>";

	$calif=round(($bien*10/($bien+$mal)),1);

	$total=1;
	$o=0;
	$adicional = "";

	if($calif>=6){
	    $resultado="correcto";
	}else{
		$resultado="incorrecto";
		$adicional="<br>
		<h3>Tu calificación no es aprobatoria</h3><br><br>";	
	}

	 
	echo "<div id='calif'><div class='borde'><center><h2><b>Calificación</b></h2><br><h1 class='borde relleno $resultado'>$calif</h1>$adicional <a class='inicio' href='../alumno/index.php'>Volver al Inicio</a></div></center></div>";
	$fecha = Date("Y-m-d");
	g_calificacion($calif, $tema, $us);
	saveQualification($calif,$tema,$us);
}
	
	//Crear notidficación (autor,mensaje,app)
	crear_notificacion(483,"Se registro una nueva calificación :)",4);
?>

    </div>
	</body>
	<br><br>	
</html>


