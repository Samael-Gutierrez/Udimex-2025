<?php
session_start();
include('funciones.php');

if(isset($_POST['id_grupo'])){
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $_SESSION['id_grupo']=$id_grupo;
    $_SESSION['id_materia']=$id_materia;

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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



if($id_grupo){
    $i_alumnos = obtener_a_g($id_grupo);
    $alumnos = "";
    $estatus="";
    $i=1;
    while($fila = mysqli_fetch_assoc($i_alumnos)){
        $calificaciones = m_calificacion($id_grupo, $id_materia, $fila['id_alumno']);
        while($fila2 = mysqli_fetch_assoc($calificaciones)) {
           $calificacion2 = m_calificacion2($id_grupo, $id_materia,$fila['id_alumno']);
           while($fila3 = mysqli_fetch_assoc($calificacion2)){
            $calificacion=($fila2['valor1']+$fila3['valor2'])/2;
            if($calificacion>6){
                $estatus="Aprobado";
            }else{
                $estatus="Extraordinario";
            }
            $alumnos = $alumnos. "
            <tr>
            <td>$i</td>
            <td>".$fila['id_alumno']."</td>
            <td>
            ".$fila['nombre'].' '. $fila ['ap_pat']. ' '. $fila['ap_mat']."
            </td>
            <td>
            ".$fila2['valor1']."
            </td>
            <td>
            ".$fila3['valor2']."
            </td>
            <td>
            ".$calificacion."
            </td>
            <td>
            ".$estatus."
            </td>
            </tr>";
            $i++;
           }
        }

    }
}

date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");


$n_materia = i_materia($id_materia);
$nombre_m = mysqli_fetch_assoc($n_materia)['nombre'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/calificaciones.css">
    <title>Confirmación de Calificaciones</title>
</head>
<body>
    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Registro de Calificación final</h1>
    <div>
    <form action="inicio.php" method="post">
    <button type="submit"><i class="bi bi-arrow-left-circle-fill volver"></i></button>
    </form>
    </div>
    <div class="tabla_a">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Matrícula</th>
                    <th>Nombre del alumno(a)</th>
                    <th>Primer parcial</th>
                    <th>Segundo parcial</th>
                    <th>Calificacion final</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
            <?php echo $alumnos; ?>
        </tbody>
        </table>
    </div>
    <button class="descarga" onclick="window.location.href='descargar_pdf.php'"><i class="bi bi-download descargar"></i> DESCARGAR PDF</i></button>
</body>
</html>
