<?php
//include("../general/consultas/basic.php");
//include("../general/consultas/chat.php");
function respuesta($pregunta){
	$control=1;
	$pregunta=strtoupper($pregunta);
	if ($pregunta=="OK"){
		$pregunta=="SI";
	}
	if ($pregunta=="SI"){
		$control=0;
		$pregunta=$_SESSION['si'];
	}
	if ($pregunta=="NO"){
		$control=0;
		$pregunta=$_SESSION['no'];
	}
	echo $pregunta;
	if ($control>0){
		$palabras=explode(" ",$pregunta);
		$patron="";
		$pregunta=0;
		for($i=0;$i<count($palabras);$i++){
		
			$datos=bot_palabras($palabras[$i]);
			if($fila=mysqli_fetch_assoc($datos)){
				$patron=$patron." ".$palabras[$i];
				if($fila['pregunta']>$pregunta){
					$pregunta=$fila['pregunta'];
				}
			}
		}
		echo $patron;
		if($patron==""){
			$pregunta=1000;
		}
	}

	return $pregunta;

}


?>

