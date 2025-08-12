<?php
// Ruta donde se guardarán los archivos subidos
$directorioDestino = "../../../../archivos/";

// Verificamos si el formulario fue enviado y si el archivo fue cargado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdfFile'])) {
    // Obtenemos el archivo cargado
    $archivo = $_FILES['pdfFile'];

    // Comprobamos si el archivo es un PDF
    $tipoArchivo = mime_content_type($archivo['tmp_name']);
    if ($tipoArchivo === 'application/pdf') {
        $nombreArchivoDestino = $directorioDestino . $_POST['nameFile'] . ".pdf";

        // Intentamos mover el archivo de su ubicación temporal a la carpeta de destino
        if (move_uploaded_file($archivo['tmp_name'], $nombreArchivoDestino)) {
            echo 'Archivo subido exitosamente.';
        } else {
            echo 'Hubo un error al subir el archivo.';
        }
    } else {
        echo 'El archivo debe ser un PDF.';
    }
} else {
    echo 'No se ha recibido ningún archivo.';
}
?>