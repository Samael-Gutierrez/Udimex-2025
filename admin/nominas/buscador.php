<?php
session_start();
include("modelo/conexion.php");
include("../funciones.php");
include("../../general/consultas/admin.php");
cabeza("Nóminas - Udimex","");



//Buscar empleado con área

if ($_POST){
    $id = $_POST["id_empleado"];
    $_SESSION["id_us"]=$id;
}

$id=$_SESSION["id_us"];

$sql =busca_id_empleado($id);
if($fila=mysqli_fetch_assoc($sql)){
    $empleado="<h2>Nómina de:"."<br>".$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']."<h4>"."<br>".$fila['descripcion']."</h4>"."</h2>";
}
// Listado de Periodos 
$dia = date ('d');
$mes= intval(date ('m'));
$meses = ['', 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
if($dia >13 && $dia <29){
    $panterior= "29 de ".$meses[$mes-1]. " - 13 de ".$meses[$mes];
    $pactual= "14 de ".$meses[$mes]. " - 28 de ".$meses[$mes];
    $pdespues= "29 de ".$meses[$mes]. " - 13 de ".$meses[$mes +1];
}
else{
    $panterior= "14 de ".$meses[$mes-1]. " - 28  de ".$meses[$mes-1];
    $pactual= "29 de  ".$meses[$mes-1]. " - 13 de ".$meses[$mes];
    $pdespues= "14 de ".$meses[$mes]. " - 28 de ".$meses[$mes];
}
$panterior= "<option value='$panterior'>$panterior</option>";
$pactual= "<option value='$pactual' selected >$pactual</option>";
$pdespues= "<option value='$pdespues'>$pdespues</option>";

$periodo= $panterior. $pactual .$pdespues;

 $usuario= "<input type='hidden' value='$id' name='id'>";

?>

<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="css/buscador.css">
    <script src="https://kit.fontawesome.com/4405b53c68.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Nominas Usuario</title>
    
</head>
<body>
<?php
usuario("../../",1);
menu_i();
?>
<nav>
    <a href="index.php">Regresar</a>
</nav>

<div class="main-container"> <!-- Contenedor principal -->
    <!-- Buscador -->
    <!-- Título -->
     <center>
    
   <br> <?php
        echo $empleado;
    ?>

    <!-- Inicio Form -->
    <form class="container container-fluid col-6" method="POST" action= "nominas.php">
        <div class="mb-3">
            <!-- Input oculto = id usuario -->
            <?php echo $usuario; ?>

            <!-- Input periodos -->
            <label for="periodo" class="form-label"></label>
            <select class="form-control" id="periodo" name="periodo" onchange="cambiaPeriodo();"> 
                <?php echo $periodo; ?>
            </select>
            <div id="emailHelp" class="form-text">Seleccione el periodo</div>

        </div>
        
        <!-- Botón de buscar -->
            <button type="submit" class="btn btn-primar" style="background-color: #0e3b83; color: white; border: none;" name="btnfiltro" value="ok">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            

        <!-- Subtitulo -->
         <br><h6 class="text-center p-3">Aquí puede agregar Percepciones y Deducciones</h6>
    </form>
</div> <!-- Fin del contenedor principal -->
</body>
</html>