
<?php

include("../../general/consultas/usuario.php");
include("../../general/consultas/basic.php");
$usuario=$_POST["usuario"];
$datos=b_us2($usuario);
if($fila=mysqli_fetch_assoc($datos)){
    
    $r='';
    

    
    if($fila['r']>0){
        $r='usuario existente intente con otro ';
    }
    if($fila['r']==0){
        $r='selecciona "aceptar" ';
    }
    
    echo $r;
}




?>

