<?php

session_start();

include "funciones/funcionesPortada.php";

$portada = $_GET["id"];
$datos = obtener_datos($portada);

if ($fila = mysqli_fetch_assoc($datos)) {
    $nombre=$_SESSION["ad_nom"] ;
     $ap=$_SESSION["ad_ap"];
    $materia = $fila['nombre_materia'];
    $escuela = $fila['nombre_escuela'];
    $logotipo = $fila['logotipo'];
}

$valor_Contenido = obtener_adicionales($portada);

if ($fila = mysqli_fetch_assoc($valor_Contenido)) {
    $contenido = $fila['contenido'];
    $valor = $fila['valor'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos_alumno.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Alumno</title>
</head>
<body>
    <div class="main-container">
        <header class="header">
            <div class="top-lines">
                <div class="red-line"></div>
                <div class="spacer"></div>
                <div class="blue-line"></div>
            </div>
            <div class="header-content">
                <div class="logo-container">
                    <img src="img/<?php echo $logotipo; ?>" alt="Logotipo" class="logo">
                </div>
                <div class="info-container">
                    <div class="info-item">
                        <strong>Escuela:</strong> 
                        <div class="info-box"><?php echo $escuela; ?></div> <br>
                    </div>
                    <div class="info-item">
                        <strong>Profesor:</strong> 
                        <div class="info-box"><?php echo $nombre . " " . $ap; ?></div>
                    </div>
                    <div class="info-item">
                        <strong>Materia:</strong> 
                        <div class="info-box"><?php echo $materia; ?></div>
                    </div>
                
                    <div class="info-item">
                        <strong><?php echo $contenido; ?>:</strong> 
                        <div class="info-box"><?php echo $valor; ?></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="actions">
            <?php echo "<a href='https://udimex.net/alumno/examen.php?id=$portada' target='_PARENT'><button class='boton'>Iniciar Examen</button></a>"; ?>
        </div>
    </div>
</body>
</html>
