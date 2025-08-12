<?php

function conectar() {
    //$conexion = mysqli_connect("localhost", "root", "", "udim") or die("Conexion fallida;");
    $conexion=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("Conexion fallida;");
    return $conexion;
}

function completa($consulta) {
    $conexion = conectar();
    $datos = mysqli_query($conexion, $consulta);
    mysqli_close($conexion);
    return $datos;
}

function guardar_datos($nombre, $apellido_paterno, $apellido_materno, $correo, $contraseña) {
    $consulta = "INSERT INTO usuario (nombre, ap_pat, ap_mat, correo, usuario, clave) VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$correo', '$correo', '$contraseña')";
   completa($consulta);
}

function sesion_inicio($us, $pas) {
   $consulta="SELECT id_usuario, nombre, ap_pat,ap_mat FROM usuario WHERE correo= '$us' AND clave= '$pas'";
   return completa($consulta);
}
?>