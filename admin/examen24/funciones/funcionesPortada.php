<?php


function conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "udimex") or die("Conexion fallida;");
    // $conexion=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("Conexion fallida;");
    return $conexion;
}

function completa($consulta) {
    $conexion = conectar();
    $datos = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    return $datos;
}

function completa2($consulta) {
    $conexion = conectar();
    $datos = mysqli_query($conexion, $consulta);
    $datos = mysqli_insert_id($conexion);
    mysqli_close($conexion);
    return $datos;
}

function guardarEscuela($nombreEscuela, $logotipo) {
    $consulta = "INSERT INTO escuela_log (id_escuela, nombre_escuela, logotipo) VALUES ('', '$nombreEscuela', '$logotipo')";
    return completa2($consulta);
}

function recuperarImagen($id) {
    $consulta = "SELECT logotipo FROM escuela_log WHERE id = $id";
    $resultado = completa($consulta);
    
}

// function guardarProfesor($nombreProfesor) {
//     $consulta = "INSERT INTO profesores (nombre_profesor) VALUES ('$nombreProfesor')";
//     return completa2($consulta);
// }

function verificaMateria($materia){
    $consulta = "SELECT COUNT(id_materia) AS total
                FROM materias
                WHERE nombre_materia = '$materia'
    ";
    return completa($consulta);
}

function getIdByMateria($materia){
    $consulta = "SELECT id_materia AS id 
                FROM materias 
                WHERE nombre_materia = '$materia'
                ORDER BY id_materia DESC
                LIMIT 1
    ";
    return completa($consulta);
}

function guardarMateria($nombreMateria) {
    $consulta = "INSERT INTO materias (nombre_materia) VALUES ('$nombreMateria')";
    return completa2($consulta);
}

function recuperar_id($id_escuela, $id_usuario, $id_materia, $tiempo) {
    $consulta = "INSERT INTO portada (id_escuela, id_usuario, id_materia, tiempo) VALUES ('$id_escuela',  '$id_usuario',  '$id_materia', $tiempo)";
    return completa2($consulta);
}

function datos_adicionales($id_portada, $contenido, $valor) {
    $consulta = "INSERT INTO adicionales (id_portada, contenido, valor) VALUES ('$id_portada', '$contenido', '$valor')";
    echo $consulta;
    $resultado = completa($consulta);
    return $resultado;
}


function guardarRespuesta($id_portada, $pregunta_id, $respuesta) {
    $consulta = "INSERT INTO respuestas (id_portada, id_pregunta, respuesta) VALUES ('$id_portada', '$pregunta_id', '$respuesta')";
    completa($consulta);
}

function obtenerPortada($id_portada) {
    $consulta = "SELECT id_escuela, id_usuario, id_materia FROM portada WHERE id_portada = $id_portada";
    $resultado = completa($consulta);
    return completa($consulta);

}

function obtener_datos($portada){
    $consulta= "SELECT * FROM portada as p, escuela_log as e, usuario as us, materias as m WHERE p.id_portada=$portada AND p.id_escuela= e.id_escuela AND p.id_usuario=us.id_usuario AND p.id_materia=m.id_materia";
    return completa($consulta);
}

 function obtener_adicionales ($portada){
     $consulta= "SELECT * FROM adicionales as a WHERE a.id_portada=$portada";
     return completa($consulta);
 }
 
?>