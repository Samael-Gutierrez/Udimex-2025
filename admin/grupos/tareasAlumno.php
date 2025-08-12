<?php
session_start();

$dir = "../../general/";

include($dir."php/admin.php");
include($dir."db/admin.php");
include($dir."db/basica.php");
include($dir."db/seccion_tareas.php");

$al = $_SESSION["ad_id"];

cabeza("Tareas", "<link rel='stylesheet' href='styleTareas.css'>", "");
?>
    <!-- Links de referencias, AJAX, BOOTSTRAP Y BOOTSTRAP ICONS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<!-- Cuerpo y contenido del modal -->
<div id="modal-for" class="modal">
    <div class="modal-content">
        <div id="content-popup"></div>
    </div>
</div>

<?php
// Menú superior
usuario("../../", 'index.php');
// NavBar
menu_i();

// Variables de sesión
if($_GET['id']){
    $id = $_GET['id'];
    $grupo = $_GET['grupo'];
}else{
    echo "<script>window.history.back();</script>";
}

// Obtiene el nombre completo del alumno
$nombres = busca_usuario($id);
while($nombre = mysqli_fetch_assoc($nombres)){
    $fullName = $nombre['ap_pat'] . " " . $nombre['ap_mat'] . " " . $nombre['nombre'];
}

// Varibles Universales
$promedio = 0;
$ct = 0;
$counter = 0;

// Cuenta las tareas registradas del alumno y las guarda en $counter
$totales = counterHomeWorks($id);
while($fila = mysqli_fetch_assoc($totales)){
    $counter = $fila['tareas']; 
}

// Compara si tiene tareas, si tiene menos de una, arroja mensaje de 'Sin tareas', si es tiene minimo una, arroja mensaje de tareas del alumno
if($counter<1){
    echo "<h2 class='title'>$fullName no tiene tareas registradas.</h2>";
}else{
    echo "<h2 class='title'>Tareas de $fullName</h2>";
}

// Muestra el boton para ver los examenes
echo "<a onclick='examenes()' class='btn-examen'>Exámenes</a>";

// Obtiene el total de las materias activas
$totalMaterias = obtenTotalMaterias($grupo);
while($fila = mysqli_fetch_assoc($totalMaterias)){
    $totalM = $fila['materias'];
}

// Inicio del contenedor
echo "<div class='main-container' id='main-container'>";

// Obtiene el nombre y el id de las materias por el grupo
$materias = obtenMateriasActivas($grupo, $id);

// Verifica si tiene hay materias activas
if($totalM > 0){
    while($fila = mysqli_fetch_assoc($materias)){
        // Imprime las tarejetas de las tareas
        echo "
            <div class='cards' onclick='ocultarMaterias(".$fila['id_materia'].");'>
                <p>" . $fila['nombre'] . "</p>
            </div>
        ";
    }
    
    // Cierra el DIV del contenedor principal
    echo "</div>";

    // Vuelve a obtener las materias activas
    $materias2 = obtenMateriasActivas($grupo, $id);
    while($fila1 = mysqli_fetch_assoc($materias2)){
        // Iniciar el contador de materias
        $counterTareas = 1;
        // Imprime el header de la tabla que contendra cada materia
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
                        <th>Opciones</th>
                        <th></th>
                    </tr>
        ";

        // Obtiene las tareas por materia
        $tareas = getHomeWorksByMateria($fila1['id_materia'], $id);
        while($tarea = mysqli_fetch_assoc($tareas)){
            // Variables importantes
            $idTu = $tarea['id']; // id_tarus
            $idTarea = $tarea['tarea']; // id_tarea
            $visto = $tarea['visto']; // Visto: Si el profesor ya abrio la tarea

            // Obtiene la fecha limite de cada tarea
            $fecha_final = obtenerFechaLimite($idTarea, $id);
            while($final = mysqli_fetch_assoc($fecha_final)){
                // La fecha final se almacena en una variable
                $ffs = $final['fecha_limite'];
                // Se le da formato de fecha
                $ff = new DateTime($ffs);
            }

            // Verifica que extension tiene el archivo
            $cutter = explode('.', $tarea['archivo']);

            // Por defecto, el archivo abre en otra pestaña
            $download = "target='_blank'";

            // Con la extensión, checa si es una que se pueda abrir desde el navegador (Imagenes, pdf, videos)
            $extension = $cutter[1];
            switch ($extension){
                case "png":
                    break;
            
                case "jpg":
                    break;
            
                case "pdf":
                    break;
            
                case "jpeg":
                    break;
                
                default:
                    // Si es de extension que no se abra desde navegador, entonces lo descarga
                    $download = "download='".$tarea['archivo']."'";
                    break;
            }

            // Operador ternario, si la tarea tiene estado 1, entonces muestra en verde revisado, sino, en rojo
            $estado = ($tarea['estado'] == 1)  ? "<p style='color:green'>Revisado</p>" : "<p style='color:red'>No revisado</p>";
            
            if($tarea['estado'] == 0){
                $hoy = date('Y-m-d');
                $hoy = new DateTime($hoy);

                // Operador ternario, si hoy es menor que la fecha limite sale en verde, sino en red
                $entrega = ($hoy <= $ff) ? "<p style='color:green'>$ffs</p>" : "<p style='color:red'>$ffs</p>";

                // Asigna boton para calificar
                $calificar = "
                    <button id='modal-$counterTareas' onclick='openModal($idTarea, $id, $idTu, $al, $counterTareas)' type='button' class='btn btn-primary'>
                        Calificar
                    </button>
                ";

                // Iniciar la variable de detalles y calificacion
                $detalles = "";
                $calificacion = 0;

            }else{
                // Obtiene la fecha de entrega del alumno
                $fecha_entrega  = fechaEntrega($idTarea, $id);
                while($fechas = mysqli_fetch_assoc($fecha_entrega)){
                    // Guarda la fecha
                    $fes = $fechas['fecha_entrega'];
                    // Le da formato de fecha
                    $fe = new DateTime($fes);
                    // Guarda la calificación ya registrada
                    $calificacion = $fechas['calificacion'];
                }

                // Operador ternario para ver si la entrega fue a tiempo o tardio
                $entrega = ($fes <= $ffs) ? "<p style='color:green;'>A Tiempo</p>" : "<p style='color:red;'>Tardía</p>";

                // Asigna la variable con icono de revisado
                $calificar = "<i class='bi bi-check-circle-fill' style='color:green'></i>";

                // Boton para ver detalles de la tarea
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

            // Operador ternario, si aun no se abre el documento sale rojo, si si, sale verde
            $vistos = ($visto == 0) 
            ? "<i class='bi bi-flag' style='color:red' id='visto-$idTu'><a onclick='changeState($idTu);' $download href='../../alumno/tarea-alumno/".$tarea['archivo']."'>".$tarea['archivo']."</a>"
            : "<i class='bi bi-flag-fill' style='color:green'><a $download href='../../alumno/tarea-alumno/".$tarea['archivo']."'>".$tarea['archivo']."</a>";
            
            // Imprime las colimnas con la información de las tareas, visto, detalles, calificacion, esatdo y calificar
            echo"
                <tr>
                    <td>$counterTareas</td>
                    <td>$vistos</td>
                    <td>".$tarea['titulo']."</td>
                    <td>".$tarea['subtitulo']."</td>
                    <td id='calificacion-$counterTareas'>$calificacion</td>
                    <td id='ent-$counterTareas'>$entrega</td>
                    <td id='estado-$counterTareas'>$estado</td>
                    <td id='opciones-$counterTareas'>$calificar</td>
                    <td>$detalles</td> 
                </tr>
            ";

            // Cuenta las tareas totales
            $counterTareas ++;
            // Va sumando el total de las tareas
            $promedio = $promedio + $calificacion;
            // Segundo contador de tareas
            $ct ++;
        }

        // Imprime el cierre del tbody y tabla
        echo "</tbody>
            </table>
        ";

        // Comprueba si no hay tareas
        if($ct>0){
            // Divide la suma para obtener el promedio
            $pf = $promedio / $ct;
            // Le da formato al número para un solo decimal
            $pff = number_format($pf, 1);

            // Operador ternario, imprime el con color distinto dependiendo del promedio
            echo "<p style='color:" . ($pf > 6 ? "green" : "red") . "'>Promedio = $pff</p>";
        }
        // Imprime el final del div
        echo "</div>";
    }
}else{
    // Imprime el mensaje sin materias
    echo "Sin materias activas";
}
?>
<hr>

<!-- Vista y calificacion de los examenes -->
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
                <th>Salidas</th>
            </tr>
            <?php
                // Iniciar el contador pero de los examenes registrados
                $count2 = 1;
                // Cuenta lso exames que tengan registrados
                $examenes = totalExamenes($id);
                while($exa = mysqli_fetch_assoc($examenes)){
                    $contador = $exa['cal'];
                }

                if ($contador < 1) echo "<tr><td colspan='6'><center>Sin calificaciones registradas</center></td></tr>";

                $calificaciones = getRatingsById($id);
                $prom2 = 0;
                while($cal = mysqli_fetch_assoc($calificaciones)){
                    $valor = $cal['valor'];
                    if($valor < 6) {
                        $cali = "<p style='color:red'>$valor</p>";
                    }else{
                        $cali = "<p style='color:green'>$valor</p>";
                    }
                    $mat = $cal['id_materia'];
                    $focus = totalFocus($id, $mat);
                    while($focu = mysqli_fetch_assoc($focus)){
                        $totale = $focu['totales'];
                    }
                    echo "
                        <tr>
                            <td>$count2</td>
                            <td>".$cal['fecha_registro']."</td>
                            <td>".$cal['nombre_materia']."</td>
                            <td>".$cal['contenido']."</td>
                            <td>$cali</td>
                            <td>$totale</td>
                        </tr>
                    ";
                    $count2 ++;
                    $prom2 = $prom2 + $valor;
                }
                echo "
        </tbody>
    </table>";
                if($count2>0){
                    $count2 --;
                    $prom2 = $prom2 / $count2;
                    $prom2f = number_format($prom2, 1);
                    if($prom2 > 6){
                        echo "<p style='color:green'>Promedio = $prom2f</p>";
                    }else{
                        echo "<p style='color:red'>Promedio = $prom2f</p>";
                    }
                }
            ?>
    <hr>
</div>
<script>
    function examenes() {
        const examenes = document.getElementById('examenes');
        examenes.style.display='block';
        examenes.scrollIntoView({behavior: 'smooth'});  
    }

    function examenesOff() {
        document.getElementById('main-container').scrollIntoView({behavior: 'smooth'});
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
            nuevoTd.setAttribute('colspan', '8');
            nuevoTd.textContent = 'Sin tareas registradas en esta materia.';
            nuevoTr.appendChild(nuevoTd);
            tbody.appendChild(nuevoTr);
        }
    });

    function mensaje(tipo, id){
        let comentario = document.getElementById('comentario-'+id);
        let cal = document.getElementById('cal-'+id);
        let mensaje = '';
        let calificacion = 0;

        if(tipo == 1){
            mensaje = 'Excelente trabajo ';
            calificacion = 10;
        }
        if(tipo == 2){
            mensaje = 'Buen trabajo ';
            calificacion = 9;
        }
        if(tipo == 3){
            mensaje = 'Regular ';
            calificacion = 8;
        }
        if(tipo == 4){
            mensaje = 'Faltan detalles : ';
            calificacion = 7;
        }

        cal.value = '';
        cal.value = calificacion;

        comentario.value = '';
        comentario.value = mensaje;

        comentario.focus();
    }

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

    function sendForm(tarea, ct) {
        var formulario = $('#form-'+tarea).serialize();
        $.ajax({
            type: 'POST',
            url: 'calificar-tarea.php',
            data: formulario,
            success: function(response) {
                alert('Calificación guardada con éxito.');
                calificar(tarea, ct);
                closeModal();
            },
            error: function(xhr, status, error) {
                console.error('Error al enviar los datos: ', error);
            }
        });
    }

    function changeState(id) {
        const visto = document.getElementById('visto-'+id);
        $.ajax({
            url: 'asignarVisto.php',
            type: 'POST',
            data: { miDato: id },
            success: function(respuesta) {
                console.log('Respuesta del servidor:', respuesta);
                visto.style.color = 'green';
                visto.classList.remove('bi-flag');
                visto.classList.add('bi-flag-fill');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    // Modal
    const modal = document.getElementById('modal-for');
    let content = document.getElementById("content-popup");

    function openModal(idTarea, alumno, idTarus, al, ct) {
        content.innerHTML += `
            <h3 class="modal-title">Califica esta tarea</h3>
            <form id='form-${idTarea}'>
                <input name='calificacion' id='cal-${idTarea}' class='form-control text-center' type='number' placeholder='Asigna la calificación alcanzada.' min="0" max="10" step='.5' value='10'>
                <input name='tarea' type='hidden' value='${idTarea}'>
                <input name='alumno' type='hidden' value='${alumno}'>
                <input name='tarus' type='hidden' value='${idTarus}'>
                <input name='profe' type='hidden' value='${al}'>
                <input name='comentario' id='comentario-${idTarea}' class='form-control text-center' type='text' placeholder='Puedes añadir un comentario, Ej: "Buen trabajo"' autocomplete='off'>
            </form>
            <div class="footer-modal">
                <div class='part-1'>
                    <button type="button" class="btn btn-secondary" onclick='mensaje(1,${idTarea});'>Perfecto</button>
                    <button type="button" class="btn btn-secondary" onclick='mensaje(2,${idTarea});'>Bueno</button>
                    <button type="button" class="btn btn-secondary" onclick='mensaje(3,${idTarea});'>Regular</button>
                    <button type="button" class="btn btn-secondary" onclick='mensaje(4,${idTarea});'>Malo</button>
                </div>
                <div class='part-1'>
                    <button type="button" class="btn btn-primary" onclick='sendForm(${idTarea}, ${ct})'>Guardar</button>
                    <button type="button" class="btn btn-danger" onclick='closeModal()'>Cerrar</button>
                </div>
            </div>
        `;

        modal.style.display = 'block';
        setTimeout(() => modal.classList.add('show'), 10);
    }

    function calificar(tarea, ct){
        const calificacion = document.getElementById('cal-'+tarea);
        document.getElementById('calificacion-'+ct).textContent = calificacion.value;
        document.getElementById('estado-'+ct).innerHTML = `<p style='color:green'>Revisado</p>`;
        document.getElementById('modal-'+ct).disabled = true;
    }


    function closeModal() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);

        setTimeout(() => {
            vaciar();
        }, 1000);
        document.getElementById("container-div").focus();
    }

    function vaciar() {
        content.innerHTML = "";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
            setTimeout(() => {
                vaciar();
            }, 100);
        }
    }
</script>
</body>
</html>