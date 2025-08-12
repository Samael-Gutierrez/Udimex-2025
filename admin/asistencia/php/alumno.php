<?php
session_start();
$id_grupo = $_SESSION['id_grupo'];
$materia = $_SESSION ['id_materia'];
$tipo = $_SESSION['id_carrera'];
$horario = $_SESSION ['horario'];



include ('funciones.php');

$mensaje = "";
 if($_POST){
     $nombre= trim($_POST['nombre']);
     $a_paterno= trim($_POST['a_paterno']);
     $a_materno= trim($_POST['a_materno']);   
     $datos=b_alumno($nombre, $a_paterno, $a_materno);
     if ($fila = mysqli_fetch_assoc($datos)) {
         $id_alumno = $fila['id_alumno'];
         a_alumno($id_alumno, $id_grupo);
        //  g_al_mat($id_alumno,$materia);
     }
     else{
        $mensaje = "El alumno no fue encontrado";
    }
   }
 
$alumnos_grupo = obtener_a_g($id_grupo);
while($fila = mysqli_fetch_assoc($alumnos_grupo)){
         $alumno = $fila['nombre'];
}

// $n_materia = i_materia($materia);
// while($fila = mysqli_fetch_assoc($n_materia)){
//        $nombre_m = $fila['nombre'];
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"  href="../css/alumnos.css">
    <title>Agrega alumno</title>
</head>
<body>

<div class="infom">
    <h3>Grupo <?php echo $id_grupo;?> </h3>
    <!-- <h3>Asignatura: <?= $nombre_m;?></h3> -->
    <h3>Horario: <?=$horario;?></h3>
</div>
    <h1>Alumno(a)</h1>
    <div class="alumno">
    <form method="post" action="" class="registro">

    <label for="nombre">NOMBRE(S):</label> 
    <input type="text" id="nombre" name="nombre" required>

    <label for="ap_pat">APELLIDO PATERNO:</label>
    <input type="text" id="ap_pat" name="a_paterno" required>

    <label for="ap_mat">APELLIDO MATERNO:</label>
    <input type="text" id="ap_mat" name="a_materno" required>
    <div>
    <button type="submit"><i class="bi bi-plus-circle-fill add"></i></button>
    </div>

    </form> 
    </div>

<?php
    if (!empty($mensaje)) {
        echo "<script>Swal.fire('$mensaje');</script>";
    }
?>
<br>
    <h1>Lista de Alumnos</h1>

    <table>
        <thead>
            <th>No.</th>
            <th>Matrícula</th>
            <th>Nombre(s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
        </thead>
        <tbody>
        <?php 
        $i=1;
        foreach ($alumnos_grupo as $alumno): ?>
                <tr>
                    <td><?= $i++;?></td>
                    <td><?=$alumno ['id_alumno'];?></td>
                    <td><?= $alumno['nombre']; ?> 
                    <td><?=$alumno['ap_pat']; ?></td>
                    <td><?= $alumno['ap_mat']; ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
<br>
<form action="inicio.php" method="post">
        <button type='submit' class=><i class="bi bi-arrow-left-circle-fill volver"></i></button>   
</form>
</body> 
</html>
