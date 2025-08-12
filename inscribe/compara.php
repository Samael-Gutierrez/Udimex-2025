
<?php

include("../general/consultas/usuario.php");
include("../general/consultas/basic.php");
$usuario=$_POST["usuario"];
$datos=b_us2($usuario);
if($fila=mysqli_fetch_assoc($datos)){
    $res=0;
    if($fila['r']>0){
        $res=1;
    }
}

echo $res;


?>

