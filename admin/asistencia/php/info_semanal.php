<?php
session_start();
include('funciones.php');

date_default_timezone_set('America/Mexico_City');

$anio_actual = date("Y");
$mes_actual = date("m");

$primer_dia_del_mes = date("Y-m-01", strtotime("$anio_actual-$mes_actual-01"));
$ultimo_dia_del_mes = date("Y-m-t", strtotime("$anio_actual-$mes_actual-01"));

$inicio_semana = date("W", strtotime($primer_dia_del_mes));
$fin_semana = date("W", strtotime($ultimo_dia_del_mes));

$semanas_del_mes = [];
for ($semana = $inicio_semana; $semana <= $fin_semana; $semana++) {
    $semanas_del_mes[] = $semana;
}

$semana_seleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date("W");
$anio = isset($_GET['anio']) ? intval($_GET['anio']) : $anio_actual;

if (isset($_POST['id_grupo'])) {
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $_SESSION['id_grupo'] = $id_grupo;
    $_SESSION['id_materia'] = $id_materia;
} else {
    if (isset($_SESSION['id_grupo'])) {
        $id_grupo = $_SESSION['id_grupo'];
        $id_materia = $_SESSION['id_materia'];
    } else {
        header("location:inicio.php");
    }
}

$fechas = [];
$alumnos = "";

$materia_n = i_materia($id_materia);
while ($fila3 = mysqli_fetch_assoc($materia_n)) {
    $nombre_m = $fila3['nombre'];
}
date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/pase.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<title>Registro de Asistencia</title>
</head>
<body>

    <br>
    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Informe semanal de asistencias</h1>
    <div class="boton2">
    <form action="pase.php" method="post">
    <button type="submit"><i class="bi bi-arrow-left-circle-fill volver"></i></button>
    </form>
    </div>
    <form id="formulario">
        <select name="semana" id="semana" class="semana">
            <?php foreach ($semanas_del_mes as $semana): ?>
                <option value="<?php echo $semana; ?>" <?php echo ($semana == $semana_seleccionada) ? 'selected' : ''; ?>><?php echo "Semana $semana"; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" id="anio" name="anio" value="<?php echo $anio_actual; ?>">
    </form>
    <br>
    <div id="tabla-asistencia">
    </div>

</body>

<script src='../js/jquery-1.6.4.js'></script>
<script>
$(document).ready(function() {
    $('#semana').change(function() {
        var semana = $(this).val();
        var anio = $('#anio').val();
        $.ajax({
            url: 'actualizar_asistencia.php',
            type: 'GET',
            data: { semana: semana, anio: anio },
            success: function(response) {
                $('#tabla-asistencia').html(response);
            }
        });
    });

    var semana = $('#semana').val();
    var anio = $('#anio').val();
    if (semana) {
        $.ajax({
            url: 'actualizar_asistencia.php',
            type: 'GET',
            data: { semana: semana, anio: anio },
            success: function(response) {
                $('#tabla-asistencia').html(response);
            }
        });
    }
});
</script>
</html>
