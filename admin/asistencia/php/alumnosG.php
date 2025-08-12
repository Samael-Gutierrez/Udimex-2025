<?php

session_start();
include ('funciones.php');
include("../../funciones.php");
include("../../../general/consultas/usuario.php");
include('../../../general/consultas/admin.php');

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
if(isset($_POST['eliminar'])){
    $id_alumno=$_POST['id_alumno'];
    e_alumno($id_grupo, $id_alumno);
}
if(isset($id_grupo)){
    $i_alumnos =   obtener_a_g($id_grupo);
    $alumnos = "";
    $i=1;
    while($fila = mysqli_fetch_assoc($i_alumnos)){
    $alumnos = $alumnos. "
                <tr class='alumnos' id='alumnos' name='alumnos'>
                <td> $i</td>
                <td> ".$fila['id_alumno']."</td>
                <td>
                    ".$fila['nombre'].'</td> 
                 <td>    '. $fila ['ap_pat']. ' </td> 
                  <td>   '. $fila['ap_mat']."</td>  
                </td> 
                <td>
                <form method='post'>
                <input type='hidden' name='id_alumno' value='$fila[id_alumno]'>
                <button type='submit' name='eliminar'><i class='bi bi-trash'></i></button>
                </form>
                </td>
                </tr>";
      $i++;
    }
}
$materia_n = i_materia($id_materia);
while ($fila3 = mysqli_fetch_assoc($materia_n)) {
    $nombre_m = $fila3['nombre'];
}
date_default_timezone_set('America/Mexico_City');
$fecha_ac = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"  href="../css/alumnosG.css">
    <title>Tus alumnos</title>
</head>
<body>
    <div>
    <div class="infom">
    <h3>Asignatura : <?= $nombre_m;?></h3>
    <h3>Fecha : <?= $fecha_ac;?></h3>
    </div>
       <h1>Tus alumnos</h1>
        <br>
        <div class="botones">
        <form action="inicio.php" method="post">
            <button type="text"><i class="bi bi-arrow-left-circle-fill volver"></i></button>
            </form>
            <form action="" method="post" class="buscador">
        <input type="text" name="campo" id="campo2" class="busca" placeholder="Buscar" oninput="filtrado();"> 
        </form>
       </div> 

      <span id="filtro"> </span>
      <div class="tabla_a">
      <table>
        <thead>
            <th>No.</th>
            <th>Matrícula</th>
            <th>Nombre(s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>--</th>
        </thead>
        <tbody>
            <?php echo $alumnos; ?>
        </tbody>
            </table>
      </div>

        </div>

</body>     

<script>
  
 function filtrado() {
      var campo = document.getElementById('campo2').value.toUpperCase();
      var info = document.getElementsByClassName('alumnos'); 
      var filtro = document.getElementById('filtro');
   
        campo=campo.replace("Á","A");
        campo=campo.replace("É","E");
        campo=campo.replace("Í","I");
        campo=campo.replace("Ó","O");
        campo=campo.replace("Ú","U");

      var count = 0; 
      for (var i = 0; i < info.length; i++) {
        var texto = info[i].innerText;
         newtexto=texto.toUpperCase();
         newtexto=newtexto.replace("Á","A");
         newtexto=newtexto.replace("É","E");
         newtexto=newtexto.replace("Í","I");
         newtexto=newtexto.replace("Ó","O");
         newtexto=newtexto.replace("Ú","U");

        if (newtexto.includes(campo)) { 
          info[i].style.display = '';
          count++;
        } else {
          info[i].style.display = 'none';
        }
      }

      if (count === 0) {
        filtro.innerHTML = "No hay alumnos para mostrar";
      } else {
        filtro.innerHTML = ""; 
      }
    }
</script>
</html>
