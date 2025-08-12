<?php
    include("../general/consultas/basic.php");
    include("../general/consultas/materias.php");
    
    $datos=exporta_material();
    
    $consulta="insert into material values";
    while($fila=mysqli_fetch_assoc($datos)){
        $consulta=$consulta."(".$fila['id_material'].",'".$fila['subtitulo']."','',".$fila['id_tema']."),";
    }
    echo $consulta;
?>