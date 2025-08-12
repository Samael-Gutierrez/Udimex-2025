<?php
	include('general/funcion/basica.php');
?>

<!DOCTYPE html>
<html>
<title>UDIMEX</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="general/assets/css/estilos.css">
    <meta name="description" content="Somos una escuela que pertenece al acuerdo 286 de la SEP, te ayudaremos a obtener tu certificado de tus estudios usando como base tu experiencia profesional o conocimiento autodicácta, decidete hoy a estudiar con nosotros">
    <meta name="keywords" content="Escuela en línea, primaria, secundaria, preparatoria, licenciatura, estudia en línea, educación a distancia, universidad digital">

    <!-- Resource style -->
    <link href="general/estilo/style.css" rel="stylesheet" type="text/css" media="all">
    <link href="general/estilo/becas.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <?php carga_estilo(''); ?>
</head>
<body>

<div class="header">
    <img src="general/imagen/logo.png" alt="Logo">
</div>

<div class="separacion">
    <a onclick="goHome()" class="home"><p><i class="bi bi-house-door-fill"></i> Home</p></a>
    <p class="title">Becas</p>
</div>

<div class="container-becas">
    <div class="card-becas">
        <div class="tab-title">
            <h3>Licenciatura</h3>
        </div>
        <div class="santander">
            <img src="imagen/santander.jpg" alt="santander-becas">
        </div>
        <div class="parrafo-becas">
            <p><a href="https://app.santanderopenacademy.com/es/program/apoyo-a-la-manutencion-2024" target="_blank"><i class="bi bi-info-circle icons"></i></a> Movilidad</p>
            <p><a href="https://app.santanderopenacademy.com/es/program/de-excelencia-academica-2024 "><i class="bi bi-info-circle icons"></i></a> Excelencia académica</p>
        </div>
    </div>

    <div class="card-becas">
        <div class="tab-title">
            <h3>Maestría</h3>
        </div>
        <div class="santander">
            <img src="imagen/santander.jpg" alt="santander-becas">
        </div>
        <div class="parrafo-becas">
            <p><a href="https://app.santanderopenacademy.com/es/program/apoyo-a-la-manutencion-2024" target="_blank"><i class="bi bi-info-circle icons"></i></a> Movilidad</p>
            <p><a href="https://app.santanderopenacademy.com/es/program/de-excelencia-academica-2024 "><i class="bi bi-info-circle icons"></i></a> Excelencia académica</p>
        </div>
    </div>

    <div class="card-becas">
        <div class="tab-title">
            <h3>Doctorado</h3>
        </div>
        <div class="santander">
            <img src="imagen/santander.jpg" alt="santander-becas">
        </div>
        <div class="parrafo-becas">
            <p><a href="https://app.santanderopenacademy.com/es/program/apoyo-a-la-manutencion-2024" target="_blank"><i class="bi bi-info-circle icons"></i></a> Movilidad</p>
            <p><a href="https://app.santanderopenacademy.com/es/program/de-excelencia-academica-2024 "><i class="bi bi-info-circle icons"></i></a> Excelencia académica</p>
        </div>
    </div>

    <div class="card-becas">
        <div class="tab-title">
            <h3>Aprender Inglés</h3>
        </div>
        <div class="santander">
            <img src="imagen/santander.jpg" alt="santander-becas">
        </div>
        <div class="parrafo-becas">
            <p><a href="https://app.santanderopenacademy.com/es/program/usa-summer-experience-2025-penn" target="_blank"><i class="bi bi-info-circle icons"></i></a> USA Summer Experience</p>
        </div>
    </div>

</div>
<script>
    function goHome(){
        window.history.back();
    }
</script>
</body>
</html>