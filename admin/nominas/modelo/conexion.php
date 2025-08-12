<?php
// $conexion = new mysqli("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
//conexion a la base de datos
function completa($consulta){
    $conexion = mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex");
    $sql = mysqli_query($conexion,$consulta);
    mysqli_close($conexion);
    return $sql;
}
//buscar datos en la base de datos
function completa2($consulta){
    $conexion = mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex");
    $sql = mysqli_query($conexion,$consulta);
    $sql= mysqli_insert_id($conexion);
    mysqli_close($conexion);
    return $sql;
}
//SELECCIONAR USUARIO
function busca_empleado(){
    $consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario=u.id_usuario";
    return completa($consulta);
}

function busca_id_empleado($id){
    $consulta="SELECT * FROM usuario as u, area as a where u.id_area=a.id_area and u.id_usuario=$id";
    return completa($consulta);
}

function busca_nomina($usuario, $periodo, $anio){
    $consulta = "SELECT COUNT(id_nominas) AS total FROM nominas WHERE id_usuario = $usuario AND periodo = '$periodo' AND anio = '$anio'";
    return completa($consulta);
}

function crear_nomina($usuario, $periodo, $anio){
    $consulta = "INSERT INTO nominas VALUES('', $usuario, '$periodo', '$anio', 0)";
    completa($consulta);
}

function cambia_estado($usuario, $periodo, $anio){
    $consulta = "UPDATE nominas SET estado = 1 WHERE id_usuario = $usuario AND periodo = '$periodo' AND anio = '$anio'";
    return completa($consulta);
}

function estado_nomina($usuario, $periodo, $anio){
    $consulta = "SELECT COUNT(id_nominas) AS todas FROM nominas WHERE id_usuario = $usuario AND periodo = '$periodo' AND anio = '$anio' AND estado = 1"; 
    return completa($consulta);
}

//PERCEPCIONES
function buscar_percepcion(){
    $consulta = "select * from percepcion";
    return completa($consulta);
}
//buscar concepto
function buscar_percepcion2($concepto){
    $consulta = "select * from percepcion where concepto='$concepto'";
    return completa($consulta);
}
//Obtener los datos  y registrar en la tabla 
function busca_percepcion_usuario($id,$idp){
    $consulta = "SELECT horas,periodo,concepto,cantidad,id_percepcion_us
from percepcion_usuario as pu, percepcion as p
where pu.id_percepcion=p.id_percepcion
and pu.id_usuario=$id
and pu.periodo='$idp'";
//echo $consulta; 
return completa ($consulta);
}
//eliminar percepcion
function elimina_percepcion($id){
    $consulta= "delete from percepcion_usuario where id_percepcion_us=$id";
 completa ($consulta);
}
function guarda_percepcion($concepto){
    $consulta = "insert into percepcion values('','$concepto')";
    return completa2($consulta);
}
function guarda_percepcion_usuario($id_us,$concepto,$horas,$idp,$cantidad){
    $consulta = "insert into percepcion_usuario values('',$id_us,$concepto,$horas,'$idp',$cantidad)";
   // echo $consulta;
    return completa($consulta);
}

//AGREGAR A LA BD EGRESO
function guarda_egreso($concepto,$cantidad,$fecha,$estado){
    $consulta="insert into conta_egreso  values('','$concepto','$cantidad','$fecha','$estado')";
	completa($consulta);
}

//DEDUCCION
function buscar_deduccion(){
    $consulta = "select * from deduccion";
    return completa($consulta);
}
//Buscar concepto
function buscar_deduccion2($concepto){
    $consulta = "select * from deduccion where concepto='$concepto'";
    return completa($consulta);
}
//Obtener los datos y registrar  en la tabla
function busca_deduccion_usuario($id,$idp){
    $consulta="SELECT id_deduccion_us,concepto,cantidad
    from deduccion_usuario as du, deduccion as d
    where du.id_deduccion= d.id_deduccion
    and du.id_usuario=$id
    and du.periodo='$idp'";
    return completa ($consulta);
}
//Elimina deduccion
function elimina_deduccion($id){
    $consulta= "delete from deduccion_usuario where id_deduccion_us=$id";
completa ($consulta);
}
function guarda_deduccion($concepto){
$consulta= "insert into deduccion (concepto) values('$concepto')";
return completa2($consulta);
}
function guarda_deduccion_usuario($id_us,$concepto,$idp,$cantidad){
$consulta= "insert into deduccion_usuario values ('',$id_us,'$idp',$concepto,$cantidad)";
//echo $consulta;
return completa($consulta);
}

?>





