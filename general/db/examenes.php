<?php
include "basica.php";

function obtener_examenes($id_usuario) {
  $consulta= "SELECT po.id_portada, ma.nombre_materia, ad.contenido FROM portada AS po, materias AS ma, adicionales AS ad
              WHERE po.id_usuario = ?
              AND po.id_portada = ad.id_portada
              AND po.id_materia = ma.id_materia
              AND po.estado = 1
  ";
  return ejecuta($consulta, [$id_usuario], 0);
}

function obtener_preguntas($id_examen) {
  $consulta = "SELECT * FROM cuestionario WHERE id_material = ?";
  return ejecuta ($consulta, [$id_examen], 0);
}

function obtener_respuestas($id_respuesta) {
   $consulta="SELECT * FROM respuesta WHERE id_pregunta= ?";
   return ejecuta ($consulta, [$id_respuesta], 0);

}

function obtener_materia($id_examen) {
     $consulta="SELECT m.nombre_materia FROM portada p JOIN materias m ON p.id_materia = m.id_materia WHERE p.id_portada= ?";
     $resultado= ejecuta ($consulta, [$id_examen], 0);
     $fila=mysqli_fetch_assoc($resultado);
     return $fila ['nombre_materia'];
}

function obtener_tiempo($id_examen) {
     $consulta = "SELECT tiempo FROM portada WHERE id_portada= ?";
     $resultado = ejecuta ($consulta, [$id_examen], 0);
     $fila = mysqli_fetch_assoc($resultado);
     return $fila ['tiempo'];
} 

function obtener_numeros ($id_pregunta) {
      $consulta="SELECT numero FROM columnas_r WHERE id_pregunta=? ORDER BY RAND()";
      return ejecuta($consulta, [$id_pregunta], 0);
}
 
function obtener_incisos ($id_pregunta) {
    $consulta="SELECT inciso FROM columnas_r WHERE id_pregunta=? ORDER BY RAND()";
    return ejecuta($consulta, [$id_pregunta], 0);
}


function changeStatus($id){
    $consulta = "UPDATE portada SET estado = 0 WHERE id_portada = ?;";
    ejecuta($consulta, [$id], 0);
}

function cambiaTiempo($tiempo, $id){
    $consulta = "UPDATE portada SET tiempo = ? WHERE id_portada = ?";
    ejecuta($consulta, [$tiempo, $id], 0);
}

function guardar_datos($nombre, $apellido_paterno, $apellido_materno, $correo, $contraseña) {
    $consulta = "INSERT INTO usuario(nombre, ap_pat, ap_mat, correo, usuario, clave) VALUES(?, ?, ?, ?, ?, ?)";
   ejecuta($consulta, [$nombre, $apellido_paterno, $apellido_materno, $correo, $correo, $contraseña], 0);
}

function sesion_inicio($us, $pas) {
   $consulta="SELECT id_usuario, nombre, ap_pat,ap_mat FROM usuario WHERE correo=? AND clave=? ";
   return ejecuta($consulta, [$us, $pas], 0);
}

?>