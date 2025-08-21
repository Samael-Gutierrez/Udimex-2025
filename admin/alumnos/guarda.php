<?php

$dir = "../../general/";
include($dir."db/admin.php");
include($dir."db/basica.php");
include($dir."db/usuario.php");
include($dir."db/alumno.php");


 //Datos para tabla de usuario
$usuario=$_POST["user"];
$clave=$_POST["clave"];
$nom=$_POST["nombre"];
$apepa=$_POST["ap"];
$apema=$_POST["am"];
$curp2=strtoupper($_POST["curp"]);
$correoele=$_POST["ce"];

// Datos del tutor
$nombredepadre=$_POST["ndpot"];
$appa=$_POST["appa"];
$appma=$_POST["apom"];
$cee=$_POST["cee"];

// Datos para tabla de alumno
$ins=$_POST["i"];
$cm=$_POST["cm"];
$cer=$_POST["cer"];
$fdp=$_POST["fdp"];
$carrera=$_POST["carrera"];
$promotor=$_POST["prom"];
$mo=$_POST["mo"];
$fdii=$_POST["fdii"];
$f_examen=$_POST["f_examen"];

$anio=date('y');
$fechaden=str_split($curp2);
$a_nac=intval($fechaden[4].$fechaden[5]);
if($a_nac<$anio){
	$a_nac=$a_nac+2000;
}
else{
	$a_nac=$a_nac+1900;
}
$fechaden=$a_nac."-".$fechaden[6].$fechaden[7]."-".$fechaden[8].$fechaden[9];

 //Datos para tabla de domicilio tabla borrada
 /*
$esdo=$_POST["edo"];
$muni=$_POST["mun"];
$colo=$_POST["col"];
$cp=$_POST["copo"];
$calle=$_POST["enca"];
$numer=$_POST["nume"];
*/
//datos para la tabla de telefono
$telefonoa=$_POST["telef"];
$telefonop=$_POST["telefono"];
//datos para la tabla de documentos

$curp=$_POST["cr"];
$actdn=$_POST["c"];
$cde=$_POST["gr"];
$cdugde=$_POST["gl"];
$cdp=$_POST["df"];
$cddo=$_POST["dk"];

if (isset($_POST['grupo']) && $_POST['grupo'] !== '') {
    $grupo = $_POST['grupo'];
}else{
	$grupo = 0;
}

$id=guarda_usuario($usuario,$clave,$nom,$apepa,$apema,$fechaden,$correoele);
$edo=1;

guarda_alumno($id,$ins,$cm,$cer,$edo,$fdii,$fdp,$mo,$carrera,$promotor,$grupo);
/*guarda_alumno($id,$ins,$cm,$fdii,$fdp,$mo,$carrera,$promotor);*/

//Guarda el curp del alumno
guarda_curp($id,$curp2);

//Guarda fecha de aplicación de examen
guarda_examen($id,$mo,$f_examen);

/*guarda_domicilio($id,$esdo,$muni,$colo,$cp,$calle,$numer);*/

if (strlen($telefonoa)>0){
	g_tel($telefonoa,$id);
}

if (strlen($nombredepadre)>0){
	$idt=guarda_usuario($usdepadre ,'',$nombredepadre,$appa,$appma,'',$cee);
	//guarda_telefono($telefonop,$idt);
	//relacion alumno_tutor
	guarda_alumno_tutor($id,$idt);
}

if (strlen($telefonop)>0){
	g_tel($telefonop,$idt);
}

guarda_documentos($id,"Curp",$curp);
guarda_documentos($id,"Acta de nacimiento",$actdn);
guarda_documentos($id,"Credencial de elector",$cde);
guarda_documentos($id,"Certificacion de estudios",$cdugde);
guarda_documentos($id,"Credencial de elector del tutor",$cdp);
guarda_documentos($id,"Comprobante de domicilio",$cddo);

header('Location: formato.php?id='.$id);
?>


