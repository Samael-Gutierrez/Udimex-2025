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




usuario("../../","index.php");
	echo "<center>";
	menu_i();
	/*echo "<br><br>
		<fieldset id='subtitulo'>SELECCIONA UNA OPCIÓN</fieldset>";
        $datos=ver_tarea();
        $tarea="";
        while ($fila=mysqli_fetch_assoc($datos)){
            $tarea="<tr><td>".$fila['archivo']."</td></tr>";
        }*/


        $menu="";
$tipo='';


// Función para buscar por nombre del alumno
function buscarAlumno($conexion, $nombre_alumno) {
    $sql = "SELECT id_usuario, nombre, ap_pat, ap_mat FROM usuario WHERE nombre LIKE ?";
    $stmt = mysqli_prepare($conexion, $sql);
    $nombre_alumno = '%' . $nombre_alumno . '%';
    mysqli_stmt_bind_param($stmt, 's', $nombre_alumno);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

$tarea = ""; 
$alumnos = [];
$nombre_completo_alumno = ""; 

if (isset($_GET['nombre_alumno'])) {
    $nombre_alumno = $_GET['nombre_alumno'];

    // Datos del alumno
    $datos = buscarAlumno($conexion, $nombre_alumno);

    // Recolectar los alumnos encontrados
    while ($fila = mysqli_fetch_assoc($datos)) {
        $alumnos[] = [
            "id_usuario" => $fila["id_usuario"],
            "nombre_completo" => $fila["nombre"] . " " . $fila["ap_pat"] . " " . $fila["ap_mat"]
        ];
    }

    // Si hay alumnos encontrados, buscar sus tareas
    if (!empty($alumnos)) {
        foreach ($alumnos as $alumno) {
            $id_usuario = $alumno["id_usuario"];
            $nombre_completo_alumno = $alumno["nombre_completo"];

            // Consulta para recuperar las tareas del alumno usando el ID
            $sql_tareas = "SELECT id_tarus, archivo, descripcion, estado FROM tarea_us WHERE id_alumno = ?";
            $stmt_tareas = mysqli_prepare($conexion, $sql_tareas);
            mysqli_stmt_bind_param($stmt_tareas, 'i', $id_usuario);
            mysqli_stmt_execute($stmt_tareas);
            $result_tareas = mysqli_stmt_get_result($stmt_tareas);

            // Verifica si la consulta devolvió resultados
            if (mysqli_num_rows($result_tareas) > 0) {
                while ($row = mysqli_fetch_assoc($result_tareas)) {
                    $ruta_completa = "../../alumno/tarea-alumno/" . $row['archivo'];
                    $ruta_descarga = "descarga.php?archivo=" . urlencode($row['archivo']);

                    $tarea .= "<tr>
                    <td>{$row['id_tarus']}</td>
                    <td><a href='$ruta_descarga'>{$row['archivo']}</a></td>
                    <td>{$row['descripcion']}</td>
                    <td>" . ($row['estado'] == 0 ? 'No Revisada' : 'Revisada') . "</td>
                    <td><a href='editar_estado.php?id_tarus={$row['id_tarus']}'>Editar Estado</a></td>
                </tr>";
                }
            }
        }

        // Si se encontraron tareas, mostrar el nombre completo de los alumnos
        if (!empty($tarea)) {
            echo "<h3>Tareas de: " . htmlspecialchars($nombre_completo_alumno) . "</h3>";
        } else {
            echo "No se encontraron tareas para estos alumnos.";
        }
    } else {
        echo "No se encontró ningún alumno con ese nombre.";
    }
} else {
    echo "Por favor, ingrese un nombre de alumno.";
}

mysqli_close($conexion);
?>


<body>

<h2>Buscar Tareas por Nombre del Alumno</h2>

<form action="" method="get">
    <label for="nombre_alumno">Nombre del Alumno:</label>
    <input type="text" id="nombre_alumno" name="nombre_alumno" required>
    <button type="submit">Buscar</button>
</form>

<?php if (!empty($nombre_completo_alumno)): ?>
    <h3>Tareas de: <?php echo htmlspecialchars($nombre_completo_alumno); ?></h3>
<?php endif; ?>

<table border=".5">
    <thead>
        <tr>
            <th>ID_tarea</th>
            <th>Archivo</th>
            <th>Descripción</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php
            echo $tarea;
        ?>
    </tbody>
</table>

</body>
</html>