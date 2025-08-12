<?php
	include("../consultas.php");
	include("funciones.php");
	$p=$_POST['id_pago'];
	$datos=b_pago4($p);
	$fila=mysqli_fetch_assoc($datos);
	mysqli_free_result($datos);
	$hoy=date('Y-m-d');
	$dc=$fila['dias_caducidad'];
	$fc=m_dias($hoy,$dc);

	echo "
		<form action='activa_pago2.php' method='POST'>
			<table border='0'>
				<tr><td># Pago</td><th>$p<input type='hidden' name='id' value='$p'></th></tr>
				<tr><td>Fecha de solicitud:</td><td>".$fila['fecha_solicitud']."</td></tr>
				<tr><td>Cantidad:</td><td><input type='text' value='".$fila['cantidad']."' name='cantidad'></td></tr>
				<tr><td>Fecha de pago:</td><td><input type='date' name='fp' value='$hoy'></td></tr>
				<tr><td>Días de caducidad:</td><td>$dc</td></tr>
				<tr><td>Fecha de caducidad:</td><td><input type='date' name='fc' value='$fc'></td></tr>
				<tr><td>Referencia:</td><td><input type='text' name='ref'></td></tr>
				<tr><td>Tipo:</td><td><input type='radio' name='tipo' value='2' checked> Por materia<br>
					<input type='radio' name='tipo' value='1'> Por semana<br></td></tr>
			</table>
			<input type='submit' value='Activar'>
		<form>


";


	

?>


