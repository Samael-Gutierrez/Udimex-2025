<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/pagos.php");
include("../../general/consultas/certificados.php");
require "../../general/qr/qrlib.php"; 

// Busca el dia de primer mensualidad de alumno
$diaPago = getDatePay($_POST['alumno']);
// Obtiene los días que pago
$diasPagados = diasPagados($_POST['apagar'], $_POST['total_apagar']);

//Variables
$fechaPago=date('Y-m-d');
$concepto = $_POST['concepto'];

while($fila = mysqli_fetch_assoc($diaPago)){
	$diaPagoAlumno = $fila['f_pago'];
	if($diaPagoAlumno == "0000-00-00"){
		$diaPagoAlumno = $fechaPago;
	}
	$diaPagoAlumno = date($diaPagoAlumno);
}

switch($concepto) {
	case "Colegiatura":
		$fechaCaducidad = date("Y-m-d",strtotime($diaPagoAlumno . "+ " . $diasPagados . " days"));
		break;

	case "Inscripción":
		$fechaCaducidad = $diaPagoAlumno;
		break;
		
	default:
		$fechaCaducidad = date("Y-m-d",strtotime($fechaPago . "+ 30 days"));
		break;
}

// Guarda el pago
$pagoGuardado = g_pago($_POST['alumno'],$_POST['apagar'],$_POST['concepto'], $fechaPago, $fechaCaducidad);

// Actualiza fecha de pago
if($_POST['nfp']!=0){
	a_fp($fechaCaducidad, $_POST['alumno']);
}

//manejo de QR
$dir = '../../general/imagen/QRS/';
if (!file_exists($dir))
mkdir($dir);
$filename = $dir.$pagoGuardado.'.png';
$tamanio = 10; //Tamaño de Pixel
$level = 'Q'; //Precisión Baja
$framSize = 3; //Tamaño en blanco
$datoQR=base64_encode ($pagoGuardado.$_POST['alumno'].$fechaPago);
$contenido = "http://udimex.net/alumno/pagos_recibo.php?id=".$datoQR;
QRcode::png($contenido, $filename, $level, $tamanio, $framSize); 
//Fin de QR

//Si el concepto de pago es certificado, verifica que ya esté en seguimiento, sino agregar
if($_POST['concepto']=="Certificado"){
	$datos=busca_seguimiento($_POST['alumno']);
	if(!($fila=mysqli_fetch_assoc($datos))){
		guarda_seguimiento($_POST['alumno'],1,"");
	}
}

//Mandar recibo de pago por whatsapp
header('location:index.php');

?>