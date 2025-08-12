<?php
    session_start();
    include("../funciones/funciones.php");
    $id_repaso=$_SESSION['id_repaso'];

    $datos=checar_estado($id_repaso);
    if($fila=mysqli_fetch_assoc($datos)){
        if($fila['estado']==1){
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=https://udimex.net/alumno/repaso/archivos%20php/muestra_repaso.php'>";
        }
        else{
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='5;URL=https://udimex.net/alumno/repaso/archivos%20php/animacion_carga.php'>";

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animacio_carga.css">
    <title>Cargando...</title>
</head>
<body>
    <div class="container">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
        <a href="../archivos%20php/muestra_repaso.php" class="loading">Preparando repaso...</a>
    </div><br>

</body>
</html>

