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

if(isset($id_grupo)){
    $i_alumnos =   obtener_a_g($id_grupo);
    $alumnos = "";
    $i=1;
    while($fila = mysqli_fetch_assoc($i_alumnos)){
        $alumnos .= "
            <tr>
            <td>$i</td>
                 <td>".$fila['id_alumno']."
                <td>
                    ".$fila['nombre'].' '. $fila['ap_pat']. ' '. $fila['ap_mat']." 
                </td> 
                <td>
                    <input type='int' name='valor[]'>
                    <input type='text' name='id_alumno[]' value='".$fila['id_alumno']."' hidden>
                </td> 
            </tr>";
    $i++;
    }
}

date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");
$mensaje="";


 if(isset($_POST['cargar'])){ 
     $valor = $_POST['valor'];
     $id_grupo;  
     $id_materia;
     $id_alumno = $_POST['id_alumno'];
     $contador = count ($id_alumno);
     $valido = true;
     for($i = 0; $i < $contador; $i++){
         $calificacion = $valor[$i];
         if($calificacion<5 || $calificacion>10){
             $valido = false;
             $mensaje = "Una o más calificaciones no son válidas.";
             break;
         }
     }

     if($valido){
         for($i = 0; $i < $contador; $i++){
             $calificacion = $valor[$i];
             $id = $id_alumno[$i];
             g_calificacion($id, $id_materia, $id_grupo, $calificacion, $fecha_ac);
         }
         header("Location: e_parcial1.php");
         exit();
     }
    }
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
    <title>Calificaciones</title>
</head>
<body>

    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Registro de Calificaciones Primer Parcial</h1>
    <br>
    <div class="botones2">
    <form action="inicio.php">
            <button><i class="bi bi-arrow-left-circle-fill volver"></i></button>
    </form>
    </div>

<?php
    if (!empty($mensaje)) {
        echo "<script>Swal.fire('$mensaje');</script>";
    }
?>
    <form action="" method="post" class="cprincipal">
    <div class="tabla_a">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Matrícula</th>
                    <th>Nombre del alumno(a)</th>
                    <th>Primer parcial</th>
                </tr>
            </thead>
            <tbody>
            <?php echo $alumnos; ?>

        </tbody>
        </table>
    </div>
    <div>
            <button type='submit'  name='cargar' class="cargar" ><i class="bi bi-upload"></i>  Cargar</button>
    </div>
    </form>
</body>
</html>

