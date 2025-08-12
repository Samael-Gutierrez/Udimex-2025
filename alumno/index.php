<?php
	session_start();
	$dir="../general/";
	include($dir."php/alumno.php");
	include($dir."db/basica.php");
	include($dir."db/pagos.php");
	include($dir."db/materias.php");
	
	$adicional="
	<link rel='stylesheet' href='assets-index/style.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>";
	
	cabeza("Materias - Udimex",$adicional,$dir);

	if(isset($_GET['m'])){
    		echo "<script>alert('Ya contestaste el examen, no se permite otro intento.')</script>";
	}

	permiso();
	menu($dir);

	
	$al=$_SESSION["g_id"];

	//Selecciona la fecha máxima de caducidad
	$datos=b_cad($al);
	$fila=mysqli_fetch_assoc($datos);
	if($fila['cad']>date('Y-m-d')){
		$datos2=horario($al);
		$i=0;
		$mat="";
		while($fila2=mysqli_fetch_assoc($datos2)){
			if ($i==0){
				echo "
				<br><center>";
			}
		
			$i=$i+1;
			
			$fc=fecha_texto($fila['cad']);

			$mat=$mat."
				<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px;' align='left'>
	    				<header class='w3-container fondo_azul_oficial' align='center' style='height:100px;'>
	     					<h3>".$fila2['nombre']."</h3>
					</header>
					<div class='w3-container' width='138px'>

	      					
						<div align='center'>
							<img src='../general/imagen/".$fila2['tipo'].".png' width='138px' height='96px'>
						</div>
						<hr>
						<p class='amarillo_oficial' align='center'><img src='../general/imagen/reloj.png'> 
							Activa hasta:<br>".$fc."
						</p>
					</div>
					<div class='w3-padding w3-block fondo_rojo_oficial' align='center'>
						<a href='materia_indice.php?mat=".$fila2['id']."'><h3>Entrar</h3></a>
					</div>
				</div>";
		}

		echo $mat;
	}
	else{
		$datos = fechasPago($al);
		if($fila = mysqli_fetch_assoc($datos)){
			$colegiatura = $fila['colegiatura'];
			$caducidad = $fila['caducidad'];
			$hoy = date('Y-m-d');
			$recargos1 = date('Y-m-d', strtotime($caducidad . "+ 5 days"));
			$recargos2 = date('Y-m-d', strtotime($caducidad . "+ 10 days"));
			$totalPagar = 0;

			if($hoy>$recargos1 && $hoy<$recargos2){
				$totalPagar = $colegiatura + ($colegiatura * 0.1);
				$mensaje = "<span>Por motivo de atraso mayor a 5 días, la colegiatura lleva sobre cargo del 10%</span>";
			}
			
			if($hoy>$recargos2){
				$totalPagar = $colegiatura + ($colegiatura * 0.2);
				$mensaje = "<span>Por motivo de atraso mayor a 10 días, la colegiatura lleva sobre cargo del 20%</span>";
			}

			if($hoy<$recargos1){
				$totalPagar = $colegiatura;
				$fecha = ordenFecha($recargos1);
				$mensaje = "<span>Le sugerimos pagar antes del $fecha para evitar recargos.</span>";
			}

			echo "
			<div class='main-container'>
				<div class='part1'>
					<h3 class='separacion'>Métodos de pago oficiales</h3>
					<img src='../general/imagen/LogoBanCoppel.svg' alt='BanCoppel' style='width:35%'>
					<table>
						<tr>
							<td>Titular:</td>
							<td>Alfredo Tomás Dorado Flores</td>
						</tr>
						<tr>
							<td>CLABE:</td>
							<td>1374 2010 4212 4575 02</td>
						</tr>
						<tr>
							<td>Tarjeta:</td>
							<td>4169 1614 0028 9426</td>
						</tr>
					</table>

					<img src='../general/imagen/BancoAzteca.png' alt='BancoAzteca' style='width:35%'>
					<table>
						<tr>
							<td>Titular:</td>
							<td>Alfredo Tomás Dorado Flores</td>
						</tr>
						<tr>
							<td>CLABE:</td>
							<td>1274 2001 3190 0335 05</td>
						</tr>
						<tr>
							<td>Tarjeta:</td>
							<td>4027 6658 1431 5579</td>
						</tr>
					</table>

					<img src='../general/imagen/BBVALogo.png' alt='BBVA' style='width:15%'>
					<table>
						<tr>
							<td>Titular:</td>
							<td>Alfredo Tomás Dorado Flores</td>
						</tr>
						<tr>
							<td>CLABE:</td>
							<td>0124 2001 5943 8264 67</td>
						</tr>
						<tr>
							<td>Tarjeta:</td>
							<td>4152 3141 7476 2180</td>
						</tr>
					</table>

					<img src='../general/imagen/oxxo.jpg' alt='OXXO' style='width:15%'>
					<table>
						<tr>
							<td>Titular:</td>
							<td>Alfredo Tomás Dorado Flores</td>
						</tr>
						<tr>
							<td>CLABE:</td>
							<td>1374 2010 4212 4575 02</td>
						</tr>
						<tr>
							<td>Tarjeta:</td>
							<td>4169 1614 0028 9426</td>
						</tr>
					</table>
				</div>
				<div class='part2'>
					<h3 class='separacion'>Importante</h3>
					<h2>Saldo pendiente $$totalPagar.00 </h2>
					$mensaje
					<div class='informacion'>
						<p>Cualquier tipo de pago referente a la escuela, ya sean, pago de colegiaturas, pago de certificado o multas le solicitamos realizar el pago únicamente a través de nuestras cuentas oficiales o en la propia institución. Evite inconvenientes y posibles fraudes. Si tiene alguna duda, o si le 'sugieren' realizar el pago por otra cuenta, no dude en contactarnos y reportar al: 720 287 4706.</p>
					</div>
					<div class='puntos'>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Seleccione el método que sea de su agrado (transferencias o en efectivo dentro de la institución).</p>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Realice su pago.</p>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Tome foto de su comprobante.</p>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Envié la foto de su comprobante al 720 287 4706.</p>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Revisaremos su comprobante.</p>
						<p><i class='bi bi-hand-thumbs-up-fill'></i> Y listo, ya tendrá habilitada de nuevo su plataforma UDIMEX.</p>
					</div>
					<p>Atentamente <span>UDIMEX</span></p>
				</div>
			</div>
		";
		}
		
	}

	//$datos=horario($al);
	//$sem=0;
	


echo "</tr></table>";

	
	
/*if ($i==0){
	  echo "<br><br><br><center><div id='mensaje'><center>NO HAY MATERIAS POR MOSTRAR.</div><br><br><table border='0'><tr><td width='7%'><img src='../general/imagen/uno.jpg' width='100%'></td><td width='25%' align='justify'>Selecciona tus materias en <a href='bachillerato_buscar.php'>\"Agregar materias\"</a> que está del lado derecho de la pantalla.</td><td width='7%'><img src='../general/imagen/fl.jpg' width='100%'></td><td width='7%'><img src='../general/imagen/dos.jpg' width='100%'></td><td align='justify'><center>Realiza tu pago en:<br><img src='../general/imagen/bancomer.jpg' width='70%'><br><img src='../general/imagen/oxxo.jpg' height='45%' width='40%'></center></td><td width='7%'><img src='../general/imagen/fl.jpg' width='100%'></td><td width='7%'><img src='../general/imagen/tres.jpg' width='100%'></td><td width='25%' align='justify'>Escanéa o saca una foto a tu recibo de pago y envialo a: <br><b>direccion@udimex.net</b></td></tr></table></center>";

}*/




echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
menu_flota();
mysqli_free_result($datos);


?>
	</body>
</html>

