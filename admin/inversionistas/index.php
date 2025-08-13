<?php
session_start();
date_default_timezone_set('America/Mexico_City');

$dir = "../../general/";
include($dir . "db/inv.php");
include($dir . "db/basica.php");
include($dir . "db/admin.php");
include($dir . "php/admin.php");

cabeza("Inversionistas - Udimex", "", "");
echo "<body>";
usuario("../../", 1);
echo "<center>";
menu_i();
echo "<br><fieldset id='subtitulo'>CONTROL DE PAGOS</fieldset>";

$fact = date('Y-m-d');

/*Buscar todos los grupos*/
$grupo = "";
$cg = "
	<tr>
		<th>Invesionista</th>
		<th>Capital</th>
		<th>Nuevo Aporte</th>
	</tr>
";
$sg = "";
$datos = b_inv2();
while ($fila = mysqli_fetch_assoc($datos)) {
	$datos2 = b_depo2($fila['id_usuario']);
	if ($fila2 = mysqli_fetch_assoc($datos2)) {
		$inversion = $fila2['r'];
	} else {
		$inversion = 0;
	}

	$fpag = "
		<form method='POST' action='pago_guarda.php'>
			<input type='text' value='' name='cantidad' size='5'>
			<input type='hidden' value='" . $fila['id_usuario'] . "' name='usuario'>
			<input type='submit' value='Guardar'>
		</form>";

	$cg = $cg . "
		<tr>
			<td>" . $fila['id_usuario'] . "</td>
			<td>" . $fila['nombre'] . " " . $fila['ap_pat'] . " " . $fila['ap_mat'] . "</td>
			<td align='center'>$inversion</td>
			<td align='center'>$fpag</td>
		</tr>
	";
}

echo "<table border='1'>$cg</table>";
?>
</body>
</html>