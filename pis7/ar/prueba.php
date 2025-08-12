<?php
// Verifica si se ha enviado el parámetro "dato"
if (isset($_GET['dato'])) {
    $dato = $_GET['dato'];

    // Abre el archivo en modo de escritura (si no existe, lo crea)
    $archivo = fopen("1.alf", "a+");

    // Escribe el dato en el archivo
    fwrite($archivo, $dato);

    // Cierra el archivo
    fclose($archivo);

    echo "Dato guardado correctamente: " . $dato;
} else {
    echo "Error: No se recibió ningún dato.";
}
?>