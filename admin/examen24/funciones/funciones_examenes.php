<?php

include "../../general/consultas/basic.php";

function obtener_examenes($id_usuario) {
  $consulta= "SELECT po.id_portada, ma.nombre_materia, ad.contenido FROM portada AS po, materias AS ma, adicionales AS ad
              WHERE po.id_usuario = $id_usuario
              AND po.id_portada = ad.id_portada
              AND po.id_materia = ma.id_materia
              AND po.estado = 1
  ";
  return completa($consulta);
}

function obtener_preguntas($id_examen) {
  $consulta = "SELECT * FROM cuestionario WHERE id_material = $id_examen";
  return completa ($consulta);
}

function obtener_respuestas($id_respuesta) {
   $consulta="SELECT * FROM respuesta WHERE id_pregunta= $id_respuesta";
   return completa ($consulta);

}

function obtener_materia($id_examen) {
     $consulta="SELECT m.nombre_materia FROM portada p JOIN materias m ON p.id_materia = m.id_materia WHERE p.id_portada= $id_examen";
     $resultado= completa ($consulta);
     $fila=mysqli_fetch_assoc($resultado);
     return $fila ['nombre_materia'];
}

function obtener_tiempo($id_examen) {
     $consulta = "SELECT tiempo FROM portada WHERE id_portada= $id_examen";
     $resultado = completa ($consulta);
     $fila = mysqli_fetch_assoc($resultado);
     return $fila ['tiempo'];
} 

function obtener_numeros ($id_pregunta) {
      $consulta="SELECT numero FROM columnas_r WHERE id_pregunta=$id_pregunta ORDER BY RAND()";
      return completa($consulta);
}
 
function obtener_incisos ($id_pregunta) {
    $consulta="SELECT inciso FROM columnas_r WHERE id_pregunta=$id_pregunta ORDER BY RAND()";
    return completa($consulta);
}

// function obtener_datos($portada){
//     $consulta= "SELECT * FROM portada as p, escuela_log as e, usuario as us, materias as m WHERE p.id_portada=$portada AND p.id_escuela= e.id_escuela AND p.id_usuario=us.id_usuario AND p.id_materia=m.id_materia";
//     return completa($consulta);
// }

function changeStatus($id){
    $consulta = "UPDATE portada SET estado = 0 WHERE id_portada = $id;";
    completa($consulta);
}

?>