<?php

include "inscribir.php";

if (isset($_POST['dias']) && is_array($_POST['dias'])) {
    $carrera = $_POST['carrera'];
    $diasSeleccionados = $_POST['dias'];

    $diasFinales =  implode(", ", $diasSeleccionados);

    addGroup($diasFinales, $carrera);
}