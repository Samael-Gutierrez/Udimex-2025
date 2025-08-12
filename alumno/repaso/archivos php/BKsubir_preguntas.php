<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/subir_preguntas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Formulario para Preguntas</title>
</head>
<body>
    <section>
    <div class="cubo">
        <div class="completo">
            <h1>Carga La Retroalimentacion</h1><br>
            <form action="../funciones/guarda_preguntas.php" method="post">
                <div>
                    <div class="preguntas">
                        <label for="">Pregunta:</label>
                        <textarea class="textarea" name="pregunta" type="text"></textarea>
                        <button type="submit"><i class="bi bi-telegram tamaño"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>

</body>
</html>