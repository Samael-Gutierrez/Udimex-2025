<?php
    include('../../general/consultas/basic.php');
    include('../../general/consultas/repaso.php');
    
    $datos=busca_solicitud();
    $fila=mysqli_fetch_assoc($datos);
    
    if($fila['r']>0){
        echo $fila['r'];
    }
    else{
        echo 0;
    }
?>