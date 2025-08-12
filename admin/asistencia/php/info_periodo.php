<?php
session_start();
 include('funciones.php');
 if(isset($_POST['id_grupo'])){
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $_SESSION['id_grupo']=$id_grupo;
    $_SESSION['id_materia']=$id_materia;
}
else{
    if(isset($_SESSION['id_grupo'])){
        $id_grupo = $_SESSION['id_grupo'];
        $id_materia = $_SESSION['id_materia'];
    }
    else{
        header("location:inicio.php");
    }
}

date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d H:i:s");

$fecha1 = isset($_POST['fecha1']) ? $_POST['fecha1'] : null;
$fecha2 = isset($_POST['fecha2']) ? $_POST['fecha2'] : null;

if (isset($id_grupo)) {
    $i_alumnos = obtener_a_g($id_grupo);
    $alumnos = "";

    while ($fila = mysqli_fetch_assoc($i_alumnos)) {
        $asistencias = asistencia($fila['id_alumno'], $id_grupo, $fecha1, $fecha2);
        $n_asistencias = 0;
        while ($fila2 = mysqli_fetch_assoc($asistencias)) {
            $n_asistencias = $fila2['asistencia'];
        }

        $retardos = retardo($fila['id_alumno'], $id_grupo, $fecha1, $fecha2);
        $n_retardos = 0;
        while ($fila3 = mysqli_fetch_assoc($retardos)) {
            $n_retardos = $fila3['retardos'];
        }

        $faltas = faltas($fila['id_alumno'], $id_grupo, $fecha1, $fecha2);
        $n_faltas = 0;
        while ($fila4 = mysqli_fetch_assoc($faltas)) {
            $n_faltas = $fila4['faltas'];
        }

        $total = $n_asistencias + $n_retardos + $n_faltas;

        if ($total > 0) {
            $porcentaje_a = ($n_asistencias / $total) * 100;
            $porcentaje_r = ($n_retardos / $total) * 100;
            $porcentaje_f = ($n_faltas / $total) * 100;
            $porcentaje_t = 100; 
        } else {
            $porcentaje_a = 0;
            $porcentaje_r = 0;
            $porcentaje_f = 0;
            $porcentaje_t = 0;
        }

            $alumnos .= "
            <tr>
                <td>".$fila['nombre'].' '.$fila['ap_pat'].' '.$fila['ap_mat']."</td>
                <td>
                    <div>
                        ".$n_asistencias."
                    </div>
                    <div>
                        ".number_format($porcentaje_a, 1)."%
                    </div>
                </td>
                <td>
                    <div>
                        ".$n_retardos."
                    </div>
                    <div>
                        ".number_format($porcentaje_r, 1)."%
                    </div>
                </td>
                <td>
                    <div>
                        ".$n_faltas."
                    </div>
                    <div>
                        ".number_format($porcentaje_f, 1)."%
                    </div>
                </td>
            </tr>";
        }
    }

     $materia_n=i_materia($id_materia);
     while($fila3 = mysqli_fetch_assoc($materia_n)){
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
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Informe de asistencias por periodo</h1>
    <div class="boton2">
    <form action="inicio.php" method="post">
    <button type="submit"><i class="bi bi-arrow-left-circle-fill volver"></i></button>
    </form>  
    <div class="fechas">
        <form action="" method="post">
            <div class="busca2">
            <input type="date"  name="fecha1"><input type="date" name="fecha2"> 
            <button type="submit" name="buscar" class="buscar"> <i class="bi bi-search buscar"></i> Buscar</button>
            </div>
        </form>
    </div>
    </div>
      <br>
      <div class="tabla_a">
            <table>
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Asistencias</th>
                    <th>Retardos</th>
                    <th>Faltas</th>
                </tr>
                </thead>
        <tbody>
            <?php echo  $alumnos; ?>
        </tbody>
            </table>
    </div>
    </body>
</html>
