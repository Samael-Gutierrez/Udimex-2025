<?php
session_start();
 include('funciones.php');
 

       
    
 
 
if(isset($_GET['id_grupo'])){
    $id_grupo = $_GET['id_grupo'];
    $id_materia = $_GET['id_materia'];
    $dias = $_GET['dias'];
    $_SESSION['id_grupo']=$id_grupo;
    $_SESSION['dias']=$dias;
    $_SESSION['id_materia']=$id_materia;
    header("location:pase.php");
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
if(isset($id_grupo)){
    $i_alumnos =   obtener_a_g($id_grupo);
    $alumnos = "";
    $i=1;
    while($fila = mysqli_fetch_assoc($i_alumnos)){
    $alumnos = $alumnos. "
                <form method='get' id='alumnos'>
                <tr>
                <td>$i</td>
                <td>".$fila['id_alumno']."
                </td>
                <td>
                    ".$fila['nombre'].' '. $fila ['ap_pat']. ' '. $fila['ap_mat']." 
                </td> 
                <td>
                    <button type='submit' name='asistencia[]' value='0'><i class='bi bi-check2-all verde'></i></button>
                    <button type='submit' name='asistencia[]' value='0.5'><i class='bi bi-check2 amarillo'></i></button>
                    <button type='submit' name='asistencia[]' value='1'><i class='bi bi-x-circle-fill rojo'></i></button>
                    <input type='text' name='id_alumno[]' value='$fila[id_alumno]' hidden>
                </td>
                </tr>
                </form>";
    $i++;
    }
}
date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");

$mensaje="";
if(isset($_GET['asistencia'])){
    $asistencia = $_GET['asistencia'];
    $id_alumno= $_GET['id_alumno'];
    $contador = count($id_alumno);
    for($i=0; $i<$contador; $i++){
        $asistencias = $asistencia[$i];
        $id = $id_alumno[$i];
        $id_materia;
        $id_grupo;
     $r_asistencia=r_asistencia($id,$id_grupo,$fecha_ac,$id_materia);
    while($fila2 = mysqli_fetch_assoc($r_asistencia)){
            $asistencia_r= $fila2['asistencia'];
     }
    if($asistencia_r>0){
        $mensaje="El registro ya fue realizado";
    }else{
        g_lista($id, $id_grupo, $id_materia, $asistencias, $fecha_ac);
    }
}
}

// if (!empty($mensaje)) {
//     echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
//     echo "<script>Swal.fire('$mensaje');</script>";
// }


//  if (!empty($mensaje)) {
//      echo "<div class='alerta'>$mensaje</div>";
//  }

$n_materia = i_materia($id_materia);
while($fila = mysqli_fetch_assoc($n_materia)){
 $nombre_m = $fila['nombre'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet"  href="../css/pase.css">
<title>Registro de Asistencia</title>
</head>

    <body>
    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
    <h1>Registro de Asistencia</h1>
    <div class="botones">
             <form action="inicio.php">
            <button><i class="bi bi-arrow-left-circle-fill volver"></i></button>
            </form>
            <div class="desplegable">
                <button class="boton"><i class="bi bi-clipboard2-check-fill informe"></i></button>
                <div class="links">
                <form action="info_periodo.php" method="post">
                    <input type="hidden" name="id_grupo" value= <?= $id_grupo?>>
                    <input type="hidden" name="id_materia" value= <?= $id_materia;?>>
                    <input type="hidden" name="dias" value=<?= $dias;?>>
                    <button type="submit"><i class="bi bi-calendar4-week informe"></i></button>
                    </form>
                    
                    <form action="info_semanal.php" method="post">
                    <input type="hidden" name="id_grupo" value= <?= $id_grupo?>>
                    <input type="hidden" name="id_materia" value= <?= $id_materia;?>>
                    <input type="hidden" name="dias" value=<?= $dias;?>>
                    <button type="submit"><i class="bi bi-calendar-month informe"></i></button>
                    </form>
                </div>   
            </div>
    </div>
      <br>
<!-- <div class="alerta"></div>  -->
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
                    <th>Nombre</th>
                    <th>Asistencia</th>
                </tr>
                </thead>
        <tbody>
            <?php echo $alumnos; ?>
        </tbody>
            </table>        
    </div>
    </body>
</html>