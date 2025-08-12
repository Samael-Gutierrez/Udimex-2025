<?php

session_start();

$id= $_SESSION['id_portada'];
$liga="https://udimex.net/admin/examen24/vistaAlumno.php?id=$id";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga Generada</title>
    <link rel="stylesheet" href="css/estilosLiga.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="contenedor">
        <div class="lineas">
            <div class="linea-roja"></div>
            <div class="linea-azul"></div>
        </div>
        <div class="iconos">
            <a href="Examenes.php">
                <i class="bi bi-house-fill"></i> Ir al menú
            </a>
        </div>
        <div class="sesion">
            <div class="avatar">
                <?php echo strtoupper($_SESSION["ad_nom"][0]) . strtoupper($_SESSION["ad_ap"][0]); ?>
            </div>
            <span class="nombre-profesor"><?php echo $_SESSION["ad_nom"] . ' ' . $_SESSION["ad_ap"]; ?></span>
        </div>
        <h1>Examen creado Exitosamente</h1>
        <div class="subtitulo">
            <p>Comparte la siguiente liga con tus alumnos, para que puedan ingresar al examen:</p>
        </div>
        <a href="<?php echo $liga; ?>" class="liga-examen"> <?php echo $liga; ?></a>
        <br><br><br>
        <div class="subtitulo">
            <p>O si prefieres puedes incluir el siguiente código en tu página web</p>
        </div>
        <textarea cols='70' rows='5'><iframe id="examenUdimex" title="Examen Udimex" width="100%" height="600" src="<?php echo $liga; ?>"></iframe></textarea>
        
        <div class="logout">
            <form method="POST" action="cerrarSesion.php">
                <button type="submit" class="logout-button">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>
</body>
</html>
