<!DOCTYPE html>
<html lang="es-Mx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Comprimir</title>
</head>
<body>
    
<div class="container-fluid justify-content-center border p-0">
    <div class="container-fluid pt-3 pb-3 text-center bg-secondary">
        <h1 class="display-5 text-white-50">Comprimir Imagen</h1>
    </div>

    <div class="mt-3 mb-3 p-3">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="row border border-secondary">
                    <h3>Selecciona imagen</h3>
                    <hr>
                    <div class="text-center m-2" onclick="abrir_exp_foto();">
                        .
                    </div>
                    <div class="mt-3 fst-italic small text-muted text-center">
                        Click para buscar Archivo
                    </div>
                </div>

                <div class="row mt-4 border border-secondary shadow">
                    <h3>Calidad</h3>
                    <hr>
                    <input type="range" step="1" min="1" max="100" id="calidad" class="form-range mt-2 p-2" onchange="mostrar_valor_calidad();">
                    <div class="mt-3 fst-italic small text-muted text-center" id="valor_calidad">
                        Deslice para cambiar
                    </div>
                </div>
                <div class="row mt-4 border border-secondary shadow">
                    <h3>Opciones</h3>
                    <hr>
                    <div class="col-md-12 mb-3 text-center">
                        <button id="btn_comprimir" class="btn btn-lg btn-outline-dark">Comprimir IMG</button>
                    </div>
                </div>
                <input type="file" id="f_subir" value="" style="display:none;" onchange="obtener_vista_previa();" accept="image/*">
            </div>

            <div class="col-md-5 ms-2 border border-secondary shadow">
                <h3>Vista previa</h3>
                <hr>
                <div class="row">
                    <div id="div_comp" class="col-md-6 p-2 d-none">
                        <div class="fs-6 fst-italic text muted">
                            IMG a comprimir
                        </div>
                        <div id="vista_previa">

                        </div>

                        <div id="div_comp02" class="col-md-6 p-2 d-none">
                        <div class="fs-6 fst-italic text muted">
                            IMG comprimida
                        </div>
                        <div id="vista_previa_02">
                            
                        </div>
                    </div>
                </div>
                <div class="text-center d-none" id="div_desc">
                    <a id="btn_descargar" class="text-decoration-none">Descargar</a>
                </div>
            </div>

        </div>
    </div>
    <textarea id="imagen_comprimida_base64"></textarea>  
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const img_comp = document.getElementById('f_subir'),
            calidad = document.getElementById('calidad');

    const comprimirImagen = (imagencomoArchivo, porcentajeCalidad) => {
        return new Promise((resolve, reject) => {
            const canvas = document.createElement("canvas");
            const nva_imagen = new Image();

            nva_imagen.onload = () => {
                canvas.width = nva_imagen.width;
                canvas.height = nva_imagen.height;
                canvas.getContext("2d").drawImage(nva_imagen, 0, 0);
                canvas.toBlob(
                    (blob) => {
                        blob === null ? reject(blob) : resolve(blob);
                    }, "image/jpeg", 
                    porcentajeCalidad / 100
                );
            }

            nva_imagen.src = URL.createObjectURL(imagencomoArchivo);
        });
    }

    document.getElementById('btn_comprimir').addEventListener('click',
        async () => {
            if(img_comp.files.length <= 0){
                alert('Debe cargar una imagen');
                return;
            }

            const blob = await comprimirImagen(img_comp.files[0], parseInt(calidad.value));
            
            let vista_previa = document.getElementById('vista_previa_02'),
            img_vp = document.createElement('img');
            img_vp.classList = "img-thumbnail";
            img_vp.src = URL.createObjectURL(blob);
            vista_previa.innerHTML = '';
            vista_previa.append(img_vp);
            document.getElementById('div_comp02').classList.remove("d-none");
            document.getElementById('div_comp02').classList.add("d-block");

            const base64Imagen = await blobToBase64(blob);
            document.getElementById('imagen_comprimida_base64').value = base64Imagen;

            mostrar_descargar(URL.createObjectURL(blob));
        }
    );

    function blobToBase64(blob) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(blob);
        });
    }

    function mostrar_descargar(url) {
        const icono_desc = document.getElementById('btn_descargar');
        icono_desc.href = url;
        icono_desc.download = "Imagen_comprimida.jpg";
        document.getElementById('div_desc').classList.remove("d-none");
        document.getElementById('div_desc').classList.add("d-block");
    }

    function abrir_exp_foto() {
        document.getElementById('f_subir').click();
    }

    function mostrar_valor_calidad() {
        document.getElementById('valor_calidad').innerHTML = "Calidad " + calidad.value + " Deslice para cambiar.";
    }

    function obtener_vista_previa(){
        let reader = new FileReader();
        reader.readAsDataURL(img_comp.files[0]);
        reader.onload = function () {
            let vista_previa = document.getElementById('vista_previa'),
            img_vp = document.createElement('img');
            img_vp.classList = "img-thumbnail";
            img_vp.src = reader.result;
            vista_previa.innerHTML = '';
            vista_previa.append(img_vp);
            document.getElementById('div_comp').classList.remove("d-none");
            document.getElementById('div_comp').classList.add("d-block"); 
        }
    }

</script>
</body>
</html>