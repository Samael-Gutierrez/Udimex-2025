<?php
session_start();
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/examenes.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {

        $nombre = $_POST['name'];
        $apellido_paterno = $_POST['ap_paterno'];
        $apellido_materno = $_POST['ap_materno'];
        $correo = $_POST['email'];
        $contraseña = $_POST['password'];

        guardar_datos($nombre, $apellido_paterno, $apellido_materno, $correo, $contraseña);

        if (mysqli_affected_rows(abrir()) > 0) {
            $_SESSION['mensaje'] = "Usuario creado correctamente";
        } else {
            $_SESSION['mensaje'] = "Error al crear el usuario";
        }

        header('Location: index.php');
        exit();
    }

    if (isset($_POST['login'])) {
        echo "a";
        $us = $_POST['email'];
        $pas = $_POST['password'];
        $_SESSION["ad_id"] = 0;

        $datos = sesion_inicio($us, $pas);
        if ($datos) {
            $fila = mysqli_fetch_assoc($datos);
            $_SESSION["ad_id"] = $fila["id_usuario"];
            $_SESSION["ad_nom"] = $fila["nombre"];
            $_SESSION["ad_ap"] = $fila["ap_pat"];

            if ($_SESSION["ad_id"] > 0) {
                echo '<script type="text/javascript"> window.location="Examenes.php"; </script>';
            } else {
                $_SESSION['mensaje'] = "Error de acceso, intenta de nuevo";
                echo '<script type="text/javascript"> window.location="index.php?error=1"; </script>';
            }
        } else {
            $_SESSION['mensaje'] = "Error de acceso, intenta de nuevo";
            echo '<script type="text/javascript"> window.location="index.php?error=1"; </script>';

        }
    }
}
?>