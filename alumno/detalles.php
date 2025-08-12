<?php
session_start();

$dir = "../general/";
include($dir."php/alumno.php");
include($dir."db/seccion_tareas.php");
include($dir."db/basica.php");

carga_estilo('../');

?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color:rgb(250, 250, 250);
        }
        .register-form {
            max-width: 400px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: auto;
            margin-top: 50px;
        }
        textarea {
            max-width: 100%;
            min-height: auto;
        }
    </style>
</head>
<body>
<?php
permiso();
menu('../');

$idTu = $_GET['id_tarus'];

$detalles = getTareaUs($idTu);

if($detalle = mysqli_fetch_assoc($detalles)){
    $id_alumno = $detalle['id_alumno'];
    $id_tarea = $detalle['id_tarea'];
    $descripcion_alumno = $detalle['descripcion'];
    $calificacion = $detalle['calificacion'];
    $comentario_profe = $detalle['comentario'];
    $titulo = $detalle['titulo'];
    $subtitulo = $detalle['subtitulo'];
}

echo "
    <div class='register-form position-relative'>
        <a class='btn btn-secondary position-absolute top-0 start-100 translate-middle' onclick='redireccionar()'>Volver</a>
        <h3 class='text-center'>Detalles de la tarea</h3>
        <p class='text-center text-muted'>Detalles de la tarea.</p>

        <div class='mb-3'>
            <label class='form-label'>Título</label>
            <input type='text' class='form-control' value='$titulo' disabled>
        </div>

        <div class='mb-3'>
            <label class='form-label'>Subtitulo</label>
            <input type='text' class='form-control' value='$subtitulo' disabled>
        </div>

        <div class='mb-3'>
            <label class='form-label'>Comentario del alumno:</label>
            <textarea class='form-control' placeholder='Comentario del alumno' disabled>$descripcion_alumno</textarea>
        </div>
        <div class='mb-3'>
            <label class='form-label'>Calificación</label>
            <input name='calificacion' type='number' value='$calificacion' min='0' max='10' step='.5' class='form-control' disabled placeholder='Seleccione la calificación alcanzada de 0 a 10'>
        </div>

        <div class='mb-3'>
            <label class='form-label'>Comentario del profesor:</label>
            <textarea disabled name='comentario' class='form-control' placeholder='Coloque un mensaje para su alumno.'>$comentario_profe</textarea>
        </div>
    </div>
";

?>
<script>
    function redireccionar(){
        window.history.back();
    }
</script>
</body>
</html>