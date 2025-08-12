<?php
session_start();
include('funciones.php');

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
        exit();
    }
}

if ($id_grupo) {
    $i_alumnos = obtener_a_g($id_grupo);
    $alumnos = "";
    $i=1;
    while ($fila = mysqli_fetch_assoc($i_alumnos)) {
        $calificaciones = m_calificacion($id_grupo, $id_materia, $fila['id_alumno']);
        while ($fila2 = mysqli_fetch_assoc($calificaciones)) {
            $alumnos .= "
            <tr>
                <td>$i</td>
                <td>".$fila['id_alumno']."</td>
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='id_calificacion' value='$fila2[id_parcial1]'>
                        <input type='hidden' name='id_alumno' value='$fila2[id_alumno]'>
                        <input type='hidden' name='id_grupo' value='$id_grupo'>
                        <input type='hidden' name='id_materia' value='$id_materia'>
                        " . $fila['nombre'] . ' ' . $fila['ap_pat'] . ' ' . $fila['ap_mat'] . "
                </td>
                <td>
                    " . $fila2['valor1'] . "
                </td>
                <td>
                    <button type='submit' name='editar'><i class='bi bi-pencil-square editar'></i></button>
                    </form>
                </td>
            </tr>";
            $i++;
        }
    }
    
}

$actualizacion="";
if(isset($_POST['editar'])){
    $id_calificacion = $_POST['id_calificacion'];
    $id_alumno = $_POST['id_alumno'];
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];

    $actualizacion.="
    <form action='' method='post' class='actualizar'>
        <input type='hidden' name='id_calificacion' value='" . $id_calificacion . "'>
        <input type='hidden' name='id_alumno' value='" . $id_alumno . "'>
        <input type='hidden' name='id_grupo' value='" . $id_grupo . "'>
        <input type='hidden' name='id_materia' value='" . $id_materia . "'>
        <div class='califica'>
        <label for='nueva_calificacion' >Nueva Calificación:</label> <br><br>
        <input type='int' name='valor'  required><br>  
        </div> 
        <button type='submit' name='actualizar' class='actualiza_b'><i class='bi bi-upload '></i>   Actualizar</button>
    </form>";
} 

if (isset($_POST['actualizar'])) {
    $id_calificacion = $_POST['id_calificacion'];
    $valor= $_POST['valor'];
    $id_alumno = $_POST['id_alumno'];
    $id_grupo = $_POST['id_grupo'];
    $id_materia = $_POST['id_materia'];
    $fecha_ac = date("Y-m-d");
    $mensaje="";
    if($valor<=10 && $valor>=5){
        modifica_parcial1($valor, $id_grupo, $id_materia, $id_alumno, $id_calificacion);
        header("Location: e_parcial1.php");
        exit();
    }else{
        $mensaje = "La calificación no es válida";
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <link rel="stylesheet" href="../css/calificaciones.css">
    <title>Calificacion</title>
</head>
<body>
    <form action="" method="post" class="cprincipal">
    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Registro de Calificaciones Primer Parcial</h1>
    <div>
   <a href='inicio.php'> <button type="button"><i class="bi bi-arrow-left-circle-fill volver"></i></button></a>

    </div>
    <?php
    if (!empty($mensaje)) {
        echo "<script>Swal.fire('$mensaje');</script>";
    }
?>

    <div class="tabla_a">
 <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Matrícula</th>
                    <th>Nombre del alumno(a)</th>
                    <th>Primer parcial</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
            <?php echo $alumnos; ?>
        </tbody>
        </table>
        <?php echo $actualizacion; ?>
    </div>
    <div>

</body>
</html>
