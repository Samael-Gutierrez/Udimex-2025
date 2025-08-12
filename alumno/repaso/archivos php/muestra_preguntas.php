<?php 
session_start();
include("../funciones/funciones.php");

$control=0;
$datos=busca_repaso();
if ($fila=mysqli_fetch_assoc($datos)){
    if (!isset($_SESSION['g_id'])){
        $_SESSION['g_id']=0;
        $mat=0;
    }
    else{
        if($fila['id_alumno']!=$_SESSION['g_id']){
            //terminar la solicitud del alumno
            estado_solicitud($_SESSION['g_id'],$mat);
            $_SESSION['g_id']= $fila['id_alumno'];
            $mat=$fila['id_materia'];
        }
    }
    
    $id_repaso=$fila['id_repaso'];
    $_SESSION['id_repaso']= $id_repaso;
    $control=1;
}


if($control==1){

    $i=1;
    $incorrectas= "";
    $sql=conexion();
    $filtrado=estado($id_repaso);
    while($datos = $filtrado->fetch_object()){
        
        $incorrectas = $incorrectas. "
        <tr>
            <td class='preguntas' name='id_pregunta $datos->id_pregunta'>
                Dame 3 preguntas de opción multiple similares a esta '".$datos->pregunta."' con 4 opciones 
                cada una; además de que al final de la pregunta y de cada respuesta coloca una barra vertical. específicamente envíame solo lo que te pido.
            </td>
            <td class='preguntas'>
                <form class='siguiente'  action='subir_preguntas.php' method='POST'>
                    <button><i class='bi bi-floppy2-fill'></i></button>
                </form>
            </td>
            <td class='preguntas'>
                <form class='siguiente' action='../funciones/estado.php' method='POST'>
                    <input type='hidden' name='id_pregunta_repaso' value='$datos->id_pregunta_repaso'>
                    <input type='hidden' name='id' value='$datos->id_pregunta'>
                    <button type='submit'><i class='bi bi-arrow-right-circle-fill'></i></button>
                </form>    
            </td>
        </tr>";
    $i=$i+1;
    }
    
    if ($i==1){
        estado_solicitud2($id_repaso);
        if($control==1){
            header('location:muestra_preguntas.php');
        }
    }
    $mensaje="";
}
else{
    $incorrectas="";
    $mensaje="<br><br><center>No hay más repasos pendientes</center>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/muestra_preguntas.css">
     <title>Repaso</title>
</head>
<body>
    <div>
        <table>
            <thead>
                <td class="siguiente  titulo">Preguntas Erroneas</td>
                <td class="siguiente">Carga Preguntas</td>
                <td class="siguiente  titulo1">Siguiente Pregunta</td>
            </thead>
            <tbody>
                <?php echo $incorrectas; ?>
            </tbody>
        </table>
    </div>
        <?php echo $mensaje; ?>
   
</body>
</html>