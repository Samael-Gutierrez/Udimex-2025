<?php
	session_start();
	include("../general/funcion/basica.php");
	carga_estilo('../');
?>
    <link rel="stylesheet" href="calificaciones.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include 'funciones.php';
	permiso();
	menu('../');

	$id=$_SESSION["g_id"];
    $gruposs=getGroupById($id);
    while($grupos=mysqli_fetch_assoc($gruposs)){
        $grupo = $grupos['id_grupo'];
    }
    menu_flota();
    
    $nombres = busca_usuario($id);
    while($nombre = mysqli_fetch_assoc($nombres)){
        $fullName = $nombre['ap_pat'] . " " . $nombre['ap_mat'] . " " . $nombre['nombre'];
    }

    $counter = 0;
    $totales = counterHomeWorks($id);
    while($fila = mysqli_fetch_assoc($totales)){
        $counter = $fila['tareas']; 
    }

    if($counter<1){
        echo "<h2 class='title'>No tienes tareas registradas.</h2>";
    }else{
        echo "<h2 class='title'>Resumen de tus tareas</h2>";
    }

    echo "<a onclick='examenes()' class='btn-examen'>Exámenes</a>";

    $totalMaterias = obtenTotalMaterias($grupo);
    while($fila = mysqli_fetch_assoc($totalMaterias)){
        $totalM = $fila['materias'];
    }

    $materias = obtenMateriasActivas($grupo, $id);
    echo "<div class='main-container'>
            <input type='hidden' value='$id' id='id-alumno'>";
    if($totalM > 0){
        while($fila = mysqli_fetch_assoc($materias)){
            echo "
            <div class='cards' onclick='ocultarMaterias(".$fila['id_materia'].");'>
                <p>" . $fila['nombre'] . "</p>
            </div>";
        }
        
        echo "
        </div>
        ";
        
        $materias2 = obtenMateriasActivas($grupo, $id);
        while($fila1 = mysqli_fetch_assoc($materias2)){
            $counterMaterias = 1;
            $tareas = getHomeWorksByMateria($fila1['id_materia'], $id);
            echo "
                <div class='mt-3 main-table' id='table-".$fila1['id_materia']."' style='display:none;'>
                    <h6 class='materia'>".$fila1['nombre']."</h6>
                    <table class='table table-hover rounded tables'>
                    <tbody>
                        <tr class='thead'>
                            <th>N°</th>
                            <th>Archivo</th>
                            <th>Titulo</th>
                            <th>Subtitulo</th>
                            <th>Calificación</th>
                            <th>Entrega</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
            ";
            while($tarea = mysqli_fetch_assoc($tareas)){
                $visto = $tarea['visto'];
                $idTarea = $tarea['tarea'];
                $fecha_final = obtenerFechaLimite($idTarea, $id);
                while($final = mysqli_fetch_assoc($fecha_final)){
                    $ffs = $final['fecha_limite'];
                    $ff = new DateTime($ffs);
                }

                $estado = ($tarea['estado'] == 1)  ? "<p style='color:green'>Revisado</p>" : "<p style='color:red'>No revisado</p>";
                
                if($tarea['estado'] == 0){
                    $hoy = date('Y-m-d');
                    $hoy = new DateTime($hoy);
                    if($hoy <= $ff){
                        $entrega = "<p style='color:green'>$ffs</p>";
                    }else{
                        $entrega = "<p style='color:red'>$ffs</p>";
                    }

                    $detalles = "";
                    $calificacion = "Sin calificación";
                }else{
                    $fecha_entrega  = fechaEntrega($idTarea, $id);
                    while($fechas = mysqli_fetch_assoc($fecha_entrega)){
                        $fes = $fechas['fecha_entrega'];
                        $fe = new DateTime($fes);

                        $calificacion = $fechas['calificacion'];
                    }

                    if($fes <= $ffs) {
                        $entrega = "<p style='color:green;'>A Tiempo</p>";
                    }else{
                        $entrega = "<p style='color:red;'>Tardía</p>";
                    }
                    $detalles = "
                        <form action='detalles.php' method='POST'>
                            <input type='hidden' name='tarea' value='".$tarea['tarea']."'>
                            <input type='hidden' name='id' value='$id'>
                            <input type='hidden' name='alumno' value='$fullName'>
                            <input type='hidden' name='titulo' value='".$tarea['titulo']."'>
                            <input type='hidden' name='subtitulo' value='".$tarea['subtitulo']."'>
                            <input type='hidden' name='comentario' value='".$tarea['descripcion']."'>
                            <input type='hidden' name='grupo' value='$grupo'>
                            <input type='submit' class='btn btn-warning' value='Detalles'>
                        </form>
                    ";

                }
                
                if($visto == 1){
                    $vistos = "<i class='bi bi-flag-fill' style='color:green'></i><p style='display:inline-block'>".$tarea['archivo']."</p>";
                }else{
                    $vistos = "<i class='bi bi-flag' style='color:red'></i><p style='display:inline-block'>".$tarea['archivo']."</p>";
                }

                echo"
                        <tr>
                            <td>$counterMaterias</td>
                            <td>$vistos</td>
                            <td>".$tarea['titulo']."</td>
                            <td>".$tarea['subtitulo']."</td>
                            <td>$calificacion</td>
                            <td>$entrega</td>
                            <td>$estado</td>
                            <td>
                                $detalles
                            </td>
                        </tr>
            ";
            $counterMaterias ++;
            }
            echo "</tbody>
                </table>
            </div>
            ";
        }
    }else{
        echo "Sin materias activas";
    }

?>

<hr>

<div class="mt-3 main-table" style='display:none;' id='examenes'>
    <a class='btn-examen' onclick='examenesOff()'>Ocultar</a>
    <h2 class='title'>Calificación de exámenes</h2>
    <table class='table table-hover rounded tables'>
        <tbody>
            <tr class='thead'>
                <th>N°</th>
                <th>Fecha</th>
                <th>Materia</th>
                <th>Tema</th>
                <th>Calificación</th>
            </tr>
            <?php
                $count2 = 1;
                $examenes = totalExamenes($id);
                while($exa = mysqli_fetch_assoc($examenes)){
                    $contador = $exa['cal'];
                }

                if($contador < 1 ){
                    echo "
                        <tr>
                            <td colspan='5'><center>Sin calificaciones registradas</center></td>
                        </tr>
                    ";
                }

                $calificaciones = getRatingsById($id);
                while($cal = mysqli_fetch_assoc($calificaciones)){
                    $valor = $cal['valor'];
                    if($valor < 6) {
                        $cali = "<p style='color:red'>$valor</p>";
                    }else{
                        $cali = "<p style='color:green'>$valor</p>";
                    }
                    echo "
                        <tr>
                            <td>$count2</td>
                            <td>".$cal['fecha_registro']."</td>
                            <td>".$cal['nombre_materia']."</td>
                            <td>".$cal['contenido']."</td>
                            <td>$cali</td>
                        </tr>
                    ";
                    $count2 ++;
                }
            ?>
        </tbody>
    </table>
</div>
<br>
<br>
<br>
<br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function examenes() {
        const examenes = document.getElementById('examenes');
        examenes.style.display='block';
        examenes.scrollIntoView({behavior: 'smooth'});  
    }

    function examenesOff() {
        const examenes = document.getElementById('examenes');
        examenes.style.display='none';
    }

    const tablas = document.querySelectorAll('.tables');
    tablas.forEach(tabla => {
        const tbody = tabla.querySelector('tbody');
        const filas = tbody.getElementsByTagName('tr');
        if (filas.length === 1) {
            const nuevoTr = document.createElement('tr');
            const nuevoTd = document.createElement('td');
            const nuevoC = document.createElement('center');
            nuevoTd.setAttribute('colspan', '9');
            nuevoC.textContent = 'Sin tareas registradas en esta materia.';
            nuevoTr.appendChild(nuevoTd);
            nuevoTd.appendChild(nuevoC);
            tbody.appendChild(nuevoTr);
        }
    });

    function checkAndAddId(id) {
        if (!document.getElementById('table-'+id)) {
            innerHTML = "<p class='no-tareas'>Sin tareas registradas</p>";
            const newElement = document.createElement('div');
            newElement.id = 'table-'+id;
            newElement.innerHTML = innerHTML;
            document.body.appendChild(newElement);
        }
    }

    function ocultarMaterias(id) {
        var table = document.getElementById('table-' + id);
        if (table.style.display === 'block') {
            table.style.display = 'none';
        } else {
            table.style.display = 'block';
        }
    }
</script>
</body>
</html>