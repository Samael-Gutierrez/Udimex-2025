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

//permiso();
cabeza("Tareas - Udimex","");

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_tarus']) && isset($_POST['nuevo_estado'])) {
        $id_tarus = intval($_POST['id_tarus']);
        $nuevo_estado = intval($_POST['nuevo_estado']);

        // Consulta para actualizar el estado de la tarea
        $sql_update = "UPDATE `tarea_us` SET `estado` = $nuevo_estado WHERE `id_tarus` = $id_tarus";

        if (mysqli_query($conexion, $sql_update)) {
            $_SESSION['mensaje'] = "Estado de la tarea actualizado correctamente.";
            // Redirigir a index.php después de la actualización
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['mensaje'] = "Error al actualizar el estado de la tarea: " . mysqli_error($conexion);
        }
    } else {
        $_SESSION['mensaje'] = "Formulario no enviado correctamente.";
    }
} else {
    $id_tarus = isset($_GET['id_tarus']) ? intval($_GET['id_tarus']) : '';
}
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Estado de Tarea</title>
</head>
<body>

<h2>Actualizar Estado de Tarea</h2>

<form method="post">
    <input type="hidden" name="id_tarus" value="<?php echo htmlspecialchars($id_tarus); ?>">
    <label for="nuevo_estado">Nuevo Estado:</label>
    <select id="nuevo_estado" name="nuevo_estado">
        <option value="0">No Revisada</option>
        <option value="1">Revisada</option>
    </select>
    <br>
    <button type="submit">Actualizar Estado</button>
</form>

</body>
</html>