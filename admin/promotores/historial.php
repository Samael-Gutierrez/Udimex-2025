<?php

include('../funciones.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');

$id=$_GET['ver'];
$datos=m_obs($id);
$observa="";
while($fila=mysqli_fetch_assoc($datos)){
    $observa=$observa."<tr><td>".$fila['fecha']."</td><td>".$fila['observaciones']."</td></tr>";
}

?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Historial</title>
<body>
    
<div class="titulo">
	<br>Historial<br>
</div>


<table class="historial" border=".5">
				<tr class="">
                    
					<th class="relleno">Fecha</th>
					<th class="relleno">Detalles</th>
                </tr>
                <tr>
                <?php
				echo $observa;
				?>
				</tr>
			</table>

           
<a href='mis_prospectos.php'><button class="btp">Regresar</button></a>


</body>
</html>

