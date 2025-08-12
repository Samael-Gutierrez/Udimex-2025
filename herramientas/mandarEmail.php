<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';

if ($_POST){
    $remisor = $_POST['remisor'];
    $asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];
    $destinatario = $_POST['destinatario'];
    $contacto = $_POST['contacto'];
    $id = $_POST['id'];
    
    switch($id){
        case 1:
            $correo = "direccion@udimex.net";
        break;
        
        case 2:
            $correo = "controlescolar@udimex.net";
        break;

        case 3: 
            $correo = "sistemas@udimex.net";
        break;
        
        case 4:
            $correo = "alondra@udimex.net";
        break;

        case 5:
            $correo = "miguel@udimex.net";
        break;
        
        case 6:
            $correo = "alvaro@udimex.net";
        break;

        default:
            $correo = "direccion@udimex.net";
        break;
    }
    
    $mensaje = "$remisor : $mensaje <br> Mi contacto es: $contacto";

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'web@udimex.net';
    $mail->Password = 'Udim1020#';
    $mail->setFrom('web@udimex.net', 'WebMaster');
    $mail->addAddress($correo , $destinatario);
    $mail->Subject = $asunto;
    // $mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body = $mensaje;

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'The email message was sent.';
    } 	
}

?>
