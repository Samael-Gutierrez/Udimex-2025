
<!DOCTYPE html>
<link rel="stylesheet" href="estilo.css">
<div class="borde11"><div class="page">	
<body>
<?php
session_start();

$dir = "../general/";

include($dir."db/pagos.php");
include($dir."db/basica.php");
include($dir."db/publicidad.php");
include($dir."php/alumno.php");

include("letras.php");

carga_estilo('../');
echo "
	<meta name='description' content='Es una plataforma educativa que te permite estudiar tu Preparatoria en línea con reconocimiento oficial de la SEP mediante CENEVAL (acuerdo 286) o Prepa Abierta'>
	<link rel='stylesheet' href='../general/estilo/recibo.css'>
</head>
<body onload=\"cambia('m1');\">";

if ($_GET){
	$idPago = $_GET['pago'];
	$datos=b_p64($_GET['id']);

	if ($fila=mysqli_fetch_assoc($datos)){
		$id_usuario= $fila['id_usuario'];
		$letras =NumeroALetras::convertir($fila['cantidad'], 'pesos', 'centavos');
		$fe=explode("-",$fila['f_pago']);


		$search  = array('01', '02', '03', '04', '05','06', '07', '08', '09', '10', '11', '12',);
		$replace = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio','agosto','septiembre','octubre','noviembre','diciembre');
		$mes=str_replace($search, $replace, $fe[1]);

		$filename = "../general/imagen/QRS/".$fila['id_pago'].".png";
		$qr="<img src='".$filename."' align='right' width='18%'>";

		$counter=0;
		$totalesAntesPago = totalesAntesPago($id_usuario,$idPago);
		while($totales = mysqli_fetch_assoc($totalesAntesPago)){
			$counter = $totales['totales'];
		}

		if($counter>1){
			$fechas = getDatesRang($id_usuario, $idPago);
			$fechasSinNormalizar = "";
			while($fecha = mysqli_fetch_assoc($fechas)){
				$fechasSinNormalizar = $fechasSinNormalizar . $fecha['f_caducidad'] . " ";
			}
			$cutter = explode(' ', $fechasSinNormalizar);
			$fechas_finales = normalizarFecha($cutter[1], $cutter[0]);
		}elseif($counter<=1){
			$fechas = getADate($idPago);
			while($fecha = mysqli_fetch_assoc($fechas)){
				$fechas_finales = normalizarFecha($fecha['f_pago'],$fecha['f_caducidad']);
			}
		}

		if (strlen($fila['id_pago'])==1){
			$fol="0000".$fila['id_pago'];
		}
		if (strlen($fila['id_pago'])==2){
			$fol="000".$fila['id_pago'];
		}
		if (strlen($fila['id_pago'])==3){
			$fol="00".$fila['id_pago'];
		}
		if (strlen($fila['id_pago'])==4){
			$fol="0".$fila['id_pago'];
		}
		
		echo "
			<center>
				<div class='recibo'><img src='../general/imagen/logo.png' width='70%'>
					<div class='borde2 fondo_rojo linea4'></div><br>
					<div class='borde1 fondo_azul '></div><br>
					<div id='titulo'><b>RECIBO DE PAGO</b></div>
					<div align='right'><b>N° de folio: ".$fol."</b></div><br>
					<div align='justify'> 
						Recibí de <b><u>".$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']. "</u></b> 
						la cantidad de <b><u>$ ".$fila['cantidad'].".00 ($letras m.n.)</u></b> 
						por concepto de <b><u>".$fila['concepto']."</u></b> 
						con el día de pago del ".$fe['2']." de ".$mes." de ".$fe['0'].".";

		if ($fila['concepto'] == 'Colegiatura'){
			echo "
						Correspodiente al periodo del  " . $fechas_finales . ".
			";
		}
						
		echo "
					</div>
					<br><br>$qr<br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src='../general/imagen/firma.png' width='30%'><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________________________<br><b><br>
					Dirección General</b><br><b>Ing.Alfredo Tomas Dorado</b>
				</div>
				____________________________________________________________________________
			</center>
		";

		

	}
}

echo "
	<table align='center' width='100%'>
	<p><h2> <font color='#ff1100'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conoce más de nuestros servicios!</font></h2></p>
	<tr>
";

echo "
	<td>&nbsp;&nbsp;&nbsp;<img class='mar ul' width='210px'   src='../general/imagen/publicidad-r/administracion.png'></td>
";

echo "
	<td>&nbsp;&nbsp;&nbsp;<img class='mar ul' width='210px'   src='../general/imagen/publicidad-r/industrial.png'></td>
";

echo "
	<td>&nbsp;&nbsp;&nbsp;<img class='mar ul' width='210px'   src='../general/imagen/publicidad-r/pedagogia.png'></td>
";

echo "</tr></table>";
?>
	</body></div></div>
</html>


