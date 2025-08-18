<?php
session_start();
$dir = "../../general/";

include ($dir."php/admin.php");
include ($dir."db/admin.php");
include ($dir."db/unExamen.php");
include ($dir."db/basica.php");

$referencias = "
    <link rel='stylesheet' href='style.css'>
    ";

cabeza("Un Examen - Udimex", $referencias, "");

usuario("../../", 'index.php');
menu_i();

$estudiantes = obtenEstudiantes();
$regulares = "";
$irregulares = "";
$cont_regulares = 0;
$cont_irregulares = 0;

while ($alumno = mysqli_fetch_assoc($estudiantes)) {
    $fullName = $alumno['ap_pat'] . " " . $alumno['ap_mat'] . " " . $alumno['nombre'];
    $nombre = $alumno['nombre'];
    $fullName = strtoupper($fullName);
    $id = $alumno['id_alumno'];
    $aciertos = obtenAciertos($alumno['id_alumno']);
    while ($acierto = mysqli_fetch_assoc($aciertos)) {
        $total = $acierto['aciertos'];
        $promedio = ($total * 10) / 325;
        $promedio = number_format($promedio, 1);
    }

    if ($promedio >= 7) {
        $regulares = $regulares .
            "<tr>
            <td class='tc'>$id</td>
            <td>$fullName</td>
            <td class='tc'>$promedio</td>
            <td class='tc'><a class='btn' onclick='togglePopup(1,$id,$promedio)'>Subir</a></td>
            <input type='hidden' value='$nombre' id='alumno-$id'>
        </tr>";
        $cont_regulares ++;
    } else {
        $irregulares = $irregulares .
            "<tr>
            <td class='tc'>$id</td>
            <td>$fullName</td>
            <td class='tc'>$promedio</td>
            <td class='tc'><a class='btn' onclick='togglePopup(2,$id,$promedio)'>Cambiar</a></td>
            <input type='hidden' value='$nombre' id='alumno-$id'>
        </tr>";
        $cont_irregulares ++;
    }
}

if($cont_irregulares == 0){
    $irregulares = "<tr><td colspan='4'><p class='tc'>Sin alumnos registrados</p></td></tr>";
}

if($cont_regulares == 0){
    $regulares = "<tr><td colspan='4'><p class='tc'>Sin alumnos registrados</p></td></tr>";
}
// -------------------------------------------------------------------------------------------------------
// Para examenes
$fechaInicio = Date("Y-m-d");
$fecha = new DateTime($fechaInicio);
$fecha->modify("-1 day");
$fechaIn = $fecha->format("Y-m-d");
$fecha->modify("+3 months");
$fechaFi = $fecha->format("Y-m-d");


$alumnos = esperaExamen($fechaIn, $fechaFi);
$proximos = "";
$cont_proximos = 0;

while ($alumno = mysqli_fetch_assoc($alumnos)) {
    $fullName2 = $alumno['ap_pat'] . " " . $alumno['ap_mat'] . " " . $alumno['nombre'];
    $id2 = $alumno['id_alumno'];
    $fecha = $alumno['fecha'];
    $grupo = $alumno['id_grupo'];

    if ($grupo != 0) {
        $examenes = examenGrupo($grupo);
        while($examen = mysqli_fetch_assoc($examenes)){
            $total = $examen['totales'];
            if($total == 1){
                $estado = "<p>Grupo Asignado/Examen activado</p>";
                $form = "<a class='btn' href='../grupos/materia_ver.php?id=$grupo'>Grupo</a>";
            }else{
                $estado = "<p>Grupo Asignado/Sin Examen</p>";
                $form = "
                    <a class='btn' href='../grupos/materia_ver.php?id=$grupo'>Grupo</a>
                    <form action='activar.php'method='POST'>
                        <input type='hidden' value='$grupo' name='grupo'>
                        <input type='hidden' value='2' name='type'>
                        <input type='submit' class='btn' value='Activar'>
                    </form>";
            }
        }
    } else {
        $form = "<form action='activar.php' method='POST'>
                    <input type='hidden' name='id' value='$id2'>
                    <input type='hidden' name='type' value='1'>
                    <input type='submit' value='Asignar' class='btn'>
                </form>";
        $estado = "<p>Sin Grupo</p>";
    }
    
    $proximos = $proximos . "
    <tr>
        <td class='tc'>$id2</td>
        <td>$fullName2</td>
        <td class='tc'>$fecha</td>
        <td class='tc'>$estado</td>
        <td class='tc'>$form</td>
    </tr>";

    $cont_proximos ++;
}

if($cont_proximos === 0){
    $proximos = "<tr><td colspan='5'><p class='tc'>Sin alumnos registrados</p></td></tr>";
}

?>
<body>
    <a class='btn' onclick='cambios();'>Vista</a>
    <div class="main-container" id='part1'>
        <div class="separacion">
            <h2>Alumnos pendientes para examen</h2>
        </div>
        <div class="part3">
            <table class="main-table">
                <thead>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>Aplicación</td>
                    <td>Estado</td>
                    <td>Acciones</td>
                </thead>
                <tbody>
                    <?php echo $proximos; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-container" id='part2' style='display:none;'>
        <div class="separacion">
            <h2>Calificaciones de un solo examen</h2>
        </div>
        <div class="second-container">
            <div class='part1'>
                <div class="separacion">
                    <h3>Regulares</h3>
                </div>
                <table class="main-table">
                    <thead>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Promedio</td>
                        <td>Acciones</td>
                    </thead>
                    <tbody>
                        <?php echo $regulares; ?>
                    </tbody>
                </table>
            </div>
            <div class="part2">
                <div class="separacion">
                    <h3>Irregulares</h3>
                </div>
                <table class="main-table">
                    <thead>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Promedio</td>
                        <td>Acciones</td>
                    </thead>
                    <tbody>
                        <?php echo $irregulares; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span onclick='closeModal();' class="close">&times;</span>
            <h2 class='modal-title'>Subir calificación</h2>
            <div class='separacion2'></div>
            <div>
                <table>
                    <tr>
                        <td>Matematicas</td>
                        <td><input type='number' id='matematicas' class='tc' min='5' max='10' step='0.1'></td>
                    </tr>
                    <tr>
                        <td>Comprension</td>
                        <td><input type='number' id='comprension' class='tc' min='5' max='10' step='0.1'></td>
                    </tr>
                    <tr>
                        <td>Lengua</td>
                        <td><input type='number' id='lengua' class='tc' min='5' max='10' step='0.1'></td>
                    </tr>
                    <tr>
                        <td>Analitico</td>
                        <td><input type='number' id='analitico' class='tc' min='5' max='10' step='0.1'></td>
                    </tr>
                </table>
            </div>
            <h3>Promedio actual: <span id='cal'></span></h3>
            <div id="content-popup"></div>
            <form id='calificaciones' action="activar.php" method="POST">
                <input type='hidden' id='matematicas2' name='matematicas'>
                <input type='hidden' id='comprension2' name='comprension'>
                <input type='hidden' id='lengua2' name='lengua'>
                <input type='hidden' id='analitico2' name='analitico'>
                <input type='hidden' id='alumno' name='alumno'>
                <input type='hidden' name='type' value='3'>
                <input id='send' type='submit' disabled value='Subir' class='btn'>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>