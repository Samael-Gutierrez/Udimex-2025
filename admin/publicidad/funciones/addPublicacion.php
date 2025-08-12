<?php
session_start();
include("../../funciones.php");
include("../../../general/consultas/admin.php");
include("../../../general/consultas/basic.php");
echo "a";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $contenido = $_POST['contenido'];
    $prioridad = $_POST['prioridad'];
    $lugar = $_POST['lugar'];
    $n_grupos=$grupos=20;
    
    // Procesar la img solo si se ha subido
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = $_FILES['imagen']['name'];
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $extencion = explode(".", $imagen);
        
        if ($extencion[1] == "jpg" || 
            $extencion[1] == "jpeg" || 
            $extencion[1] == "png") {
            $ruta = '../img/' . $imagen;
            // Mover a la carpeta 'img'
            move_uploaded_file($imagen_tmp, $ruta);
            añadirPublicacion($nombre, $contenido, $imagen, $prioridad, $n_grupos, $lugar);
        } else {
            echo "El formato " . $extencion[1] . " no es válido";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport"  content="width=device-width, user-escalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
    <link rel="stylesheet" href="../css/newEstilos.css">
    <title>Añadir Publicaciones</title>

    <?php
        usuario("../../../",'index.php');
        menu_i("../../");
    ?>
    
</head>
<body>
<section class="s1-edit-add">
        <a class="botonVolver buttonVolver boton-centrado candal" href="../index.php">Volver</a>
        <div class="text-s1-edit-add">
            <h1 class="candal text-s1-edit-add">Añadir Publicación</h1>
        </div>
</section>

<section class="s2-add">
<form class="formulario" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">

    <div class="llena-formulario">
        <label class="taman-text label-nombre separa candal" for="nombre">Nombre de la publicación:</label>
        <input class="input-nombre taman-text2 separa" type="text" id="nombre" name="nombre" maxlength="70" required>
        <img src="/img/<?$imagen?>" alt="">

        <label class="taman-text label2 candal" for="contenido">Contenido:</label>
        <textarea class="input-contenido taman-text2 separa" type="text" id="contenido" name="contenido"  required></textarea>
    
    <div class="super-principal">
    <div class="div-prioridad1">
        <label class="taman-text candal" for="prioridad">Prioridad:</label>
    <div class="div-prioridad2">
        <select class="taman-text2 select-color separa tamano" name="prioridad" >
            <option value=1>1 Baja</option>
            <option value=2>2 Media</option>
            <option value=3>3 Alta</option>
        </select>
        </div>
    </div>
    <div class="div-lugar1">
        <label class="taman-text candal" for="lugar">Lugar:</label>
        <div clas="div-lugar2">
        <select class="taman-text2 select-color separa tamano" name="lugar">
            <option value=0>0 Foraneo/Local</option>
            <option value=1>1 Local</option>
        </select>
        </div>
    </div>

    </div>
        <input class="select-img" for="imagen" type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)"  required>
    <div class="div-boton">
        <button type="submit"  class="botonEnviar"><i class="bi bi-check2"></i></button>
    </div> 
    </div>

        <div class="visualiza-img">
            <h1 class="h1-previsualizacion candal">Previsualización</h1>
        <div class="visualiza-img2">
        <img class="img-previa" id="imagenPrevia" src="#" alt="Previsualización de la imagen" style="display:none"> 
        </div>
    </div>
</form>
</section>

<script>
function mostrarImagen(event) {
  var archivo = event.target.files[0];
  var lector = new FileReader();
  lector.onload = function(event) {
    var imagen = document.getElementById('imagenPrevia');
    imagen.src = event.target.result;
    imagen.style.display = 'block';
  }
  lector.readAsDataURL(archivo);
}
</script>
</body>
</html>