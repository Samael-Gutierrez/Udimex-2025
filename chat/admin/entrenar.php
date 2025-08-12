<?php
include('../consultas/basic.php');
include('../consultas/chat.php');

$dato=b_falta_res();
while($fila=mysqli_fetch_assoc($dato)){
	$dato2=b_respuestas($fila['siguiente']);
	if($fila2=mysqli_fetch_assoc($dato2)){
		echo "con respuesats<br>";
	}
	else{
		echo "SIN respuesats<br>";
		$dato3=bot_pregunta($fila2['id_pregunta']);
		if($fila3=mysqli_fetch_assoc($dato3)){
			echo $fila3['pregunta'];
		}
		
	}
}

?>
