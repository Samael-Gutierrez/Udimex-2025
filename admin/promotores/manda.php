<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../../../vendor/autoload.php';

session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/promotor.php");
include("../../general/consultas/conta.php");

$ad='';
$prom=$_SESSION["ad_id"];

//Elimina la solicitud de retiro
if ($_GET){
	el_sol($_GET['val']);
	el_egreso($_GET['val']);
	$ad='#retiro';
}



//Guarda una solicitud de pago
if ($_POST){
	$ad='#retiro';
	$cant=$_POST['cantidad'];
	$bn=$_POST['banco'];
	$cta=$_POST['cta'];
    
    $mensaje= "El promotor ".$_SESSION["ad_nom"]." ".$_SESSION["ad_ap"]." ha solicitado el pago de comisión por la cantidad de $cant a la cuenta $cta que pertenece al banco $bn";



$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'web@udimex.net';
$mail->Password = 'Alftom2125@123';
$mail->setFrom('web@udimex.net', 'WebMaster');
$mail->addAddress('direccion@udimex.net', 'Ing. Alfredo');
$mail->Subject = 'Pago de Comisión';
$mail->msgHTML(file_get_contents('message.html'), __DIR__);
$mail->Body = $mensaje;
//$mail->addAttachment('test.txt');
if (!$mail->send()) {
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'The email message was sent.';
} 


	$id=g_egreso('Comisión Promotor',$cant,'',0);
	g_sol($prom,$id,$cta);

	$datos=b_banco($prom,$bn,$cta);
	$fila=mysqli_fetch_assoc($datos);

	if($fila['r']==0){
		g_banco($prom,$bn,$cta);
	}

	
}

header("location: ../promotores$ad");

?>
