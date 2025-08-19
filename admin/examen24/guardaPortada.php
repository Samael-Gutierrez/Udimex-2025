<?php
session_start();

$dir = "../../general/";
include($dir."db/portada.php");

$id_escuela = $id_profesor = $id_materia = 0;

if ($_POST) {
    //guardar la escuela y el logotipo
    if (!empty($_FILES['logotipo']['name'])) {
        $logotipo = $_FILES['logotipo']['name'];
        $imagen_tmp = $_FILES['logotipo']['tmp_name'];
        $nombreEscuela = $_POST["nombre_escuela"];
        $extension = strtolower(pathinfo($logotipo, PATHINFO_EXTENSION));

        if (in_array($extension, ["jpg", "jpeg", "png", "jfif"])) {
            if (!is_dir('img')) {
                mkdir('img', 0777, true);
            }
            echo "a";
            $ruta = 'img/' . $logotipo;
            if (move_uploaded_file($imagen_tmp, $ruta)) {
                $id_escuela = guardarEscuela($nombreEscuela, $logotipo);
            } 
        } else {
            header("Location: portada.php?s=1");
        }
    }else{
        $logotipo = "https://udimex.net/general/imagen/logo.png";
        $nombreEscuela = $_POST["nombre_escuela"];
        $id_escuela = guardarEscuela($nombreEscuela, $logotipo);
    }

    $id_profesor=$_SESSION['ad_id'];

    // Guardar la materia
    $counter = 0;
    $nombreMateria = !empty($_POST["nombre_materia"]) ? $_POST["nombre_materia"] : null;
    if ($nombreMateria) {
        $materias = verificaMateria($nombreMateria);
        while($fila=mysqli_fetch_assoc($materias)){
            $counter = $fila['total'];
        }
        if($counter>0){
            $counter_id = getIdByMateria($nombreMateria);
            while($filas=mysqli_fetch_assoc($counter_id)){
                $id_materia = $filas['id'];
                $_SESSION ["id_materia"] = $id_materia;
            }
        }else{
            $id_materia = guardarMateria($nombreMateria);
            $_SESSION ["id_materia"] = $id_materia;
        }
    }

    // Recuperar id_portada
    if ($id_escuela && $id_profesor && $id_materia) {
        $tiempo = $_POST['tiempo'];
        $id_portada = recuperar_id($id_escuela, $id_profesor, $id_materia, $tiempo);
            $_SESSION["id_portada"] = $id_portada;

        if ($id_portada) {
            echo "Datos guardados correctamente.";

            // Guardar datos adicionales
            if (!empty($_POST['valor'])) {
                $contenido = $_POST['contenido'];
                $valor = $_POST['valor'];
                datos_adicionales($id_portada, $contenido, $valor);
            }else{
                $contenido = $_POST['contenido'];
                $valor = "Contesta cuidadosamente todo el examen.";
                datos_adicionales($id_portada, $contenido, $valor);
            }
        }
        header("Location: preguntas.php");   
    } 
} 
?>
