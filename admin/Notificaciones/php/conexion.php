<?php
    function completa($consulta){
        $base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
        $datos=mysqli_query($base, $consulta);
        mysqli_close($base);
        return $datos;
    }
    

    function completa2($consulta){
        $base=mysqli_connect("localhost","u964553819_udimex","Sistemas_udimex24","u964553819_udimex") or die("No está lista la conexión 2024");
        $datos=mysqli_query($base, $consulta);
        $r=mysqli_insert_id($base);
        mysqli_close($base);
        return $r;
    }
    
    function cuenta_mensajes($id){
        $consulta="SELECT count(id_destinatario) as r from destinatario where id_usuario=$id and estados=0";
        return completa($consulta);
    }
    function busca_mensajes($id){
        $consulta="SELECT * FROM destinatario as d, datos as m, usuario as u
        WHERE d.id_datos=m.id 
        and d.id_usuario=$id
        and d.estados=0
        and m.autor=u.id_usuario";
        return completa($consulta);
    }
    function busca_admin($id){
        $consulta="SELECT count(id_acceso) as r FROM acceso WHERE id_usuario=$id";
        return completa($consulta);
    }
    function cambio_de_estado($id){
        $consulta="UPDATE destinatario SET estados=1 WHERE id_destinatario=$id";
        echo $consulta;
        return completa($consulta);
    }
    function envia_mensaje($id , $mensaje, $destinatario){
        $consulta="INSERT INTO datos (autor,mensaje) VALUES('" . $id . "','" . $mensaje . "')";
        return completa2($consulta);
    }
    function destinatarios($id , $mensaje){
        $consulta="INSERT INTO destinatario (id_datos,id_usuario) VALUES('" . $id . "','" . $mensaje . "')";
        return completa ($consulta);
    }
    function busca_empleado($id){
        $consulta="SELECT DISTINCT(a.id_usuario), u.* FROM acceso as a, usuario as u WHERE a.id_usuario=u.id_usuario";
        return completa($consulta);
    }
    
?>