<?php
session_start();

$dir = "../../general/";

include($dir."db/basica.php");
include($dir."db/conta.php");

	$a=$_POST['anio'];
	$m=$_POST['mes'];
	$total=0;


	$datos=b_ing($a."-".$m."-01",$a."-".$m."-31");
	$fila=mysqli_fetch_assoc($datos);
	$ingreso=$fila['res'];
	$ingreso2=number_format($ingreso, 2, '.', ',');
	  



	echo "<br><table border='2'><tr><th>Fecha</th><th>Concepto</th><th>Cantidad</th></tr>";
	$datos=b_ingresos($a."-".$m."-01",$a."-".$m."-31",1);
	while ($fila=mysqli_fetch_assoc($datos)){
		
		$cant=number_format($fila['cantidad'], 2, '.', ',');
		echo "<tr><td>".$fila['f_pago']."</td><td>".$fila['concepto']."</td><td>$cant</td></tr>";
		$total=$total+$fila['cantidad'];
	}

	$sobres = b_sobres($a."-".$m."-01",$a."-".$m."-31");
	while($fila = mysqli_fetch_assoc($sobres)){
		$id = $fila['id_alumno'];
		$name = getNameById($id);
		$filas = mysqli_fetch_assoc($name);
		$nombre = $filas['nombre'] . " " . $filas['ap_pat'];
		$cantidad=number_format($fila['cantidad'], 2, '.', ',');
		echo "
			<tr>
				<td>".$fila['fecha_pago']."</td>
				<td>Recargo de $nombre</td>
				<td>$cantidad</td>
			</tr>
		";
		$total=$total+$fila['cantidad'];
	}

	$_SESSION['t_ing']=$total;
	
	$total2=number_format($total, 2, '.', ',');
	echo "<tr><td class='tod' colspan='3' align='right'>Total: $total2</td></tr></table>

	
	";

?>
