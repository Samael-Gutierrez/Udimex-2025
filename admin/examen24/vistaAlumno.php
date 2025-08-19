<?php
session_start();
$dir = "../../general/";
include($dir."db/portada.php");
include($dir."db/usuario.php");

$portada = $_GET["id"];

if($_POST){
    $us=trim($_POST['us']);
	$pas=trim($_POST['pas']);
    $datos=sesion_inicio($us,$pas);

	if($fila= mysqli_fetch_assoc($datos)){
		$_SESSION["g_id"] = $fila['id_usuario'];
		$_SESSION["g_nom"] = $fila['nombre'];
		$_SESSION["g_ap"] = $fila['ap_pat'];
	}
	
	$liga="location:vistaAlumno.php?id=$portada";
	header($liga);
}


$datos = obtener_datos($portada);
$_SESSION['tema']=$portada;

if ($fila = mysqli_fetch_assoc($datos)) {

    $materia = $fila['nombre_materia'];
    $escuela = $fila['nombre_escuela'];
    $logotipo = $fila['logotipo'];
    $tiempo = $fila['tiempo'];

    if($tiempo == 0){
        $tiempoM = 'Sin limite';
    }else{
        $tiempoM = $tiempo . " Minutos";
    }
 
     $datos2=b_us($fila['id_usuario']);
    if ($fila2 = mysqli_fetch_assoc($datos2)) {
            $profesor = $fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
    }

}



$contenido="";
$valor_Contenido = obtener_adicionales($portada);
while ($fila = mysqli_fetch_assoc($valor_Contenido)) {
    $contenido=$contenido."<div class='info-item'>
                        <strong>Titulo: </strong> 
                        <div class='info-box'>".$fila['contenido']."</div>
                    </div>
                    <div class='info-item'>
                        <strong>Instruccion:</strong> 
                        <div class='info-box'>".$fila['valor']."</div>
                    </div>";
                    $contenido=$contenido."<div class='info-item'>
                        <strong>".$fila['contenido'].": </strong> 
                        <div class='info-box'>".$fila['valor']."</div>
                    </div>";
}

if (isset($_SESSION["g_id"])){
    $boton="<div class='info-item'>
        <strong>Alumno: </strong>
        <div class='info-box'>
            ".$_SESSION["g_nom"]." ".$_SESSION["g_ap"]."
            </div>
    </div>
            <a href='../../alumno/examen.php?id=$portada&&tiempo=$tiempo' target='_PARENT'><button class='boton'>Iniciar Examen</button></a>
        ";
}
else{
    $boton="<div class='info-item'>
    <strong>Alumno: </strong>
    <div class='info-box'>
        <form method='POST'>
            <input type='text' name='us' placeholder='Usuario'> &nbsp; &nbsp;
            <input type='password' name='pas' placeholder='Contraseña'>
        
        &nbsp; &nbsp; <input type='submit' value='Entrar' class='boton'>
        </form>
    </div></div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="estilos_alumno.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Alumno</title>
</head>
<body>
    <div class="main-container">
        <header class="header">
            <div class="top-lines">
                <div class="red-line"></div>
                <div class="spacer"></div>
                <div class="blue-line"></div>
            </div>
            <h2>Datos del profesor</h2>
            <div class="header-content">
                <div class="logo-container">
                    <img src="img/<?php echo $logotipo; ?>" alt="Logotipo" class="logo">
                </div>
                <div class="info-container">
                    <div class="info-item">
                        <strong>Escuela:</strong> 
                        <div class="info-box"><?php echo $escuela; ?></div>
                    </div>
                    <div class="info-item">
                        <strong>Profesor:</strong> 
                        <div class="info-box"><?php echo $profesor; ?> </div>
                    </div>
                    <div class="info-item">
                        <strong>Tiempo:</strong> 
                        <div class="info-box"><?php echo $tiempoM; ?> </div>
                    </div>
                    <div class="info-item">
                        <strong>Materia:</strong> 
                        <div class="info-box"><?php echo $materia; ?></div>
                    </div>
                </div>
            

<?php echo $contenido; ?>
       

        
        
            <?php echo $boton ?>
           </div> 
        </header>

    </div>
</body>
</html>