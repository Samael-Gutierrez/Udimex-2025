<?php
include("consultas/basic.php");
include("consultas/chat.php");

echo "Hola";

$datos=b_falta_res();
while($fila=mysqli_fetch_assoc($datos)){
	echo $fila['id_pregunta'];
}

?>
