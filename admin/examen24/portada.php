<?php

session_start();

$id_profesor=$_SESSION['ad_id'];
$nombre=$_SESSION["ad_nom"] ;
$ap=$_SESSION["ad_ap"];


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Publicación</title>
    <link rel="stylesheet" href="css/estilos_portada.css">
</head>
<body>

<div class="main-container">
    <div class="imagen">
        <img src="https://udimex.net/general/imagen/logo.png" alt="">
    </div>
    <div class="red-line"></div>
    <div class="blue-line"></div>

    <h1>Portada</h1>

    <div class="container">
        <form class="formulario" method="post" action="guardaPortada.php" enctype="multipart/form-data">
            <div class="escuela">
                <label for="escuela">Escuela:<span class="obligatorio">*</span></label>
                <input type="text" id="escuela" name="nombre_escuela" maxlength="70" autocomplete="off" required placeholder="Udimex" value='Udimex'>
            </div>
            <div class="logotipo">
                <label for="logotipo">Logotipo:</label>
                <input type="file" id="logotipo" name="logotipo" accept="image/*" onchange="mostrarImagen(event)" autocomplete="off">
            </div>
            <div class="logotipo">
                <label for="profesor">Profesor:<span class="obligatorio">*</span></label>
                <input type="text" id="nombre_profesor" name="nombre_profesor" 
                value='<?php echo $nombre." ".$ap; ?>' maxlength="70" autocomplete="off" required>
            </div>
            <div class="materia">
                <label for="materia">Materia:<span class="obligatorio">*</span></label>
                <input type="text" id="nombre_materia" name="nombre_materia" maxlength="70" autocomplete="off" placeholder="Ej: Matematicas" required>
            </div>
            <div class="materia">
                <label for="tiempo">Tiempo:<span class="obligatorio">*</span></label>
                <input type="number" id="tiempo" name="tiempo" maxlength="5" autocomplete="off" valuer="0" placeholder="Tiempo en minutos que el alumno tendrá para contestar, si es 0 no tiene limite de tiempo" required>
            </div>
            <hr>
            
            <div class="DA">
                <h2>Datos Adicionales de la Portada</h2>
            </div>
            <div class="columnas">
                <div class="columna">
                    <h3>Tema de examen:<span class="obligatorio">*</span></h3>
                    <textarea name="contenido" id="contenido" placeholder="Ej: Raíz cuadrada" required></textarea>
                </div>
                <div class="columna">
                    <h3>Descripción</h3>
                    <textarea name="valor" id="valor" placeholder="Ej: Contesta cuidadosamente todo el examen"></textarea>
                </div>
            </div>
            <div class="crear">
                <button type="submit">Crear</button> 
                <div class="back-button" onclick="goBack()">
                    <svg width="32" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 19L5 12L12 5" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Atrás</span>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
if(isset($_GET['s'])){
    echo "
        <script>
            alert('Solo se aceptan formatos de imagen jpg, png, jpeg, jfif');
        </script>
    ";
}
?>

<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>