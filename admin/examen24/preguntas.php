
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Preguntas</title>
    <link rel="stylesheet" href="css/estilos_preguntas.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="../../general/js/editor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script>
</head>
<body>
<?php 
echo "
    <input type='hidden' value='".$_GET['id_portada']."' id='idPortada'>
";
?>
<div class="main-container">
    <div class="horizontal-lines">
        <hr class="red-line">
        <hr class="blue-line">
    </div><br> 
    <h2 class="subtitulo">Crea tu Examen!</h2>
    <p onclick='openModal(3,0)' class="openModal"><i class="bi bi-images"></i></p>
    <p onclick="openModal(1,0)" class='openModal'>√</p>
    <p onclick="openModal(2,0)" class='openModal'>/</p>
    <p onclick="openModal(4, 0)" class='openModal'>^</p>

    <div id="modal-for" class="modal">
        <div class="modal-content">
            <a onclick='closeModal()' class="close dfrc">x</a>
            <div id="content-popup"></div>
            <div id='div-image' style='display:none;'>
                <h2 class='modal-title'>Insercción de imagenes</h2>
                <p class='descripcion'>En este aparatado puedes añadir fotos desde tu equipo o copiandolas de internet directamente en el recuadro de la pregunta.</p>
                <div class='separacion'></div>
                <form method='POST' id='cargarImagen' name='cargarImagen' class='dfcc'>
                    <input type='file' name='archivo' accept="image/*">
                    <input type='hidden' value='70' id='tmed'>
                    <input type='button' class='modal-btn' name='subir' id='subir' value='Cargar'>
                </form>
            </div>
        </div>
    </div>


    <form id="formulario-preguntas" method="post" enctype="multipart/form-data">
        <div class="cuadro">
            <h2>Pregunta</h2>
            <input id='escrip_p' type="hidden" name="escri_p" rows="4" cols="50"></input>
            <input type="hidden" name="id_portada" value=' <?php echo $_GET['id_portada'];?> '></input>
            <div class="container-div" id="editor-0" contenteditable="true" rows="4" cols="50"></div>
        </div>
        <input type="hidden" name="tipo" value="1"> <!-- <strong> Opción Múltiple &nbsp; &nbsp; </strong> -->
        <!-- <input type="radio" name="tipo" id="abiertas" value="2" style='display:none;'> <strong style='display:none;'> Abierta &nbsp; &nbsp; </strong> 
        <input type="radio" name="tipo" id="Falso o Verdadero" value="3" style='display:none;'> <strong style='display:none;'> Falso y Verdadero &nbsp; &nbsp; </strong>
        <input type="radio" name="tipo" id="Columnas" value="4" style='display:none;'> <strong style='display:none;'> Relación de columnas &nbsp; &nbsp; </strong> -->

        <div id="vista-om">
            <div class="containers">
                <br>
                <h2>Opciones</h2>
                <div id="closed-options" class="options">
                    <p onclick="openModal(4, 1)" class='openModal'>^</p>
                    <div class="">
                        <div id="editor-1" contenteditable="true" class='option'></div>
                        <input type="hidden" name="option1" id='op-1'>  
                        <input type="hidden" name="value1" value="1">
                    </div>
                    <p onclick="openModal(4, 2)" class='openModal'>^</p>
                    <div class="">
                        <div id="editor-2" contenteditable="true" class='option'></div>
                        <input type="hidden" name="option2" id='op-2'>
                        <input type="hidden" name="value2" value="0">
                    </div>
                    <p onclick="openModal(4, 3)" class='openModal'>^</p>
                    <div class="">
                        <div id="editor-3" contenteditable="true" class='option'></div>
                        <input type="hidden" name="option3" id='op-3'>
                        <input type="hidden" name="value3" value="0">
                    </div>
                    <p onclick="openModal(4, 4)" class='openModal'>^</p>
                    <div class="">
                        <div id="editor-4" contenteditable="true" class='option'></div>
                        <input type="hidden" name="option4" id='op-4'>
                        <input type="hidden" name="value4" value="0">
                    </div>
                </div>
            </div>
        </div>

        <div id="vista-abierta" style="display: none;"></div>

        <!-- <div id="vista-vf" style="display: none;">
            <div id="true-false-options" class="options"> <br> <br>
                <h2>Selecciona la respuesta:</h2>
                <div class="option">
                    <input type="radio" id="true" name="op" value="True" checked> Verdadero
                </div>
                <div class="option">
                    <input type="radio" id="false" name="op" value="False"> Falso
                </div>
            </div>
        </div> -->

        <!-- <div id="vista-columna" style="display: none;">
            <br><br>
            <div class="RC">
            </div>
            
            <div class="contenedor">
                <div class="contenedor1">
                    <h2>Preguntas</h2> <br>
                    <div id="preguntas-container" class="text">
                        <textarea name="pregunta[]" rows="4" cols="10" placeholder="Escribe tus preguntas"></textarea>
                    </div>
                </div>
                <div class="contenedor1">
                    <h2>Incisos</h2> <br>
                    <div id="opciones-container" class="text">
                        <textarea name="opcion[]" rows="4" cols="50" placeholder="Escribe tus incisos"></textarea>
                    </div>
                </div>
            </div>
            <div id="add-remove-btn-container">
                <button type="button" class="add-btn" onclick="agregar_textArea()">+</button>
            </div>
        </div> -->
        <a class="boton" id='btn-hidden' onclick="mostrar()">Confirmar</a>
        <div id="submit-reset-container" style='display:none;'>
            <div id="submit-btn-container"> 
                <button type="button" class="boton" onclick="guardarPregunta()">Enviar</button>
            </div>
            <div id="reset-btn-container"> 
                <button type="button" class="boton" data-toggle="modal" data-target="#confirmModal">Finalizar Examen</button>
            </div>
        </div>

        <input type="hidden" name="accion" id="accion" value="guardar">
    </form>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás segur@ que quieres finalizar el examen?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="boton-finalizar" id="confirmFinish">Finalizar</button>
            </div>
        </div>
    </div>
</div>
<script>
    // -----------------------Guardado de div a input oculto-----------------------
const divEditable = document.getElementById('editor-0');
const inputOculto = document.getElementById('escrip_p');

function mostrar(){
    const btn = document.getElementById('btn-hidden');
    const dis = document.getElementById('submit-reset-container');

    btn.style.display = 'none';
    dis.style.display = 'block';
}

function guardarEnInput() {
    inputOculto.value = divEditable.innerHTML;
}

divEditable.addEventListener('blur', guardarEnInput);



// -----------------------JS de Preguntas-----------------------
function muestra(tp) {
    document.getElementById("vista-om").style.display = "block" ;
}

function oculta() {
    document.getElementById("vista-om").style.display = "block";
}

function agregar_textArea() {
    var preguntasContainer = document.getElementById("preguntas-container");
    var opcionesContainer = document.getElementById("opciones-container");

    var newPregunta = document.createElement("textarea");
    newPregunta.name = "pregunta[]";
    newPregunta.rows = 4;
    newPregunta.cols = 10;
    newPregunta.placeholder = "Escribe tus preguntas";

    var newOpcion = document.createElement("textarea");
    newOpcion.name = "opcion[]";
    newOpcion.rows = 4;
    newOpcion.cols = 50;
    newOpcion.placeholder = "Escribe tus incisos";

    preguntasContainer.appendChild(newPregunta);
    opcionesContainer.appendChild(newOpcion);

    mostrarBotonQuitar();
}

function mostrarBotonQuitar() {
    var preguntasContainer = document.getElementById("preguntas-container");
    var opcionesContainer = document.getElementById("opciones-container");
    var removeBtn = document.querySelector('.remove-btn');

    if (preguntasContainer.childElementCount > 1 && opcionesContainer.childElementCount > 1) {
        removeBtn.style.display = 'inline-block';
    } else {
        removeBtn.style.display = 'none';
    }
}

function guardarPregunta() {
    var formData = new FormData(document.getElementById('formulario-preguntas'));
    var formDiv = document.getElementById('editor-0');
    var formCarga = document.getElementById('cargarImagen');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardaPreguntas.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Pregunta guardada exitosamente.');
            document.getElementById('formulario-preguntas').reset();
            muestra(1); 
        } else {
            alert('Error al guardar la pregunta.');
        }
    };
    xhr.send(formData);
    formDiv.innerHTML='';
    formCarga.reset();

    document.getElementById('editor-1').innerHTML='';
    document.getElementById('editor-2').innerHTML='';
    document.getElementById('editor-3').innerHTML='';
    document.getElementById('editor-4').innerHTML='';
}

const idPortada = document.getElementById("idPortada").value;

document.getElementById('confirmFinish').addEventListener('click', function() {
    document.getElementById('accion').value = 'finalizar';
    document.getElementById('formulario-preguntas').action = `crearLiga.php?id_portada=${idPortada}`;
    document.getElementById('formulario-preguntas').submit(); 
});

document.addEventListener('DOMContentLoaded', function() {
    mostrarBotonQuitar();
});

// -----------------------JS de cargar imagen a DIV-----------------------
$('#subir').click(function() {  
    document.getElementById("editor-0").focus();

    var form = $('#cargarImagen')[0];
    var data = new FormData(form);
    data.append("control", "correcto");
    $.ajax({
        url: 'carga-imagen.php',
        type: 'POST',
        enctype: 'multipart/form-data',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        success: function (data) {
            ima=data;
            media(ima);
            alert('imagen cargada');
            form.reset();
            closeModal();
            },
        error: function(){
                alert( "No se pudo cargar el archivo, intenta de nuevo");
            }
    });
});

function media(datos){
    cadena=datos.split("@:@");
    tam=document.getElementById("tmed").value;
    imagen(cadena[1],tam);
}

function showImage(){
    document.getElementById('div-image').style.display='block';
}

function hiddeImage(){
    document.getElementById('div-image').style.display='none';
}

// ----------------------- Modales -----------------------

const modal = document.getElementById('modal-for');
let content = document.getElementById("content-popup");

function openModal(tipo, id){
    if(tipo == 1){
        content.innerHTML += `
            <h2 class='modal-title'>Añadir Raíz Cuadrada</h2>
            <div class='separacion'></div>
            <label for="numero">Ingresa un número:</label>
            <input type="number" id="numero" step="any">
            <button onclick="dibujarRaizComoImagen()" class='modal-btn'>Generar</button>

            <canvas id="miCanvas" style='display:none;'></canvas>
        `;
    }

    if(tipo == 2){
        content.innerHTML += `
            <h2 class='modal-title'>añadir Fracciones</h2>
            <div class='separacion'></div>
            <div class='dfrc'>
                <label for="numerador">Num: </label>
                <input type="number" id="numerador" step="any" class='ml-10'>
            </div>
            <div class='separacion2'></div>
            <div class='dfrc'>
                <label for="denominador">Deno: </label>
                <input type="number" id="denominador" step="any" class='ml-10'>
            </div>
            <button onclick="dibujarFraccionComoImagen()" class='modal-btn'>Generar</button>

            <canvas id="miCanvas" width="300" height="150" style='display:none;'></canvas>

        `;
    }

    if(tipo == 3){
        showImage();
    }

    if(tipo == 4){
        content.innerHTML += `
            <h2 class='modal-title'>Añadir Exponentes</h2>
            <div class='separacion'></div>
            <div class='dfrc'>
                <label for="numer">Num: </label>
                <input type="text" id="numer-${id}" step="any" class='ml-10'>
                <label for="exponente">Expo: </label>
                <input type="text" id="exponente-${id}" step="any" class='ml-10'>
            </div>
            <button onclick="dibujarPotencia(${id})" class='modal-btn'>Generar</button>

            <canvas id="canvas-${id}" style="display:none;"></canvas>

        `;
    }
    
    modal.style.display = 'block';
    setTimeout(() => modal.classList.add('show'), 10);
}

const editor1 = document.getElementById('editor-1');
const editor2 = document.getElementById('editor-2');
const editor3 = document.getElementById('editor-3');
const editor4 = document.getElementById('editor-4');

editor1.addEventListener('blur', function () {
    colocarInfo(1);
});

editor2.addEventListener('blur', function () {
    colocarInfo(2);
});

editor3.addEventListener('blur', function () {
    colocarInfo(3);
});

editor4.addEventListener('blur', function () {
    colocarInfo(4);
});

function colocarInfo(id){
    const editor = document.getElementById("editor-"+id);
    const input = document.getElementById("op-"+id);

    input.value = editor.innerHTML;
}

function dibujarPotencia(id) {
    const base = document.getElementById('numer-'+id).value;
    const exponente = document.getElementById('exponente-'+id).value;
    const canvas = document.getElementById('canvas-'+id);
    const editor = document.getElementById('editor-'+id);

    const ctx = canvas.getContext('2d');

    const baseFont = 30;
    const expFont = 14;
    const padding = 2;

    ctx.font = `${baseFont}px Arial`;
    const baseWidth = ctx.measureText(base).width;
    const baseHeight = baseFont;

    ctx.font = `${expFont}px Arial`;
    const expWidth = ctx.measureText(exponente).width;
    const expHeight = expFont;

    const canvasWidthCSS = baseWidth + expWidth + padding * 4;
    const canvasHeightCSS = Math.max(baseHeight, expHeight * 1.2) + padding * 4;

    const dpr = window.devicePixelRatio || 1;

    canvas.width = canvasWidthCSS * dpr;
    canvas.height = canvasHeightCSS * dpr;

    canvas.style.width = canvasWidthCSS + 'px';
    canvas.style.height = canvasHeightCSS + 'px';

    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "#000000";
    ctx.font = `${baseFont}px Arial`;
    const baseY = canvasHeightCSS - padding * 2;
    ctx.fillText(base, padding * 2, baseY);

    ctx.font = `${expFont}px Arial`;
    const expX = padding * 2 + baseWidth;
    const expY = baseY - baseFont * 0.6;
    ctx.fillText(exponente, expX, expY);

    // Obtener la imagen como base64 completa
    const dataURL = canvas.toDataURL("image/png");

    // Insertar la imagen directamente en el div editable como HTML
    editor.innerHTML += `<img src="${dataURL}" style="vertical-align: middle; width: 80px; height: auto;">`;

    closeModal();
    editor.focus();
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
    document.getElementById("editor-0").focus();
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

// ----------------------- Formulas  -----------------------
function dibujarRaizComoImagen() {
    const numero = document.getElementById('numero').value;
    const canvas = document.getElementById('miCanvas');
    const contenedor = document.getElementById('editor-0');

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
}

function dibujarFraccionComoImagen() {
    const numerador = document.getElementById('numerador').value;
    const denominador = document.getElementById('denominador').value;
    const canvas = document.getElementById('miCanvas');
    const contenedor = document.getElementById('editor-0');

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
    closeModal();
}
</script>
</body>
</html>
