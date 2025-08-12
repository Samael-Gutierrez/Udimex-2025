<?php
session_start();
include('funciones.php');
if(isset($_POST['id_grupo'])){
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $dias = $_POST['dias'];
    $_SESSION['id_grupo']=$id_grupo;
    $_SESSION['dias']=$dias;
    $_SESSION['id_materia']=$id_materia;
}
else{
    if(isset($_SESSION['id_grupo'])){
        $id_grupo = $_SESSION['id_grupo'];
        $id_materia = $_SESSION['id_materia'];
        $dias = $_SESSION['dias'];
    }
    else{
        header("location:inicio.php");
    }
}

date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d H:i:s");


if (isset($id_grupo)) {
    $i_alumnos = obtener_a_g($id_grupo);
    $alumnos = "";
    while ($fila = mysqli_fetch_assoc($i_alumnos)) {
        $faltas = faltas($fila['id_alumno'], $id_grupo, $fecha_ac);
        while ($fila2 = mysqli_fetch_assoc($faltas)) {
            $n_faltas = $fila2['faltas'];
        }
        $detalles_faltas = faltas_detalle($fila['id_alumno'], $id_grupo);
        $falta_f = "";
        while ($detalle = mysqli_fetch_assoc($detalles_faltas)) {
            $falta_f = $detalle['fecha'];
        }
        if ($n_faltas >= 1) {
            $alumnos .= "
            <tr>
            <td>" . $fila['nombre'] . ' ' . $fila['ap_pat'] . ' ' . $fila['ap_mat'] . "</td>
            <td>" . $n_faltas . "</td>
            <td class='faltas'>".$falta_f."</td>
            </tr>";
        }
    }
}

$regreso="";
$regreso2="";
if($dias!="En línea"){
    $regreso = $regreso. "    
    <form action='pase.php' method='post'>
        <button type='submit'><i class='bi bi-arrow-left-circle-fill volver'></i></button>
    </form>";
}else{
    $regreso2 = $regreso2. "    
    <form action='inicio.php' method='post'>
        <button type='submit'><i class='bi bi-arrow-left-circle-fill volver'></i></button>
    </form>";
}
$materia_n = i_materia($id_materia);
while ($fila3 = mysqli_fetch_assoc($materia_n)) {
    $nombre_m = $fila3['nombre'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/pase.css">
    <title>Registro de Asistencia</title>
</head>
<body>
    <div class="infom">
        <h3><?php echo $nombre_m; ?></h3>
        <button type='button' onclick='mostrar();'class="vista"> Ver </button>
    </div>
    <h2>Informe de asistencias</h2>

    <div class="tabla_a">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Faltas</th>
                    <th class="faltas">Fechas</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $alumnos; ?>
            </tbody>
        </table>
    </div>
<div class="botones">
    <?= $regreso;?>
    <?= $regreso2;?> 
</div>
</body>
<script>
function mostrar() {
    var elementos = document.getElementsByClassName('faltas');
    for (var i = 0; i < elementos.length; i++) {
        elementos[i].style.display = 'block';
    }
}
    </script>
</html>