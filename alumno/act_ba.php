<?php
if ($_POST){
	$id=$_SESSION["g_id"];
	$car=$_POST['car'];
	act_ba($id,$car);
	echo "<script type='text/javascript'> top.window.location='horario_muestra.php'; </script>";
}
?>

<div id='mensaje1'>A continuación debes elegir una de las carreras de nuestra oferta educativa</div><br><br>

<form method='POST'>
<table border='0' width='90%'>
	<tr>
		<td><img src='../general/imagen/pa.jpg' width='180px'></td>
		<td><img src='../general/imagen/ceneval.gif' width='180px'></td>
		<td><img src='../general/imagen/colbach.jpg' width='180px'></td>
	</tr>
	<tr>
		<th><input type='radio' name='car' value='4' style='width:1.4em; height:1.4em;'><font size='4'>PREPA ABIERTA</font></th>
		<th><input type='radio' name='car' value='2' style='width:1.4em; height:1.4em;'><font size='4'>CENEVAL</font></th>
		<th><input type='radio' name='car' value='3' style='width:1.4em; height:1.4em;'><font size='4'>COLBACH</font></th>
	</tr>
	<tr>
		<th><font size='1'><a href='../principal/p_abierta.php'>Ver más...</a></font></th>
		<th><font size='1'><a href='../principal/ceneval.php'>Ver más...</a></font></th>
		<th><font size='1'><a href='../principal/colbach.php'>Ver más...</a></font></th>
	</tr>
	<tr>
		<th colspan='3'><br><br><input type='submit' value='ACTUALIZAR' id='acepta'></font></th>
	</tr>
</table>
</form>
<br><br>
