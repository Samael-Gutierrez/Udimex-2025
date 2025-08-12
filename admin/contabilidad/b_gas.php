<?php

$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/conta.php");

$a=$_POST['anio'];
$m=$_POST['mes'];
$total=0;


$datos=b_ing($a."-".$m."-01",$a."-".$m."-31");
$datos2=b_sobrecargos($a."-".$m."-01",$a."-".$m."-31");
$fila=mysqli_fetch_assoc($datos);
$fila2=mysqli_fetch_assoc($datos2);
$ingreso=$fila['res'];
$ingreso2=$fila2['total'];
$ingreso3 = $ingreso + $ingreso2;
$ingreso4=number_format($ingreso3, 2, '.', ',');

echo "<br><table border='1'><tr><th>Fecha</th><th>Concepto</th><th>Cantidad</th></tr>";
$datos=b_egresos($a."-".$m."-01",$a."-".$m."-31",1);
while ($fila=mysqli_fetch_assoc($datos)){
	$cant=number_format($fila['cantidad'], 2, '.', ',');
	echo "<tr><td>".$fila['fecha']."</td><td>".$fila['concepto']."</td><td>$cant</td></tr>";
	$total=$total+$fila['cantidad'];
}
$total2=number_format($total, 2, '.', ',');
echo "<tr><td  class='tod' colspan='3' align='right'>Total: $total2</td></tr></table>

<center><section><br><br>
<div class='bordes tod'>Total de Igresos:$ $ingreso4<br>
Total de Egresos:$ $total2<br><br>";
$ganancia=$ingreso3-$total;
$ganancia=number_format($ganancia, 2, '.', ',');
echo " <br>Ganancia neta: $ganancia</section>";


?>
