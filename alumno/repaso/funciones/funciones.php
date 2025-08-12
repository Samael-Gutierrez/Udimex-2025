<?php
function conexion(){
    $base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
    //$base= mysqli_connect('localhost','root', '', 'udim');
    if (!$base) {
        die('Error de conexión: ' . mysqli_connect_error());
    }return $base;
}

function ejecucion_consulta($consulta){
    $base=conexion();
    $ejecucion=mysqli_query($base,$consulta);
    return $ejecucion;
    mysqli_close($base);
}

function materias(){
    $consulta="SELECT id_materia, nombre FROM materia";
    return ejecucion_consulta($consulta);
}

function filtrado(){
    $consulta = "SELECT C.id_pregunta, pregunta FROM respuesta_alumno as ra,
     respuesta as r,cuestionario as c WHERE ra.id_alumno= 157 AND ra.id_materia=1144 
     AND ra.id_respuesta=r.id_respuesta AND r.tipo=0 AND ra.id_pregunta=c.id_pregunta";
    return ejecucion_consulta($consulta);
}

function preguntas(){
    $consulta="SELECT pregunta FROM pregunta_repaso WHERE estado = 0";
    return ejecucion_consulta($consulta);
}

function chat($id_repaso){
    $consulta = "SELECT preguntas FROM respuestaschatgpt where id_repaso=$id_repaso";
    return ejecucion_consulta($consulta);
}

function estado($id_repaso){
    $consulta = "SELECT id_pregunta, id_pregunta ,pregunta FROM preguntas_repaso WHERE estado = 0 AND id_repaso=$id_repaso";
    return ejecucion_consulta($consulta);
}

function ids($id,$mat){
    $consulta = "SELECT c.id_pregunta, c.pregunta FROM respuesta_alumno as ra, respuesta as r,cuestionario as c WHERE ra.id_alumno=$id AND ra.id_materia=$mat AND ra.id_respuesta=r.id_respuesta AND r.tipo=0 AND ra.id_pregunta=c.id_pregunta;";
    return ejecucion_consulta($consulta);
}

function busca_repaso(){
    $consulta="select * from repaso where estado=0 order by id_alumno";
    return ejecucion_consulta($consulta);
}

function estado_solicitud($id,$mat){
    $consulta="update repaso set estado=1 where id_alumno=$id and id_materia=$mat";
    ejecucion_consulta($consulta);
}

function estado_solicitud2($id_repaso){
     $consulta="update repaso set estado=1 where id_repaso=$id_repaso";
    ejecucion_consulta($consulta);
}
    
    
function checar_estado($id_repaso){
        $consulta="select * from repaso where id_repaso=$id_repaso";
        return ejecucion_consulta($consulta);

}

?>