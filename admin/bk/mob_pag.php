<html>
	</head>
	<body>
<?php
include("../consultas.php");
$us=$_GET['us'];
$pago=$_GET['pago'];

$datos=b_us($us);
if ($fila=mysqli_fetch_assoc($datos)){
	echo $fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']."<br>";
}
mysqli_free_result($datos);

echo "<form method='POST' action='activa_pago.php'>
		<input type='hidden' value='$pago' name='id_pago'>
	<input type='submit' value='Activar'></form>";

?>
	</body>
</html>

