<?php
session_start();
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'spanish');

include "funciones/funciones.php";

$id_alumno = $_POST['id_alumno'];
$date = new DateTime();
$date_title = strftime("%d de %B del %Y", $date->getTimestamp());
$date_footer = strftime("%d días del mes de %B del %Y", $date->getTimestamp());
$date = date('d-m-Y');
$name = $date . " | " . $_POST['nombre'] . " " . $_POST['ap'] . " " . $_POST['am'] . " | Constancia" ;
$nameEncode = base64_encode($name);
$nameEncodeLocation = "https://udimex.net/archivos/".$nameEncode.".pdf";

//Obtiene el nombre de la carrera
if($_POST['id_carrera']){
    $id_carrera = $_POST['id_carrera'];
    if($id_carrera == 0){
        $carrera_cursando = "'Sin carrera'";
    }else{
    $carreras = buscar_carrera($id_carrera);
    while($carrera = mysqli_fetch_assoc($carreras)){
        $carrera_cursando = $carrera['nombre'];
    }
}
}else{
    $carrera_cursando = "'falta asignar carrera'";
}

// Obtiene el año de ingreso, en caso de ser '0000', coloca el año actual
if($_POST['f_ingreso']){
    $anio = substr($_POST['f_ingreso'], 0, 4);
    if($anio == 0000){
        $anio = date('Y');
    }
}else{
    $anio = date('Y');
}

if($_POST['tipo'] == 1){
    // Prepa - Espera de certificado
    $mensaje = "
    Por medio de la presente y a petición del interesado C. <strong>".$_POST['ap']." ".$_POST['am']." ".$_POST['nombre']."</strong> se hace <strong>CONSTAR</strong> que por número de <strong>matrícula $id_alumno-$anio</strong> concluyó satisfactoriamente el <strong>BACHILLERATO</strong> en la modalidad no escolarizada en la institución <strong>UNIVERSIDAD DIGITAL DE MÉXICO</strong>, con el reconocimiento de validez oficial de estudios de la Secretaria de Educación Pública, acuerdo 286 de la SEP y el modificatorio 02/04/17 a través de la institución evaluadora vigente <strong>“Centro Universitario Latino Veracruz, A.C”. Por lo que su certificado de estudios se encuentra en proceso de emisión ante la autoridad educativa correspondiente</strong>.
    ";

}elseif($_POST['tipo'] == 2){
    // Prepa - Está cursando
    $mensaje = "
    Por medio de la presente y a petición del interesado C. <strong>".$_POST['ap']." ".$_POST['am']." ".$_POST['nombre']."</strong> se hace <strong>CONSTAR</strong> que por número de <strong>matrícula $id_alumno-$anio</strong> se encuentra actualmente cursando el <strong>BACHILLERATO</strong> en la modalidad no escolarizada en la institución <strong>UNIVERSIDAD DIGITAL DE MÉXICO</strong>, con el reconocimiento de validez oficial de estudios de la Secretaria de Educación Pública, acuerdo 286 de la SEP y el modificatorio 02/04/17, por lo que guardo un estado de <strong>ALUMNO INSCRITO</strong> y <strong>REGULAR</strong> dentro de nuestra institución educativa.
    ";

}elseif($_POST['tipo'] == 3){
    // Licenciatura - Espera de certificado
    $mensaje = "
    Por medio de la presente y a petición del interesado C. <strong>".$_POST['ap']." ".$_POST['am']." ".$_POST['nombre']."</strong> se hace <strong>CONSTAR</strong> que por número de <strong>matrícula $id_alumno-$anio CONCLUYÓ</strong> satisfactoriamente la carrera de <strong class='mayusculas'>".$carrera_cursando ."</strong> en la modalidad no escolarizada en la institución <strong>UNIVERSIDAD DIGITAL DE MÉXICO</strong>, <span id='promedio'></span> con el reconocimiento de validez oficial de estudios de la Secretaria de Educación Pública, acuerdo 286 de la SEP y el modificatorio 02/04/17 a través de la institución evaluadora vigente <strong>“Centro Universitario Latino Veracruz, A.C”. Por lo que su certificado de estudios se encuentra en proceso de emisión ante la autoridad educativa correspondiente</strong>.
    ";
}elseif($_POST['tipo'] == 4){
    // Licenciatura - Está cursando
    $mensaje = "
    Por medio de la presente y a petición del interesado C. <strong>".$_POST['ap']." ".$_POST['am']." ".$_POST['nombre']."</strong> se hace <strong>CONSTAR</strong> que por número de <strong>matrícula $id_alumno-$anio</strong> se encuentra actualmente cursando la carrera de <strong class='mayusculas'>" .$carrera_cursando."</strong> en la modalidad no escolarizada en la institución <strong>UNIVERSIDAD DIGITAL DE MÉXICO</strong>, con el reconocimiento de validez oficial de estudios de la Secretaria de Educación Pública, acuerdo 286 de la SEP y el modificatorio 02/04/17, por lo que guardo un estado de <strong>ALUMNO INSCRITO</strong> y <strong>REGULAR</strong> dentro de nuestra institución educativa.
    ";
}elseif($_POST['tipo'] == 5){
    // Prepa - Termino con CCT
    $mensaje = "
    Por medio de la presente y a petición del interesado C. <strong>".$_POST['ap']." ".$_POST['am']." ".$_POST['nombre']."</strong> se hace <strong>CONSTAR</strong> que por número de <strong>matrícula $id_alumno-$anio</strong> <strong>CONCLUYÓ</strong> satisfactoriamente el <strong>BACHILLERATO</strong> en la modalidad no escolarizada en la institución <strong>UNIVERSIDAD DIGITAL DE MÉXICO</strong>, <span id='promedio'></span> a través del examen único de bachillerato mediante el acuerdo 286 de la SEP y modificatorias 02/04/17 de la Dirección General de Bachillerato con <strong>CCT 09DEX0001S. Por lo que su certificado de estudios se encuentra en proceso de emisión con fecha de entrega probable dentro de 4 meses a partir de la emisión de la presente.</strong>
    ";
}

echo "
<!DOCTYPE html>
<html lang='es-MX'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='estilos/styles.css'>
    <script src='https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js'></script>
    <title>$nameEncode</title>
</head>
<body>
<input type='hidden' id='text-input-location' name='nameFile' value='$nameEncodeLocation'/><br>
<header class='encabezado'>
    <img src='estilos/logo.png' alt='Logo'>
</header>

<div class='fecha'>
    <p>Zinacantepec, México a $date_title</p>
</div>

<div class='titulo'>
    <h2><a onclick='subirDocumento()'>Constancia de estudios</a></h2>
    <div id='subir' style='display: none' class='container-opciones'>
        <div class='opciones'>
            <form action='funciones/upload.php' method='POST' id='pdfForm' enctype='multipart/form-data' class='formulario'>
                <label>Subir constancia</label><br>
                <input type='file' name='pdfFile' id='pdfFile' accept='.pdf' required>
                <input type='hidden' id='text-input' name='nameFile' value='$nameEncode'/><br>
                <button type='submit'>Subir PDF</button><br>
            </form>
            <div class='promedio'>
                <input type='number' id='calificacion' min='7' step='.5' max='10' placeholder='Coloca el Promedio' style='width:100%;'><br>
                <a class='btn-promedio' onclick='colocarPromedio()'>Añadir Promedio</a><br>
                <a class='btn-promedio' onclick='quitarPromedio()'>Quitar Promedio</a>
            </div>
            <div class='botones'>
                <a onclick='ocultarSubir()'>Cerrar opciones</a>
                <a onclick='mostrarFirma()' style='display: none' id='btn-mostrar'>Mostrar Firma</a>
                <a onclick='ocultarFirma()' style='display: block' id='btn-quitar'>Quitar Firma</a>
            </div>
        </div>
    </div>
    <p>$mensaje</p><br>
    <p>Sin más por el momento, se extiende la presente <strong>CONSTANCIA</strong> a los <strong>" . $date_footer . "</strong>, para los fines que al interesado convengan.</p>
</div>

<div class='firma'>
    <div class='tabla'>
        <img src='estilos/firma.png' class='firmaTinta' id='firma-ing'>
        <table>
            <thead>
                <td>
                <p>Ing. Alfredo Tomás Dorado Flores<br>Director General</p>
                </td>
            </thead>
        </table>
    </div>

    <div class='codigo'>
        <div id='qr-container' class='qr'></div>
    </div>
</div>

<div class='sello'>Sello Digital:<br>". $nameEncode ."</div>

<div class='footer'>
    <p>Av. 16 de Septiembre 303, San Miguel, 51350 San Miguel Zinacantepec, Méx.<br>
    direccion@udimex.net <br>
    www.udimex.net
    </p>
</div>
";
?>

<script>
    // Función para generar el QR
    function generateQRCode() {
        const text = document.getElementById('text-input-location').value;

        QRCode.toDataURL(text, { errorCorrectionLevel: 'H' }, function (err, url) {
            if (err) {
                console.error('Error al generar el QR:', err);
                return;
            }

            // Crear una imagen con el QR generado
            const img = document.createElement('img');
            img.src = url;
            img.alt = 'Código QR';
            document.getElementById('qr-container').appendChild(img);
        });
    }

    // Mostrar para subir
    function subirDocumento(){
        document.getElementById('subir').style.display = 'block';
    }

    function ocultarSubir(){
        document.getElementById('subir').style.display = 'none';
    }

    function colocarPromedio(){
        promedio = document.getElementById('promedio');
        calificacion = document.getElementById('calificacion').value;
        total = `<strong>ACREDITÓ</strong> con un <strong>PROMEDIO GENERAL</strong> de <strong>${calificacion}</strong>,`;
        
        promedio.textContent = '';
        promedio.innerHTML = total;
    }

    function quitarPromedio(){
        promedio = document.getElementById('promedio');
        promedio.textContent = '';
    }

    function mostrarFirma(){
        document.getElementById('firma-ing').style.display = 'block';
        document.getElementById('btn-mostrar').style.display = 'none';
        document.getElementById('btn-quitar').style.display = 'block';
    }

    function ocultarFirma(){
        document.getElementById('firma-ing').style.display = 'none';
        document.getElementById('btn-mostrar').style.display = 'block';
        document.getElementById('btn-quitar').style.display = 'none';
    }

    document.addEventListener('keydown', function(event) {
        // Verificar si se presionan Ctrl y P para primero quitar el cuadro de opciones y luego imprimir
        if (event.ctrlKey && event.key === 'p') {
            event.preventDefault();
            ocultarSubir(); 
            setTimeout(function() {

            window.print();
            }, 0);
        }
        });

    window.onload = generateQRCode;

    // Obtén el formulario y el archivo
    const form = document.getElementById('pdfForm');
    const fileInput = document.getElementById('pdfFile');

    form.addEventListener('submit', async function(event) {
        event.preventDefault();  // Evita que se recargue la página
        
        const file = fileInput.files[0];
        const nameFile = document.getElementById('text-input').value;
        if (!file) {
            alert("Por favor selecciona un archivo PDF.");
            return;
        }
        
        const formData = new FormData();
        formData.append('pdfFile', file);
        formData.append('nameFile', nameFile);

        try {
            const response = await fetch('funciones/upload.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                alert("El archivo se subió exitosamente.");
                ocultarSubir();
            } else {
                alert("Hubo un problema al subir el archivo.");
            }
        } catch (error) {
            alert("Error en la conexión al servidor.");
        }
    });
</script>	
</body>
</html>