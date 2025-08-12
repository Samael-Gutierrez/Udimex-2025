<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
	die();
}

$verifica=verifica_cuenta();

// Documento1
// Verifica si el usuario tiene por lo menos una carrera guardada

			


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
		
		<h1>Descarga de Archivos PDF</h1>

    <div class="pdf-grid">
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Portada</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Syllabus</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Dosificación</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Lista de Informes</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Rúbrica</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Ponderación 1</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Ponderación 2</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Calificaciones Finales</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
        <div class="pdf-item">
            <img src="../general/im/pdf-icon.png" alt="PDF">
            <div class="name">Actas</div>
            <div class="date">Modificado: 12/12/2024</div>
            <a href="#">Descargar</a>
        </div>
    </div>
		
			
        </div>
    </div>

</body>
</html>
