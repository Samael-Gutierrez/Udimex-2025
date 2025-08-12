<?php
include "inscribir.php";

$id_carrera = $_POST['carrera'];

$resultado = searchGroups($id_carrera);

if ($resultado->num_rows > 0) {
    echo "
    <p class='aviso'>Puedes colocar al alumno a un grupo existente o uno nuevo.</p>
    <table class='table-groups'>
        <tr>
            <th class='header'>Grupo</th>
            <th class='header'>Días</th>
            <th class='header'>Opciones</th>
        </tr>
    ";

    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "
            <tr>
                <td class='bb dfrc'>". $fila['id_grupo'] . "</td>
                <td class='bb'>". $fila['dias'] . "</td>
                <td class='bb dfrc'><input type='radio' name='grupo' value='" . $fila['id_grupo'] . "'></td>
            </tr>
        ";
    }

    echo "
        </table>
        ";
        
    } else {
        echo "
        <p class='aviso'>Sin grupos creados para esta carreras, le sugerimos crear uno nuevo.</p>
    ";
}
?>