<?php
include "basic.php";

// Variables
$counter = $_POST['contador'];
$id_alumno = $_POST['id_alumno'];
$id_tarea = $_POST['id_tarea'];
$descripcion = $_POST['descripcion'];
$base64_string = $_POST['imagen'];

if($base64_string === '1'){
    
    $extension = getExtension(); 
    $valido = validation($extension);

    if ($valido == 1) {
        $tarea_name = getFileName($id_alumno, $id_tarea, $counter, $extension);
        $tarea_temp = $_FILES['archivo']['tmp_name'];
        $route = "../../tarea-alumno/" . $tarea_name;
        move_uploaded_file($tarea_temp, $route);

        consultaSQL($id_alumno, $id_tarea, $tarea_name, $descripcion);
        actualizarTarea($id_tarea, $id_alumno);

        $mensaje = message(1);
    } else {
        $mensaje = message(0);
    }
    header("Location:../../seccion_tareas.php?mensaje=".$mensaje);

}else{
    $base64_string = preg_replace('/^data:image\/\w+;base64,/', '', $base64_string);
    $imagen_decodificada = base64_decode($base64_string);

    $nombre_archivo = getFileName($id_alumno, $id_tarea, $counter, '.jpeg');
    $ruta_archivo = "../../tarea-alumno/" . $nombre_archivo;

    consultaSQL($id_alumno, $id_tarea, $nombre_archivo, $descripcion);
    actualizarTarea($id_tarea, $id_alumno);

    file_put_contents($ruta_archivo, $imagen_decodificada);

    $mensaje = $mensaje = message(1);
    header("Location:../../seccion_tareas.php?mensaje=".$mensaje);
}    

function getExtension(){
    $tarea_name_full = $_FILES['archivo']['name'];
    $cortador = explode(".", $tarea_name_full);
    $extension = "." . $cortador[1];
    return $extension;
}

function getFileName($id_alumno, $id_tarea, $counter, $ext){
    $nombre_normalizado = 'AL'.$id_alumno.'-T'.$id_tarea.'-P'.$counter;
    $tarea_name = $nombre_normalizado . $ext;
    return $tarea_name;
}

function consultaSQL($id_alumno, $id_tarea, $tarea_name, $descripcion){
    $consulta = "INSERT INTO tarea_us(id_alumno, id_tarea, archivo, descripcion, estado) VALUES( '$id_alumno', '$id_tarea', '$tarea_name', '$descripcion', 0)";
    completa($consulta);
}

function actualizarTarea($id_tarea, $id_alumno){
    $entrega = date("Y-m-d");
    $consulta = "UPDATE tarea_alumno SET fecha_entrega = '$entrega' WHERE id_tarea = $id_tarea AND id_alumno = $id_alumno";
    completa($consulta);
}

function message($men){
    if($men == 1){
        $mensaje = "Tarea subida con exito";
    } else {
        $mensaje = "Solo formato .png .jpg .pdf .jpeg .docx .xlsx .pptx .zip";
    }
    return $mensaje;
}

function validation($ext){
    $valido = 1;

    switch ($ext){
        case ".pdf":
            break;

        case ".docx":
            break;
        
        case ".xlsx":
            break;

        case ".pptx":
            break;
        
        case ".zip":
            break;
            
        case ".py":
            break;

        default:
            $valido = 0;
            break;   
    }

    return $valido;
}