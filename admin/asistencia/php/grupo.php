<?php
session_start();
include('funciones.php');

$carrera = "";
$bloque = "";
$materia = "";

$datos = b_carrera();
while ($fila = mysqli_fetch_assoc($datos)) {
    $carrera .= "<option value='" . $fila['id_carrera'] . "' required>" . $fila['nombre'] . "</option>";

    $datos2 = b_bloque($fila['id_carrera']);
    $bloque .= "
    <div id='bloque" . $fila['id_carrera'] . "' class='bloques' style='display:none;'>
        <select class='seleccion_b' name='bloque' onchange='actualizarMaterias(" . $fila['id_carrera'] . ")'>
            <option value=''>Seleccionar Bloque</option>";
    while ($fila2 = mysqli_fetch_assoc($datos2)) {
        $bloque .= "<option value='" . $fila2['bloque'] . "' required>" . $fila2['bloque'] . "</option>";
    }
    $bloque .= "</select></div>";

    $materias = b_materia($fila['id_carrera']);
    $materia .= "
    <div id='materia" . $fila['id_carrera'] . "' class='materias' style='display:none;'>";
    while ($fila3 = mysqli_fetch_assoc($materias)) {
        $materia .= "<div class='selec_materia' data-bloque='" . $fila3['semestre'] . "' style='display:none;'>
            <input type='checkbox' name='materia[]' value='" . $fila3['id_materia'] . "' >
            <label>" . $fila3['nombre'] . "</label></div>";
    }
    $materia .= "</div>";
}


if($_POST){
    if (isset($_POST['dias'])) {
      $tipo = $_POST ['carrera'];
      $materia = $_POST ['materia'];
      $dias = $_POST['dias'];
      $horai=$_POST['horai'];
      $horaf=$_POST['horaf'];
      $horaiFormato = date("h:i A", strtotime($horai));
      $horafFormato = date("h:i A", strtotime($horaf));
      $horario= $horaiFormato ." - ". $horafFormato;
      $id_us= 1;
      $dia_s = implode(", ", $dias);
      $id_grupo = g_dia($dia_s,$tipo);
    $_SESSION ['id_grupo']= $id_grupo;
    $_SESSION ['id_materia']= $materia;
    $_SESSION ['id_carrera']= $tipo;
    $_SESSION ['horario']= $horario;
    $_SESSION ['dia_s']= $dia_s;
    $contador = count($materia);
    for ($i = 0; $i < $contador; $i++) {
        $materias = $materia[$i];
        g_horario($id_grupo, $horario, $id_us, $materias);
        g_mat_g($materias, $id_grupo);
    }
    
} 
header('location:alumno.php');
}  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación de Grupos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/grupo.css">
</head>
<body>
<div>
    <h1>Registro de Grupos</h1>
    <br>
    <form action="inicio.php" method="post">
    <button type="submit"><i class="bi bi-arrow-left-circle-fill volver"></i></button>
    </form>
    <br>
    <form method="post" action="" class="formulario">
        <br>
        <label for="carrera">CARRERA:</label>
        <select name="carrera" id="carrera" class="carrera" onchange="vista();">
            <option value="0">Seleccionar</option>
            <?php echo $carrera; ?>
        </select>
        <br><br>

        <label>BLOQUE:</label>
        <div id="rbloque"></div>
        <br>
        <label>MATERIAS:</label>
        <div id="rmateria"></div>
        <br>

        <label>HORARIO:</label>
        <input type="time" id="horai" class="horaf" name="horai" placeholder="Hora de inicio"> 
        <input type="time" id="horaf" class="horaf" name="horaf" placeholder="Hora final">                    
        <br>

        <label>DIAS:</label>
        <input type="checkbox" name="dias[]" value="Lunes" id="lunes" class="checa"><label for="lunes">Lunes</label>
        <input type="checkbox" name="dias[]" value="Martes" id="martes"><label for="martes">Martes</label>
        <input type="checkbox" name="dias[]" value="Miércoles" id="miercoles"><label for="miercoles">Miércoles</label>
        <input type="checkbox" name="dias[]" value="Jueves" id="jueves"><label for="jueves">Jueves</label>
        <input type="checkbox" name="dias[]" value="Viernes" id="viernes"><label for="viernes">Viernes</label>
        <input type="checkbox" name="dias[]" value="Sábado" id="sabado"><label for="sabado">Sábado</label>
        <input type="checkbox" name="dias[]" value="Domingo" id="domingo"><label for="domingo">Domingo</label>
        <input type="checkbox" name="dias[]" value="En línea" id="linea"><label for="linea">En línea</label>
        <br><br> 
        <button type="submit" value="GUARDAR" class="g_grupo">GUARDAR</button>

    </form>
    <div hidden>
<?php echo $bloque; ?>
<?php echo $materia; ?>
</div>

</div>
</body>
<script>
function vista() {
    var carreraId = document.getElementById("carrera").value;

    document.querySelectorAll('.bloques').forEach(function(elem) {
        elem.style.display = 'none';
    });
    document.querySelectorAll('.materias').forEach(function(elem) {
        elem.style.display = 'none';
    });

    if (carreraId != 0) {
        var bloque = document.getElementById("bloque" + carreraId);
        var materia = document.getElementById("materia" + carreraId);

        if (bloque) {
            document.getElementById("rbloque").innerHTML = bloque.innerHTML;
            bloque.style.display = 'block';
        }
        if (materia) {
            document.getElementById("rmateria").innerHTML = materia.innerHTML;

            document.querySelectorAll('#rmateria .selec_materia').forEach(function(materia) {
                materia.style.display = 'none';
            });
        }
    }
}

function actualizarMaterias(carreraId) {
    var bloqueSeleccionado = document.querySelector("#rbloque .seleccion_b").value;

    var materias = document.querySelectorAll("#rmateria .selec_materia");
    materias.forEach(function(materia) {
        materia.style.display = 'none';
    });

    if (bloqueSeleccionado) {
        var materiasRelacionadas = document.querySelectorAll("#rmateria .selec_materia[data-bloque='" + bloqueSeleccionado + "']");
        materiasRelacionadas.forEach(function(materia) {
            materia.style.display = 'block';
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    vista(); 
});

</script>

</html>
