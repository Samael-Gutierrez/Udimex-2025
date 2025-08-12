<?php
include("../db/basica.php");
include("../db/usuario.php");
include("../db/alumno.php");
include("../db/pagos.php");
include("../db/notificacion.php");

$correo=trim($_POST['correo']);
$clave=trim($_POST['clave']);
$nombre=trim($_POST['nombre']);
$ap=trim($_POST['ap']);
$am=trim($_POST['am']);
$tel=trim($_POST['tel']);
$curp=trim($_POST['curp']);
$mod=$_POST['mod'];

$car=str_split($curp);
$fn=$car[4].$car[5]."-".$car[6].$car[7]."-".$car[8].$car[9];

$fdi=date('Y-m-d');
$dia=$fdi;
if($mod=="22"){
	$linea=$_POST['linea'];
	$dia=$_POST['dia'];
}


$fdp=date($dia,strtotime($dia. "+ 20 days")); 
$id=guarda_usuario($correo,$clave,$nombre,$ap,$am,$fn,$correo);
g_tel($tel,$id);
guarda_alumno($id,1,1,8000,1,$fdi,$fdp,$linea,$mod,483,48);
guarda_curp($id,$curp);

guarda_examen($id,$linea,$dia);

g_pago($id,0,"Examen único",$fdi, $fdp);

if($tel!=""){
    $tel=", puedes comunicarte al telefono <a href=\"https://wa.me/$tel\" target=\"_blank\">$tel</a>";
}
else{
   if($correo!=""){
       $correo=", puedes comunicarte al por correo a $correo";
   }
}

$mensaje="Se ha registrado un nuevo alumno para examen 286: $nombre $ap $am $tel para el día $dia";
$id_mensaje=guarda_notificacion($mensaje);

//Busca todos los usuarios que tengan habilitadoas funciones de Inscripcion (20)
$datos=usuario_app(20);
while($fila=mysqli_fetch_assoc($datos)){
    //Relaciiona mensaje con destinatarios
    $id=$fila['id_usuario'];
	guarda_destinatario($id_mensaje,$id);
}


?>
