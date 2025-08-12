<?php
session_start();
$dir = "../../general/";

include($dir."php/admin.php");
include($dir."db/admin.php");
include($dir."db/basica.php");

cabeza("Tareas", "", "");
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
include 'funciones.php';
usuario("../../", 'index.php');
menu_i();

$id = $_POST['id'];
$tarea = $_POST['tarea'];
$alumno = $_POST['alumno'];
$titulo = $_POST['titulo'];
$subtitulo = $_POST['subtitulo'];
$comentario = $_POST['comentario'];
$grupo = $_POST['grupo'];

$getDetails = getDetails($tarea, $id);

while($fila = mysqli_fetch_assoc($getDetails)){
    echo "
        <div class='register-form position-relative'>
            <a class='btn btn-secondary position-absolute top-0 start-100 translate-middle' href='tareasAlumno.php?id=$id&grupo=$grupo'>Volver</a>
            <h3 class='text-center'>Detalles de la tarea</h3>
            <p class='text-center text-muted'>Puedes realizar cualquier ajuste que desees.</p>

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
                <textarea class='form-control' placeholder='comentario del alumno' disabled>$comentario</textarea>
            </div>
            
            <form id='formDetalles'>
                <div class='mb-3'>
                    <label class='form-label'>Calificación</label>
                    <input name='calificacion' type='number' value='".$fila['calificacion']."' min='0' max='10' step='.5' class='form-control' placeholder='Seleccione la calificación alcanzada de 0 a 10'>
                </div>

                <div class='mb-3'>
                    <label class='form-label'>Comentario del profesor:</label>
                    <textarea name='comentario' class='form-control' placeholder='Coloque un mensaje para su alumno.'>".$fila['comentario']."</textarea>
                </div>

                <input name='id' type='hidden' value='$id'>
                <input name='tarea' type='hidden' value='$tarea'>

                <button type='button' onclick='sendForm()' class='btn btn-primary w-100'>Actualizar <i class='bi bi-arrow-clockwise'></i></button>
            </form>
        </div>
    ";

}
?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    <script>
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                console.log('La tecla Enter ha sido bloqueada.');
            }
        });

        function sendForm() {
            
            var formulario = $('#formDetalles').serialize();
            $.ajax({
                type: 'POST',
                url: 'actualizar-detalles.php',
                data: formulario,
                success: function(response) {
                    alert('Cambios guardados con éxito.');
                },
                error: function(xhr, status, error) {
                    alert('Hubo un error.')
                }
            });
            location.reload();
        }
    </script>
</body>
</html>