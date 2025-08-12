<?php
include("../funciones/funciones.php");

$materia="";
$lista_materias=materias();
while($datos = $lista_materias->fetch_object()){
    $materia = $materia . "<option name='id' value='". $datos->id_materia ."'>
    ". $datos->nombre ."</option>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="peticion.css">
    <title>Peticion</title>
</head>
<body>
    <h1>Peticion</h1>
    <form action="../funciones/guarda_peticion.php" method="post">
        <label for="" hidden>Fecha</label>
        <input type="date" name="fecha" id="fecha" hidden>

        <label for="" hidden>Materia</label>
        <select name="materia" id="" hidden>
            <?php echo $materia;?>
        </select>

        <button type="submit">Pedir</button>
    </form>
</body>
</html>