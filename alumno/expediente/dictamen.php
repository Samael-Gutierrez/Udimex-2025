<?php
session_start();
include("../general/todos.php");
include("../consultas/expediente.php");
include("../consultas/paciente.php");
include("simbolos.php");
date_default_timezone_set("America/Mexico_City");

cabeza(0);

?>

	</head>
		<body>

<?php

if ($_GET['id']){
	$id=$_GET['id'];

	$datos=b_dictamen2($id);
	$fila=mysqli_fetch_assoc($datos);
	$dictamen=$fila['dictamen'];
	$exp=$fila['id_expediente'];
	$fe=explode ("-",$fila['fecha']);
	$dia=$fe[2];
	$anio=$fe[0];

	$mes=$fe[1];
	if ($mes=='01'){
		$mes='ENERO';
	}
	if ($mes=='02'){
		$mes='FEBRERO';
	}
	if ($mes=='03'){
		$mes='MARZO';
	}
	if ($mes=='04'){
		$mes='ABRIL';
	}
	if ($mes=='05'){
		$mes='MAYO';
	}
	if ($mes=='06'){
		$mes='JUNIO';
	}
	if ($mes=='07'){
		$mes='JULIO';
	}
	if ($mes=='08'){
		$mes='AGOSTO';
	}
	if ($mes=='09'){
		$mes='SEPTIEMBRE';
	}
	if ($mes=='10'){
		$mes='OCTUBRE';
	}
	if ($mes=='11'){
		$mes='NOVIEMBRE';
	}
	if ($mes=='12'){
		$mes='DICIEMBRE';
	}


	$datos=b_exp($exp);
	if($fila=mysqli_fetch_assoc($datos)){
		$edad=d_edad($fila['f_na']);


		$folio=$_SESSION['exp'];
		while(strlen($folio)<4){
			$folio="0".$folio;
		}

		if ($fila['sexo']==1){
			$sex="Hombre";
		}
		else{
			$sex="Mujer";
		}

		if ($fila['enmascarado']==1){
			$en="Si";
		}
		else{
			$en ="No";
		}

		$paciente=$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
		
				

	}

	dictamen($anio,$mes,$dia,$dictamen,$exp,$paciente,$sex,$edad);

}
else{
	header('Location: index.php');
}





function dictamen($anio,$mes,$dia,$dictamen,$exp,$paciente,$sex,$edad){

echo "<div style='margin:50px'>
	<center><table border='0'><tr>
		<td width='30%'><img src='../imagen/logo.png' width='200px'></td>
		<td valign='middle'>
	<div id='cot_tit'>DRA. ANGELINA GONZÁLEZ GONZÁLEZ</div>
	</tr><tr><td colspan='2'></td></tr></table>
	<hr>

	<div align='right'><font size='3px'><b>TOLUCA, ESTADO DE MÉXICO, A $dia DE $mes DE $anio.<br> Expediente: $exp</b><br><br></font></div>


	<div id='cot_sub'>
		D I C T A M E N &nbsp; &nbsp; M É D I C O<br>
	</div><br>

	<table border='1' width='90%'>
		<tr><td>Paciente: $paciente</td><td>Edad: $edad</td><td>Sexo: $sex</td><td><td></tr>
	</table><br>

	<div align='justify'>
		<font size='4px'>$dictamen <br><br><br></font>
	</div>




<center>
	<div style='position: absolute; top: 700; width:100%;'>
		<font size='4'>A T E N T A M E N T E<br><br><br>
		________________________________<br>
		DRA. ANGELINA GONZÁLEZ GONZÁLEZ<br>
		</font><hr>


		<font size='2' align='center' style='line-height: 1.2em;'>Emilio Carranza 111, Col. San Sebastián, Toluca, Estado de México, CP 50150<br> 
		Tels. 722 219 0762 &nbsp;  &nbsp;  &nbsp; e-mail semedag@prodigy.net.mx</font>
	</div>
</center>







<div id='segunda' style='position: absolute; top: 1050; width:100%;'
<center><table border='0'><tr>
		<td width='30%'><img src='../imagen/logo.png' width='200px'></td>
		<td valign='middle'>
			<div id='cot_tit'>DRA. ANGELINA GONZÁLEZ GONZÁLEZ</div>
		</td>
	</tr></table>
	<hr>
	<table border='1' width='90%'>
		<tr><td>Paciente: $paciente</td><td>Edad: $edad</td><td>Sexo: $sex</td><td><td></tr>
	</table><br>

<div>EXAMEN AUDIOMÉTRICO<br>



<div id='oderecho'>
	Oido Derecho<br>
	<canvas id='der' width='280' height='270'></canvas>";
	lineas('der');

	$datos=b_aud($_SESSION['exp'],1);

	while($fila=mysqli_fetch_assoc($datos)){
		unset($yi);

		$color="#ff0000";

		echo "<script>
		var c = document.getElementById('der');
		var ctx = c.getContext('2d');
		ctx.strokeStyle= '$color';";

		$x=25;
		for($i=1;$i<=11;$i++){

			$sn=0;

			$v=($fila['valor'.$i] + 30)*2;			

			echo "ctx.beginPath();
			ctx.fillStyle = '$color';";

			
			if ($fila['te']==1){				//*** VIA AEREA ***//
				if ($fila['enm']==0){				// SIN ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(1,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(2,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				} 
				else{						// CON ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(3,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(4,$x,$v);		//Sin umbral
						//echo $simbolo;
					}
				}
				echo $simbolo;
				$tl=1;							//Línea continua
			}



			if ($fila['te']==2){				//*** VIA ÓSEA ***//
				if ($fila['enm']==0){				// SIN ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(5,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(6,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				} 
				else{						// CON ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(7,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(8,$x,$v);		//Sin umbral
						//echo $simbolo;
					}
				}
				echo $simbolo;
				$tl=2;							//Línea punteada
			}

			if ($fila['te']==3){				//*** Umbral de diconfort ***//
				//if ($fila['enm']==0){				// SIN ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(9,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(10,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				//} 
				echo $simbolo;
				$tl=1;							//Línea punteada
			}

		
			if ($fila['valor'.$i]!=-100 ){
				if (!isset($yi)){
					$xi=$x;
					$yi=$v;
				}

				linea($xi,$yi,$x,$v,$tl);
				

				$xi=$x;
				$yi=$v;


			}

			$pos=$x-3;
			if ($fila['valor'.$i]<0){
				$pos=$x-11;
			}
			if ($fila['valor'.$i]>9){
				$pos=$x-7;
			}

			if ($fila['valor'.$i]>99){
				$pos=$x-11;
			}

			

			$ad=20;
			if ($i<3){
				$ad=40;
			}
			$x=$x+$ad;

		
		}
		echo "</script>";		
	}
echo "</div>";

echo "<div id='oizquierdo'>Oido izquierdo<br><canvas id='iz' width='280' height='270'></canvas>";
lineas('iz');

$datos=b_aud($_SESSION['exp'],2);

while($fila=mysqli_fetch_assoc($datos)){
	unset($yi);

	$color=$color="#0000ff";;

	echo "<script>
	var c = document.getElementById('iz');
	var ctx = c.getContext('2d');
	ctx.strokeStyle= '$color';";

	$x=25;
	for($i=1;$i<=11;$i++){
		$v=($fila['valor'.$i] + 30)*2;

		echo "
		ctx.beginPath();
		ctx.fillStyle = '$color';";

		if ($fila['te']==1){				//*** VIA AEREA ***//
			if ($fila['enm']==0){				// SIN ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(11,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(12,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			} 
			else{						// CON ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(13,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(14,$x,$v);		//Sin umbral
					//echo $simbolo;
				}
			}
			echo $simbolo;
			$tl=1;							//Línea continua
		}



		if ($fila['te']==2){				//*** VIA ÓSEA ***//
			if ($fila['enm']==0){				// SIN ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(15,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(16,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			} 
			else{						// CON ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(17,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(18,$x,$v);		//Sin umbral
					//echo $simbolo;
				}
			}
			echo $simbolo;
			$tl=2;							//Línea punteada
		}

		if ($fila['te']==3){				//*** Umbral de diconfort ***//
			//if ($fila['enm']==0){				// SIN ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(19,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(20,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			//} 
			
			echo $simbolo;
			$tl=1;							//Línea punteada
		}


		

		
		if ($fila['valor'.$i]!=-100){
			if (!isset($yi)){
				$xi=$x;
				$yi=$v;
			}
			linea($xi,$yi,$x,$v,$tl);

			$xi=$x;
			$yi=$v;
		}

		$pos=$x-3;
		if ($fila['valor'.$i]<0){
			$pos=$x-11;
		}
		if ($fila['valor'.$i]>9){
			$pos=$x-7;
		}

		if ($fila['valor'.$i]>99){
			$pos=$x-11;
		}

		

		$ad=20;
		if ($i<3){
			$ad=40;
		}
		$x=$x+$ad;
		

	}

echo "</script>";
}

echo "</div>



<br><br><br>SIMBOLOGÍA<br>
<img src='../imagen/simbolos.png' width='300px'>
</div>

</div>

<center>
	<div style='position: absolute; top: 2000; width:100%;'>
		<hr>


		<font size='2' align='center' style='line-height: 1.2em;'>Emilio Carranza 111, Col. San Sebastián, Toluca, Estado de México, CP 50150<br> 
		Tels. 722 219 0762 &nbsp;  &nbsp;  &nbsp; e-mail semedag@prodigy.net.mx</font>
	</div>
</center>






";
}







?>


</body>
</html>








