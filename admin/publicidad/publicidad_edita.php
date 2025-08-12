<?php
    session_start();
    $dir="../../general/";
    include($dir."php/admin.php");
    include($dir."db/admin.php");
    include($dir."db/basica.php");
    include($dir."db/publicidad.php");

   $adicional="<link rel='stylesheet' href='".$dir."css/publicidad.css'><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>";
   cabeza("Publicidad - Udimex",$adicional,0);
   
     usuario("../../",'index.php');
     menu_i($dir);

$id_publicidad = $_GET['id'] ?? null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? $nombre;
    $contenido = $_POST['contenido'] ?? $contenido;
    $prioridad = $_POST['prioridad'] ?? $prioridad;
    $estado = $_POST['estado'] ?? 1;
    $lugar = $_POST['lugar'] ?? $lugar;
    $n_grupos = $_POST['n_grupos'] ?? $n_grupos;
    $consulta_update = actualiza_publicidad($nombre,$contenido, $prioridad, $n_grupos, $lugar, $estado, $id_publicidad);

        if (!empty($_FILES["imagen"]["name"])) {
         $directorio_destino = 'img/'; //  ../../IA/publicidad/imagen/
            $ruta_destino = $directorio_destino . $_FILES['imagen']['name'];
            $imagen = $_FILES['imagen']['name'];
            $extencion= explode(".", $imagen);

        if($extencion[1]=="jpg" ||
            $extencion[1]=="jpeg" ||
            $extencion[1]=="png" ||
            $extencion[1]=="img"
            ){
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                $resultado = actualiza_imagenP($imagen, $id_publicidad);
            } else {
                echo 'Hubo un error al subir la nueva imagen.';
            }
        }else {
            echo "El formato" .$extencion[1]."No es valido";
        }
    }
}



if (!$id_publicidad) {
    die("Se necesita proporcionar un ID de publicación válido.");
}

$resultado =  busca_publicidad2($id_publicidad);
      
if ($publicidad = $resultado->fetch_assoc()){
    $nombre = $publicidad["nombre"];
    $contenido = $publicidad["contenido"];
    $imagen = $publicidad["imagen"];
    $prioridad = $publicidad["prioridad"];
    $estado = $publicidad["estado"];
    $lugar = $publicidad["lugar"];
    $n_grupos = $publicidad["n_grupos"];
}


?>

<body>
    <section class="s1-edit-add">
        <a class="botonVolver buttonVolver boton-centrado candal" href="index.php">Volver</a>
        <div class="text-s1-edit-add">
            <h1 class="candal text-s1-edit-add">Editar Publicación</h1>
        </div>
    </section>
    
    <section class="s2-add">
        <form class="formulario" method="post" enctype="multipart/form-data">
        <div class="llena-formulario">
                <label class="taman-text label-nombre separa candal" for="nombre">Nombre de la publicación:</label>
                <input class="input-nombre taman-text2 separa" type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"  maxlength="70" required>
                
                <label for="contenido" class="taman-text label2 candal">Contenido:</label>
                <textarea class="input-contenido taman-text2 separa" id="contenido" name="contenido" maxlength="1000" required><?php echo $contenido; ?></textarea>
                
            <div class="super-principal">
                <div class="div-prioridad1">
                <label class="taman-text candal" for="prioridad">Prioridad:</label>
                <select class="taman-text2 select-color separa tamano" name="prioridad">
                    <option value="1" <?php if ($prioridad == 1) echo 'selected'; ?>>1 Baja</option>
                    <option value="2" <?php if ($prioridad == 2) echo 'selected'; ?>>2 Media</option>
                    <option value="3" <?php if ($prioridad == 3) echo 'selected'; ?>>3 Alta</option>
                </select>
                </div>
                <div class="div-lugar1">
                <label class="taman-text candal" for="lugar">Lugar:</label>
                <select class="taman-text2 select-color tamano" name="lugar">
                    <option value="0" <?php if ($lugar == 0) echo 'selected'; ?>>Local y Foráneo</option>
                    <option value="1" <?php if ($lugar == 1) echo 'selected'; ?>>Sólo Local</option>
                </select>

                </div>
            </div>
                <div class="super-principal">
            <div class="div-prioridad1">
                <label class="taman-text candal" for="estado">Estado:</label>

                <select class="taman-text2 select-color separa tamano" name="estado">
                    <option value="1" <?php if ($estado == 1) echo 'selected'; ?>>1 Activada</option>
                    <option value="0" <?php if ($estado == 0) echo 'selected'; ?>>0 Desactivada</option>
                </select>

            </div>
            <div class="div-lugar1">
                <label class="taman-text candal" for="n_grupos">Grupos:</label>
                <input class="taman-text2 select-color separa tamano" type="number" min="1" max="30" id="n_grupos" name="n_grupos" value="<?php echo $n_grupos; ?>"  maxlength="2" required>
                </div>
                </div>

                <div  class="label-edi-img">
                    <label class="taman-text candal" for="imagen">Cambiar imagen:</label>
                    <input class="select-img-edit" id="imagen" type="file" name="imagen" accept="image/*" onchange="mostrarImagen(event)">
                </div>

                <div class="div-boton">
                    <button class="botonEnviar-Edit" type="submit"><i class="bi bi-arrow-clockwise"></i></button>
                </div>
            </div>

            <div class="visualiza-img-edit">
                <h1 class="h1-previsualizacion candal">Previsualización</h1>
            <div class="visualiza-img2-edit">
                <?php if(!empty($imagen)): ?>
                <img  class="img-previa-edit" id="imagenPrevia" src="img/<?php echo $imagen; ?>" alt="No se pudo visualizar la imagen" style=" display: block;"/>
                <?php else: ?>
                <img class="imagenPrevia-edit" id="imagenPrevia" src="" alt="Previsualización de la imagen">
                <?php endif; ?>
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
