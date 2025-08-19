<?php
session_start();
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/examenes.php");

if (!isset($_SESSION["ad_id"]) || $_SESSION["ad_id"] == 0) {
    header('Location: iniciaSesion.php');
    exit();
}

$id_examen = $_GET['id_portada'];
$_SESSION["id_portada"] = $id_examen;
$nombre_materia = obtener_materia($id_examen);
$tiempo = obtener_tiempo($id_examen);
$preguntas = obtener_preguntas($id_examen);

function obtener_letra($indice)
{
    return chr(65 + $indice);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="css/estilos_verExamen.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../general/js/editor.js"></script>
    <title>Vista de Examen</title>
</head>
<style>
.loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.loader::after {
  content: '';
  border: 8px solid #f3f3f3;
  border-top: 8px solid #3498db;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

<body>
    <div id='loader' class='loader'></div>
    <div id="modal-for" class="modal">
        <div class="modal-content">
            <a onclick='closeModal()' class="close dfrc">x</a>
            <div id="content-popup"></div>
        </div>
    </div>

    <a href="Examenes.php" class="back-button"><span class="arrow">&larr;</span>Atrás</a>
    <div class="main-container">
        <div class="imagen">
            <img src="https://udimex.net/general/imagen/logo.png" alt="">
        </div>
        <div class="red-line"></div>
        <div class="blue-line"></div>
        <br>
        <div class="contenido">
            <h1 class="titulo-materia">Examen de <?php echo htmlspecialchars($nombre_materia); ?></h1>
            <div class="d-flex justify-content-center">
                <form action="cambiarTiempo.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiempo limite para el examen</label>
                        <input type="number" name='tiempo' value="<?php echo $tiempo; ?>" class="form-control" placeholder="Limite en minutos">
                        <input type="hidden" name='examen' value="<?php echo $id_examen; ?>">
                        <small id="emailHelp" class="form-text text-muted">Si es 0, no tiene limite para el examen.</small>
                    </div>
                    <button type="submit" class="btn btn-secondary">Cambiar</button>
                </form>
            </div>
            <div class="preguntas">
                <?php
                if ($preguntas) {
                    $numero_pregunta = 1;
                    while ($fila = mysqli_fetch_assoc($preguntas)) {
                        $idPregunta = $fila['id_pregunta'];
                        echo "
                        <div class='pregunta' id='pregunta_" . $fila['id_pregunta'] . "'>
                            <div class='imagen' id='imagen_" . $fila['id_pregunta'] . "' style='display:none;'>

                                En este apartado podras subir imagenes desde tu dispositivo.
                                <form method='POST' id='formImagen-" . $fila['id_pregunta'] . "'>
                                    <input type='file' name='archivo' accept='image/*' class='mb-1'><br>
                                    <input id='tmed' class='mb-1' type='hidden' value='40'><br>
                                    <input onclick=\"cargarImagen(" . $fila['id_pregunta'] . ");\" class='btn btn-primary' type='button' value='Cargar imagen'>
                                    <p class='btn btn-secondary' onclick=\"cancelarImagen(" . $fila['id_pregunta'] . ")\">Cancelar</p>
                                </form>
                            </div>

                            <div class='d-flex justify-content-around'>
                                <button class='imagen-button' onclick=\"mostrarImagen(" . $fila['id_pregunta'] . ")\">
                                    <i class='fas fa-image'></i>
                                </button>

                                <button class='imagen-button' onclick=\"openModal(1, " . $fila['id_pregunta'] . ")\">
                                    <i class='fas fa-solid fa-subscript'></i>
                                </button>

                                <button class='imagen-button' onclick=\"openModal(2, " . $fila['id_pregunta'] . ")\">
                                    <i class='fas fa-solid fa-percent'></i>
                                </button>
                                
                                <button class='editar-button' onclick=\"mostrarEdicion(" . $fila['id_pregunta'] . "); procesarContenido(" . $fila['id_pregunta'] . ");\">
                                    <i class='fas fa-pencil-alt'></i>
                                </button>

                                <form action='borraPregunta.php' method='POST'>
                                    <input value='$idPregunta' name='pregunta' type='hidden'>
                                    <input value='$id_examen' name='examen' type='hidden'>
                                    <button class='editar-button' type='submit'>
                                    <i class='fas fa-trash'></i>
                                    </button>
                                </form>
                            </div>

                            <strong>Pregunta $numero_pregunta:</strong>
                            <span id='texto_pregunta_" . $fila['id_pregunta'] . "'></span>

                            <div id='container-div-" . $fila['id_pregunta'] . "' class='container-div' style='max-width: 100%; overflow: auto;' contenteditable='true' rows='4' cols='50'>" . $fila['pregunta'] . "</div>
                            ";

                        echo "<div class='respuestas-container'>";
                        $respuestas = obtener_respuestas($fila['id_pregunta']);
                        if ($fila['tipo'] == 1) {
                            // Pregunta de opción múltiple
                            echo "<div class='opciones-multiples'>";
                            while ($fila2 = mysqli_fetch_assoc($respuestas)) {
                                if ($fila2['tipo'] == 1) {
                                    echo "Respuesta correcta <div class='respuesta-opcion' id='respuesta_" . $fila2['id_respuesta'] . "' style='border:solid 1px green;'>";
                                } else {
                                    echo "<div class='respuesta-opcion' id='respuesta_" . $fila2['id_respuesta'] . "' style='border:none'>";
                                }
                                echo "
                                        <label>
                                            <div style='border:none; width:100%;'>" . $fila2['respuesta'] . "</div>
                                            <button class='btn btn-primary' onclick=\"mostrarEdicionRespuesta(" . $fila2['id_respuesta'] . ")\">
                                                <i class='fas fa-pencil-alt'></i>
                                            </button>
                                        </label>
                                    </div>";

                                echo "
                                    <div class='editar-respuesta' id='editar_respuesta_" . $fila2['id_respuesta'] . "' style='display:none;'>
                                        <input type='text' class='form-control' id='editar_texto_respuesta_" . $fila2['id_respuesta'] . "' value='" . htmlspecialchars($fila2['respuesta']) . "'><br>
                                        <button type='button' class='btn btn-primary' onclick=\"actualizarRespuesta(" . $fila2['id_respuesta'] . ")\">Actualizar Respuesta</button>
                                        <button type='button' class='btn btn-secondary' onclick=\"cancelarEdicionRespuesta(" . $fila2['id_respuesta'] . ")\">Cancelar</button>
                                    </div>";
                            }
                            echo "</div>";
                        } elseif ($fila['tipo'] == 2) {
                            // Pregunta de respuesta abierta
                            echo "<textarea name='pregunta_$numero_pregunta' rows='6'></textarea>";
                        } elseif ($fila['tipo'] == 3) {
                            // Pregunta de verdadero/falso
                            echo "<div class='verdadero-falso'>";
                            echo "<label><input type='radio' name='pregunta_$numero_pregunta' value='verdadero'> Verdadero</label><br>";
                            echo "<label><input type='radio' name='pregunta_$numero_pregunta' value='falso'> Falso</label>";
                            echo "</div>";
                        } elseif ($fila['tipo'] == 4) {
                            // Pregunta de relación de columnas
                            $numeros = obtener_numeros($fila['id_pregunta']);
                            $incisos = obtener_incisos($fila['id_pregunta']);

                            echo "<div class='relacion-columnas'>";

                            // Contenedor de números (izquierda)
                            echo "<div class='columna-numeros'>";
                            $indice_numero = 1;
                            while ($numero = mysqli_fetch_assoc($numeros)) {
                                echo "<p class='numero'>" . htmlspecialchars($numero['numero']) . "</p>";
                                $indice_numero++;
                            }
                            echo "</div>";

                            // Contenedor de incisos (derecha)
                            echo "<div class='columna-incisos'>";
                            $indice_inciso = 0;
                            while ($inciso = mysqli_fetch_assoc($incisos)) {
                                $letra = obtener_letra($indice_inciso);
                                echo "<p class='inciso'>" . htmlspecialchars($inciso['inciso']) . "</p>";
                                $indice_inciso++;
                            }
                            echo "</div>";

                            echo "</div>";
                        }

                        echo "</div>";

                        echo "<div class='editar' id='editar_" . $fila['id_pregunta'] . "' style='display:none;'>
                            <input type='hidden' class='form-control' id='editar_textarea_" . $fila['id_pregunta'] . "'></input>
                            <br>
                            <button type='button' class='btn btn-primary' onclick=\"actualizarPregunta(" . $fila['id_pregunta'] . ")\">Actualizar Pregunta</button>
                            <button type='button' class='btn btn-secondary' onclick=\"cancelarEdicion(" . $fila['id_pregunta'] . ")\">Cancelar</button>
                        </div>";

                        echo "</div>";
                        $numero_pregunta++;
                    }
                }
                ?>
                <div class="agregar-pregunta-container">
                    <a href="preguntas.php?id_portada=<?php echo $id_examen; ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Agregar Otra Pregunta
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script>

    <script>
        // ________________ Inicio Modales ________________
        const modal = document.getElementById('modal-for');
        let content = document.getElementById("content-popup");

        function openModal(tipo, id) {
            if (tipo == 1) {
                content.innerHTML += `
                    <h2 class='modal-title'>Añadir Raíz Cuadrada</h2>
                    <div class='separacion'></div>
                    <label for="numero">Ingresa un número:</label>
                    <input type="number" id="numero${id}" step="any">
                    <button onclick="dibujarRaizComoImagen(${id})" class='modal-btn'>Generar</button>

                    <canvas id="miCanvas${id}" style='display:none;'></canvas>
                `;
            }

            if (tipo == 2) {
                content.innerHTML += `
                    <h2 class='modal-title'>añadir Fracciones</h2>
                    <div class='separacion'></div>
                    <div class='dfrc'>
                        <label for="numerador">Num: </label>
                        <input type="number" id="numerador${id}" step="any" class='ml-10'>
                    </div>
                    <div class='separacion2'></div>
                    <div class='dfrc'>
                        <label for="denominador">Deno: </label>
                        <input type="number" id="denominador${id}" step="any" class='ml-10'>
                    </div>
                    <button onclick="dibujarFraccionComoImagen(${id})" class='modal-btn'>Generar</button>

                    <canvas id="miCanvas${id}" width="300" height="150" style='display:none;'></canvas>
                `;
            }

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
                hiddeImage();
            }, 1000);
        }

        function vaciar() {
            content.innerHTML = "";
        }

        window.onclick = function(event) {
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
        // ________________ Fin modales ________________

        // ----------------------- Formulas  -----------------------
        function dibujarRaizComoImagen(id) {
            const numero = document.getElementById('numero'+id).value;
            const canvas = document.getElementById('miCanvas'+id);
            const contenedor = document.getElementById('container-div-'+id);
            showLoader();

            const ctx = canvas.getContext('2d');
            ctx.font = "30px Arial";

            if (numero === "" || isNaN(numero)) {
                alert("Por favor, ingresa un número válido.");
                return;
            }

            const valor = parseFloat(numero);

            if (valor < 0) {
                alert("No se puede calcular la raíz cuadrada de un número negativo.");
                return;
            }

            const raiz = Math.sqrt(valor).toFixed(4);
            const numeroTexto = numero.toString();
            const numeroAncho = ctx.measureText(numeroTexto).width;

            const padding = 30;
            const totalAncho = 40 + numeroAncho + padding;
            const totalAlto = 58;

            canvas.width = totalAncho;
            canvas.height = totalAlto;

            const nuevoCtx = canvas.getContext('2d');
            nuevoCtx.font = "30px Arial";

            const startX = 10;
            const startY = 35;
            const textYOffset = 10;

            nuevoCtx.beginPath();
            nuevoCtx.moveTo(startX, startY);
            nuevoCtx.lineTo(startX + 10, startY + 20);
            nuevoCtx.lineTo(startX + 20, startY - 20);
            nuevoCtx.lineTo(startX + 40, startY - 20);
            nuevoCtx.lineTo(startX + 50 + numeroAncho, startY - 20);
            nuevoCtx.strokeStyle = "black";
            nuevoCtx.lineWidth = 3;
            nuevoCtx.stroke();

            nuevoCtx.fillStyle = "blue";
            nuevoCtx.fillText(numeroTexto, startX + 50, startY + textYOffset);

            const imagenBase64 = canvas.toDataURL("image/png");
            const imagenHTML = `<img src="${imagenBase64}" style="vertical-align: middle; width:80px;">`;

            contenedor.insertAdjacentHTML('beforeend', imagenHTML);
            closeModal();
            hiddeLoader();
        }

        function dibujarFraccionComoImagen(id) {
            const numerador = document.getElementById('numerador'+id).value;
            const denominador = document.getElementById('denominador'+id).value;
            const canvas = document.getElementById('miCanvas'+id);
            const contenedor = document.getElementById('container-div-'+id);
            showLoader();

            if (numerador === "" || denominador === "" || isNaN(numerador) || isNaN(denominador)) {
                alert("Por favor, ingresa números válidos.");
                return;
            }

            if (parseFloat(denominador) === 0) {
                alert("El denominador no puede ser cero.");
                return;
            }

            const ctx = canvas.getContext('2d');
            ctx.font = "30px Arial";

            const numText = numerador.toString();
            const denText = denominador.toString();

            const maxWidth = Math.max(ctx.measureText(numText).width, ctx.measureText(denText).width);
            const padding = 20;
            const totalAncho = maxWidth + padding * 2;
            const totalAlto = 90;

            canvas.width = totalAncho;
            canvas.height = totalAlto;

            const nuevoCtx = canvas.getContext('2d');
            nuevoCtx.font = "30px Arial";
            nuevoCtx.textAlign = "center";
            nuevoCtx.fillStyle = "black";

            const centerX = totalAncho / 2;
            const centerY = totalAlto / 2;

            nuevoCtx.fillText(numText, centerX, centerY - 20);
            nuevoCtx.beginPath();
            nuevoCtx.moveTo(centerX - maxWidth / 2, centerY);
            nuevoCtx.lineTo(centerX + maxWidth / 2, centerY);
            nuevoCtx.lineWidth = 2;
            nuevoCtx.strokeStyle = "blue";
            nuevoCtx.stroke();

            nuevoCtx.fillText(denText, centerX, centerY + 40);

            const imagenBase64 = canvas.toDataURL("image/png");
            const imagenHTML = `<img src="${imagenBase64}" alt="${numerador}/${denominador}" style="vertical-align: middle; width:80px;">`;

            contenedor.insertAdjacentHTML('beforeend', imagenHTML);
            hiddeLoader();
            closeModal();
        }

        // ________________ Fin formulas ________________

        function cargarImagen(id) {
            document.getElementById("container-div-" + id).focus();

            var form = $('#formImagen-' + id)[0];
            var data = new FormData(form);
            data.append("control", "correcto");
            showLoader();
            $.ajax({
                url: 'carga-imagen.php',
                type: 'POST',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function(data) {
                    ima = data;
                    media(ima, id);
                    form.reset();
                    hiddeLoader();
                },
                error: function() {
                    alert("No se pudo cargar el archivo, intenta de nuevo");
                }
            });
        }

        function media(datos, id) {
            cadena = datos.split("@:@");
            tam = document.getElementById("tmed").value;
            codim = "<img src='" + cadena[1] + "' width='" + tam + "%'>";
            document.getElementById('container-div-' + id).innerHTML = document.getElementById('container-div-' + id).innerHTML + codim;
        }

        function procesarContenido(id) {
            const divEditable = document.getElementById('container-div-' + id);
            const inputOculto = document.getElementById('editar_textarea_' + id);
            inputOculto.value = divEditable.innerHTML;
        }

        // divEditable.addEventListener('blur', guardarEnInput);

        function mostrarImagen(id) {
            document.getElementById('imagen_' + id).style.display = 'block';
        }

        function cancelarImagen(id) {
            document.getElementById('imagen_' + id).style.display = 'none';
        }

        function mostrarEdicion(id_pregunta) {
            document.getElementById('editar_' + id_pregunta).style.display = 'block';
        }

        function cancelarEdicion(id_pregunta) {
            document.getElementById('editar_' + id_pregunta).style.display = 'none';
        }

        function actualizarPregunta(id_pregunta) {
            var pregunta = document.getElementById('editar_textarea_' + id_pregunta).value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'actualizarPreguntas.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('texto_pregunta_' + id_pregunta).textContent = pregunta;
                    cancelarEdicion(id_pregunta);
                }
            };

            xhr.send('id_pregunta=' + id_pregunta + '&pregunta=' + encodeURIComponent(pregunta));
            alert('Pregunta actualizada correctamente');
            location.reload();
        }



        function mostrarEdicionRespuesta(id_respuesta) {
            document.getElementById('editar_respuesta_' + id_respuesta).style.display = 'block';
            document.getElementById('respuesta_' + id_respuesta).style.display = 'none';
        }

        function cancelarEdicionRespuesta(id_respuesta) {
            document.getElementById('editar_respuesta_' + id_respuesta).style.display = 'none';
            document.getElementById('respuesta_' + id_respuesta).style.display = 'block';
        }

        function actualizarRespuesta(id_respuesta) {
            var respuesta = document.getElementById('editar_texto_respuesta_' + id_respuesta).value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'actualizarRespuesta.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('texto_respuesta_' + id_respuesta).textContent = respuesta;
                    cancelarEdicionRespuesta(id_respuesta);
                }
            };

            xhr.send('id_respuesta=' + id_respuesta + '&respuesta=' + encodeURIComponent(respuesta));
            location.reload();
        }

        function mostrarAlerta() {
            alert('De momento nos encontramos trabajando en añadir imagenes desde tu dispositivo, por medio de copiar, pegar y por capturas si funciona, le invitamos a leer el manual para que de momento pueda editar las imagenes de las preguntas por esos medios, muchas gracias.')
        }

        function showLoader(){
            document.getElementById('loader').style.display = 'flex';
            hiddeLoader('Todo listo');
        }

        function hiddeLoader(){
            setTimeout(function() {
                document.getElementById('loader').style.display = 'none';
            }, 500);
        }
    </script>
</body>

</html>