<?php
function conexion (){
    $base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
    return $base;
  }
function b_carrera (){
    $consulta= "SELECT id_carrera, nombre FROM carrera WHERE estado >0";
    return completa ($consulta);
 }
 function b_bloque($tipo){
  $consulta= "SELECT DISTINCT(semestre) as bloque FROM dmateria WHERE id_carrera = $tipo";
  return completa ($consulta);
}
function b_materia($tipo){
  $consulta= "SELECT dm.id_materia, m.nombre, dm.semestre FROM dmateria as dm, materia as m WHERE m.id_materia = dm.id_materia AND dm.id_carrera = $tipo";
  return completa ($consulta);
}
function completa($consulta){
   $base=conexion();
   $dato=mysqli_query($base, $consulta);
   mysqli_close($base);
   return $dato;
 }
function completa2($consulta){
  $base=conexion();
  $dato=mysqli_query($base, $consulta);
  $dato=mysqli_insert_id($base);
  mysqli_close($base);
  return $dato;
}
function g_dia($dia_s, $tipo){
          $consulta = "INSERT INTO grupo (dias,tipo, estado) VALUES ('$dia_s','$tipo','1')";
          return completa2($consulta);
      } 
function g_horario($id_grupo, $horario, $id_us, $materia){
    $consulta="INSERT INTO profesor VALUES ('','$id_us','$id_grupo','$horario', '$materia')";
    completa($consulta);
    }
function b_alumno($nombre, $a_paterno, $a_materno){
  $consulta="SELECT * FROM usuario as us, alumno as al WHERE us.id_usuario = al.id_usuario
  and us.nombre like '$nombre' and
  us.ap_pat like '$a_paterno' and
  us.ap_mat like '$a_materno'";
  return completa($consulta);
}
function a_alumno($id_alumno, $id_grupo){
  $consulta="INSERT INTO alumno_grupo VALUES('','$id_alumno', '$id_grupo')";
  completa($consulta);
}
function obtener_a_g($id_grupo) {
  $consulta = "SELECT u.nombre, u.ap_pat, u.ap_mat, a.id_alumno  FROM usuario as u, alumno as a, alumno_grupo as ag 
  WHERE u.id_usuario = a.id_usuario AND ag.id_alumno = a.id_alumno 
  AND ag.id_grupo ='$id_grupo'";
  return completa($consulta);
}
function g_lista($id_alumno, $id_grupo,$id_materia,$asistencias,$fecha){
  $consulta = "INSERT INTO pase_lista VALUES ('','$id_alumno','$id_grupo','$id_materia', '$asistencias','$fecha')";
  completa($consulta);
}
 function g_lista_l($id_alumno,$asistencias,$fecha){
   $consulta = "INSERT INTO pase_linea VALUES ('','$id_alumno','$asistencias','$fecha')";
   completa($consulta);
 }
function i_materia($materia){
  $consulta = "SELECT * FROM materia WHERE id_materia = $materia";
  return completa($consulta);
}
function s_alumnos($id_grupo){
  $consulta = "SELECT COUNT(alumno_grupo.id_alumno) as alumnos FROM grupo, alumno_grupo 
  WHERE grupo.id_grupo =$id_grupo AND grupo.id_grupo = alumno_grupo.id_grupo AND alumno_grupo.id_alumno >0";
  return completa($consulta);
}
// function g_al_mat($id_alumno,$id_materia){
//    $consulta = "INSERT INTO alumno_materia VALUES('','1', '$id_alumno', '$id_materia')";
//    completa($consulta);
//  }
function obtener_a_l() {
  $consulta = "SELECT a.id_alumno, a.id_usuario FROM usuario as u, alumno as a, alumno_grupo as ag, grupo WHERE u.id_usuario = a.id_usuario AND ag.id_alumno = a.id_alumno AND grupo.dias = 'En Línea'";
  return completa($consulta);
}
function usuario_a($usuario){
  $consulta="SELECT id_alumno FROM alumno, usuario WHERE alumno.id_usuario = $usuario AND usuario.id_usuario=alumno.id_usuario";
  return completa($consulta);
}
function asistencia_l(){
  $consulta="SELECT usuario, COALESCE(SUM(inter_min), 0) AS minutos_totales FROM ( SELECT usuario, TIMESTAMPDIFF(MINUTE, fecha, COALESCE(LEAD(fecha) OVER (PARTITION BY usuario ORDER BY fecha), NOW())) AS inter_min FROM bitacora WHERE descripcion = 'activo' AND fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND fecha < CURDATE() + INTERVAL 1 DAY ) AS intervalos GROUP BY usuario";
  return completa($consulta);
}
function g_mat_g ($id_materia, $id_grupo){
   $consulta = "INSERT INTO materia_grupo VALUES ('', '$id_materia', '$id_grupo')";
   completa($consulta);
 } 
function o_grupo($id){
  $consulta = "SELECT g.id_grupo, m.nombre, m.id_materia, g.dias, p.horario FROM grupo as g, profesor as p, materia as m 
  WHERE g.id_grupo = p.id_grupo AND m.id_materia = p.id_materia 
  AND g.estado =1 AND p.id_usuario='$id'";
 return completa($consulta);
}
function e_alumno($id_grupo, $id_alumno){
  $consulta = "DELETE FROM alumno_grupo WHERE id_alumno ='$id_alumno' and id_grupo = '$id_grupo'";
  completa($consulta);
}

function r_usuario($id_usuario, $descripcion, $fecha_ac){
  $consulta="INSERT INTO bitacora VALUES ('','$id_usuario','$descripcion','$fecha_ac')";
  completa($consulta);
}

function g_calificacion($id_alumno, $id_materia, $id_grupo, $valor, $fecha){
  $consulta = "INSERT INTO primer_p VALUES ('', '$id_alumno', '$id_materia','$id_grupo','$valor', '$fecha')";
  completa($consulta);
}
function m_calificacion($id_grupo, $id_materia, $id_alumno){
  $consulta="SELECT * FROM primer_p WHERE id_grupo = $id_grupo AND id_materia = $id_materia AND id_alumno= $id_alumno";
  return completa($consulta);
}
function modifica_parcial1($calificacion, $id_grupo, $id_materia, $id_alumno, $id_parcial1){
  $consulta = "UPDATE primer_p SET valor1 = $calificacion WHERE id_grupo = $id_grupo AND id_materia = $id_materia AND id_alumno= $id_alumno AND id_parcial1=$id_parcial1";
  completa($consulta);
}
function g_calificacion2($id_alumno, $id_materia, $id_grupo, $valor, $fecha){
  $consulta = "INSERT INTO segundo_p VALUES ('', '$id_alumno', '$id_materia','$id_grupo','$valor', '$fecha')";
  completa($consulta);
}
function m_calificacion2($id_grupo, $id_materia, $id_alumno){
  $consulta="SELECT * FROM segundo_p WHERE id_grupo = $id_grupo AND id_materia = $id_materia AND id_alumno= $id_alumno";
  return completa($consulta);
}
function modifica_parcial2($calificacion, $id_grupo, $id_materia, $id_alumno, $id_parcial2){
  $consulta = "UPDATE segundo_p SET valor2 = $calificacion WHERE id_grupo = $id_grupo AND id_materia = $id_materia AND id_alumno= $id_alumno AND id_parcial2=$id_parcial2";
  completa($consulta);
}
function g_calificacion3($valor, $fecha, $id_materia, $id_alumno){
  $consulta = "INSERT INTO calificacion VALUES ('', '$valor', '$fecha', '$id_materia', '$id_alumno')";
  completa($consulta);
}
function modifica_calificacion($calificacion, $id_grupo, $id_materia, $id_alumno){
  $consulta = "UPDATE calificacion SET valor = $calificacion WHERE  id_materia = $id_materia AND id_alumno= $id_alumno";
  completa($consulta);
}
function revisa_c($id_grupo, $id_materia){
  $consulta="SELECT COUNT(valor1) as valor FROM primer_p WHERE id_grupo='$id_grupo' AND id_materia='$id_materia';";
  return completa($consulta);
}
function revisa_c2($id_grupo, $id_materia){
  $consulta="SELECT COUNT(valor2) as valor2 FROM segundo_p WHERE id_grupo='$id_grupo' AND id_materia='$id_materia'";
  return completa($consulta);
}
function r_asistencia($id_alumno,$id_grupo,$fecha_ac2,$id_materia){
  $consulta="SELECT COUNT(asistencia) as asistencia FROM `pase_lista` WHERE id_alumno ='$id_alumno' AND id_grupo='$id_grupo' AND fecha='$fecha_ac2' AND id_materia='$id_materia'";
  return completa($consulta);
}
function asistencia_a($id_alumno, $id_grupo, $id_materia, $semana, $anio){
  $consulta = "SELECT fecha, asistencia 
               FROM pase_lista 
               WHERE id_alumno='$id_alumno' 
               AND id_grupo='$id_grupo' 
               AND id_materia = '$id_materia'
               AND WEEK(fecha, 1) = '$semana'
               AND YEAR(fecha) = '$anio'";
  return completa($consulta);
}
function asistencia($id_alumno, $id_grupo, $fecha1 = null, $fecha2 = null) {
  $fecha_ac = date('Y-m-d'); 
  $fecha_4m = date('Y-m-d', strtotime('-4 months')); 

  $fecha_i = $fecha1 ? max($fecha1, $fecha_4m) : $fecha_4m;
  $fecha_f = $fecha2 ? min($fecha2, $fecha_ac) : $fecha_ac;
  
  $consulta = "SELECT COUNT(asistencia) as asistencia FROM pase_lista WHERE id_alumno = '$id_alumno' AND asistencia= '0'AND id_grupo = '$id_grupo' AND fecha BETWEEN '$fecha_i' AND ' $fecha_f'";

  return completa($consulta);
}

function retardo($id_alumno, $id_grupo, $fecha1 = null, $fecha2 = null) {
  $fecha_ac = date('Y-m-d'); 
  $fecha_4m = date('Y-m-d', strtotime('-4 months')); 

  $fecha_i = $fecha1 ? max($fecha1, $fecha_4m) : $fecha_4m;
  $fecha_f = $fecha2 ? min($fecha2, $fecha_ac) : $fecha_ac;
  
  $consulta = "SELECT COUNT(asistencia) as retardos FROM pase_lista WHERE id_alumno = '$id_alumno' AND asistencia= '0.5'AND id_grupo = '$id_grupo' AND fecha BETWEEN '$fecha_i' AND ' $fecha_f'";

  return completa($consulta);
}
function faltas($id_alumno, $id_grupo, $fecha1 = null, $fecha2 = null) {
  $fecha_ac = date('Y-m-d'); 
  $fecha_4m = date('Y-m-d', strtotime('-4 months')); 

  $fecha_i = $fecha1 ? max($fecha1, $fecha_4m) : $fecha_4m;
  $fecha_f = $fecha2 ? min($fecha2, $fecha_ac) : $fecha_ac;
  
  $consulta = "SELECT COUNT(asistencia) as faltas FROM pase_lista WHERE id_alumno = '$id_alumno' AND asistencia= '1'AND id_grupo = '$id_grupo' AND fecha BETWEEN '$fecha_i' AND ' $fecha_f'";

  return completa($consulta);
}

function asistencias_l($id_alumno, $fecha1 = null, $fecha2 = null) {
  $fecha_ac = date('Y-m-d'); 
  $fecha_4m = date('Y-m-d', strtotime('-4 months')); 

  $fecha_i = $fecha1 ? max($fecha1, $fecha_4m) : $fecha_4m;
  $fecha_f = $fecha2 ? min($fecha2, $fecha_ac) : $fecha_ac;
  
  $consulta = "SELECT COUNT(asistencia) as asistencia FROM pase_lista WHERE id_alumno = '$id_alumno' AND asistencia= '0' AND fecha BETWEEN '$fecha_i' AND ' $fecha_f'";

  return completa($consulta);
}

function faltas_l($id_alumno, $fecha1 = null, $fecha2 = null) {
  $fecha_ac = date('Y-m-d'); 
  $fecha_4m = date('Y-m-d', strtotime('-4 months')); 

  $fecha_i = $fecha1 ? max($fecha1, $fecha_4m) : $fecha_4m;
  $fecha_f = $fecha2 ? min($fecha2, $fecha_ac) : $fecha_ac;
  
  $consulta = "SELECT COUNT(asistencia) as faltas FROM pase_lista WHERE id_alumno = '$id_alumno' AND asistencia= '1' AND fecha BETWEEN '$fecha_i' AND ' $fecha_f'";

  return completa($consulta);
}
// verificar_calificacion_existente($id, $id_materia, $id_grupo){

// }