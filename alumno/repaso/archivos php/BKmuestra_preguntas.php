<?php 
session_start();
include("../funciones/funciones.php");

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
}

//$_SESSION['g_id']= 157;
//$_SESSION['g_nom']= "Juanito";
//$_SESSION['g_ap']= "Clavo Un Clavito";

$i=1;
$incorrectas= "";
$sql=conexion();
$filtrado=estado($id_repaso);
while($datos = $filtrado->fetch_object()){
    $incorrectas = $incorrectas. " 
    <tr>
        <td class='preguntas' name='id_pregunta $datos->id_pregunta'>
            Dame 3 preguntas de opcion multple similares a esta ".$datos->pregunta." con 4 opciones 
            cada una además de que al final de todas las respuestas y después de cada signo de interrogación 
            colocar una barra vertical. Específicamente envíame solo lo que te pido.
        </td>
        <td class='preguntas'>
            <form class='siguiente' action='../funciones/estado.php' method='POST'>
                <input type='' name='id_pregunta_repaso' value='$datos->id_pregunta_repaso'>
                <input type='hidden' name='id' value='$datos->id_pregunta'>
                <button type='submit'><i class='bi bi-arrow-right-circle-fill'></i></button>
            </form>    
        </td>
    </tr>";
$i=$i+1;
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
                <td class="siguiente  titulo1">Siguiente Pregunta</td>
            </thead>
            <tbody>
                <?php echo $incorrectas; ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>