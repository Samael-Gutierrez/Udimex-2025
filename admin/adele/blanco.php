<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
//include('../general/db/profesor.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
}

$verifica=verifica_cuenta();



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
		
		
		
    </div>

</body>
</html>


