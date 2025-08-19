<?php
session_start();

$dir = "../../general/";
include($dir."db/examenes.php");

if (!isset($_SESSION["ad_id"]) || $_SESSION["ad_id"] == 0) {
    header('Location: iniciaSesion.php');
}

$id_profesor = $_SESSION["ad_id"];

$datos = obtener_examenes($id_profesor);
$examenes = "";
while ($fila = mysqli_fetch_assoc($datos)) {
    $materia = $fila['nombre_materia'];
    $id = $fila['id_portada'];
    $tema = $fila['contenido'];
    
    $examenes .= "
    <form id='formulario-$id' action='cambiarEstado.php' method='POST'>
        <input type='hidden' name='id' value='$id'>
    </form>
    <div class='examen'>
        <div class='options'>
            <a onclick='openModal($id);'><i class='bi bi-code-slash' style='background-color:rgb(0, 0, 0)'></i></a>
            <i onclick='changeStatus($id);'class='bi bi-trash' style='background-color: #db0c4b'></i>
        </div>
        <p class='materia'>$materia</p>
        <p class='tema'><span>Tema:</span> $tema</p>
        <a href='verExamen.php?id_portada=$id' class='btn-verExamen'>Ver Examen</a>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Exámenes</title>
    <link rel="stylesheet" href="css/estilos_examenes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div id="modal-for" class="modal">
        <div class="modal-content">
            <a onclick='closeModal()' class="close dfrc">x</a>
            <div id="content-popup"></div>
        </div>
    </div>

    <div class="contenedor">
        <div class="header">
            <hr class="red-line">
            <hr class="blue-line">
        </div>
        <div class="sesion">
            <div class="usuario">
                <div class="avatar">
                    <?php echo strtoupper($_SESSION["ad_nom"][0]) . strtoupper($_SESSION["ad_ap"][0]); ?>
                </div>
                &nbsp; Bienvenid@, <?php echo $_SESSION["ad_nom"] . ' ' . $_SESSION["ad_ap"]; ?>
            </div>
            <div class="logout">
                <a class="logout-button" href="../menu.php">Volver al inicio</a>
            </div>
        </div>

        <h1>Mis Exámenes</h1>
        <div class="nuevo-examen">
            <a href="portada.php" class="tooltip">
                +
                <span class="tooltiptext">Crear un nuevo Examen!</span>
            </a>
        </div>
        <div class="examenes">
            <?php echo $examenes; ?>
        </div>
    </div>
    <script>

        function changeStatus(id){
            document.getElementById('formulario-'+id).submit();
        }

        const modal = document.getElementById('modal-for');
        let content = document.getElementById("content-popup");

        function openModal(id) {
            content.innerHTML += `
                <h2 class='modal-title'>HMTL del examen</h2>
                <div class='separacion'></div>
                <div>
                    <p>Comparte la liga con tus alumnos, para que puedan ingresar al examen.</p>
                    <a class='referencia' href='https://udimex.net/admin/examen24/vistaAlumno.php?id=${id}'>https://udimex.net/admin/examen24/vistaAlumno.php?id=${id}</a>
                    <p>O si prefieres puedes incluir el siguiente código en tu página web.</p>
                    <textarea style='min-width:80%; min-height:60px; max-width:80%; max-height:60px;'><iframe id="examenUdimex" title="Examen Udimex" width="100%" height="600" src="https://udimex.net/admin/examen24/vistaAlumno.php?id=${id}"></iframe></textarea>
                </div>
                <div class='separacion2'></div>
            `;

            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('show'), 10);
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
