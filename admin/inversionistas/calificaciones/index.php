<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");

include("functions/consultas.php");

$hojaEstilos = "<link rel='stylesheet' href='styles/style.css'>";

cabeza("Calificaciones - Udimex","$hojaEstilos");
?>

<body>

<?php
	usuario("../../",'index.php');
	menu_i();

	$students = getStudentsFromRatings();

	echo "
		<div class='separacion'>
			<p>Calificaciones registradas</p>
		</div>

		<div class='calificaciones-container'>
		";

	while($alumno = mysqli_fetch_assoc($students)){
		$fullName = $alumno['ap_pat'] . " " . $alumno['ap_mat'] . " " . $alumno['nombre'];
		echo "
			<div class='calificaciones-card'>
				<div class='calificaciones-tab'>
					<p>$fullName</p>
				</div>
		";

		echo "
				<table>
					<thead>
						<td>Fecha</td>
						<td>Materia</td>
						<td>Tema</td>
						<td>Calificación</td>
					</thead>
		";

		$calificaciones = getRatingsById($alumno['id_alumno']);

		while($calificacion = mysqli_fetch_assoc($calificaciones)){
			$fechaRegistro = $calificacion['fecha_registro'];
			$materia = $calificacion['nombre_materia'];
			$tema = $calificacion['contenido'];
			$valor =  $calificacion['valor'];

			echo "
				<tr>
					<td>$fechaRegistro</td>
					<td>$materia</td>
					<td>$tema</td>
					<td>$valor</td>
				</tr>
			";
		}

		echo"
				</table>
			</div>
		";
	}

	echo "</div>";
?>

</body>
</html>


