<?php
session_start();
include('funciones.php');

date_default_timezone_set('America/Mexico_City');

$anio = isset($_GET['anio']) ? intval($_GET['anio']) : date("Y");
$semana_seleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date("W");
$mes_actual = date("m");

$fechas = [];
$alumnos = "";

$primer_dia_del_mes = date("Y-m-01", strtotime("$anio-$mes_actual-01"));
$ultimo_dia_del_mes = date("Y-m-t", strtotime("$anio-$mes_actual-01"));

$inicio_semana = date("W", strtotime($primer_dia_del_mes));
$fin_semana = date("W", strtotime($ultimo_dia_del_mes));

$semanas_del_mes = [];
for ($semana = $inicio_semana; $semana <= $fin_semana; $semana++) {
    $semanas_del_mes[] = $semana;
}

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

$i_alumnos = obtener_a_g($id_grupo);
while ($fila = mysqli_fetch_assoc($i_alumnos)) {
    $asistencias = asistencia_a($fila['id_alumno'], $id_grupo, $id_materia, $semana_seleccionada, $anio);
    while ($fila2 = mysqli_fetch_assoc($asistencias)) {
        $fecha = date("d/m/Y", strtotime($fila2['fecha']));
        if (!in_array($fecha, $fechas)) {
            $fechas[] = $fecha; 
        }
    }
}

$i_alumnos = obtener_a_g($id_grupo);
while ($fila = mysqli_fetch_assoc($i_alumnos)) {
    $asistencias = asistencia_a($fila['id_alumno'], $id_grupo, $id_materia, $semana_seleccionada, $anio);
    $asistencia_dias = [];

    foreach ($fechas as $fecha) {
        $asistencia_dias[$fecha] = "";
    }

    while ($fila2 = mysqli_fetch_assoc($asistencias)) {
        $fecha = date("d/m/Y", strtotime($fila2['fecha']));
    
        if ($fila2['asistencia'] == 0) {
            $asistencia_dias[$fecha] = "<i class='bi bi-check2-all verde'></i>";
        } elseif ($fila2['asistencia'] == 0.5) {
            $asistencia_dias[$fecha] = "<i class='bi bi-check2-all amarillo'></i>";
        } elseif ($fila2['asistencia'] == 1) {
            $asistencia_dias[$fecha] = "<i class='bi bi-x-circle-fill rojo'></i>";
        } 
    }
    

    $celdas_asistencia = "";
    foreach ($fechas as $fecha) {
        $celdas_asistencia .= "<td>".$asistencia_dias[$fecha]."</td>";
    }

    $alumnos .= "
        <tr>
            <td>".$fila['nombre'].' '. $fila['ap_pat']. ' '. $fila['ap_mat']."</td>
            ".$celdas_asistencia."
        </tr>";
}

echo "
    <div class='tabla_a'>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>";
                foreach ($fechas as $fecha) {
                    echo "<th>".$fecha."</th>";
                }
echo "  </tr>
        </thead>
        <tbody>
            ".$alumnos."
        </tbody>
    </table>
    </div>";
?>
