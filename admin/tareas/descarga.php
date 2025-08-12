<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/materias.php");
include("../../general/consultas/carreras.php");
include("../../general/funcion/basica.php");
include("../../general/consultas/tarea.php");
$conexion = mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
// Obtiene el nombre del archivo desde la URL
$archivo = isset($_GET['archivo']) ? $_GET['archivo'] : '';

if ($archivo) {
    // Establece la ruta del archivo
    $ruta = "../../alumno/tarea-alumno/" . $archivo;

    // Verifica si el archivo existe
    if (file_exists($ruta)) {
        // Establece los encabezados para la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($ruta).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta));
        flush(); // Limpia el búfer del sistema
        readfile($ruta); // Lee el archivo y envíalo al navegador
        exit;
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se especificó ningún archivo para descargar.";
}
