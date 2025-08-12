<html>
	</head>
	<body>
<?php
include("../consultas.php");
include("../todos.php");
$i=1;
$j=0;

$datos=b_pago($_POST["id"]);
$sub=2;
while($fila=mysqli_fetch_assoc($datos)){
	$j=$j+1;
	if ($i==1){
echo "<div id='titulo2'>Pagos Pendientes</div>

			<table border='0' id='tabla1'><tr id='cab'><th>NUMERO</th><th>FECHA DE SOLICITUD</th><th>PRECIO</th><th># DE MATERIAS</th><th></th><th></th></tr>";
		
	}
	$fe=fecha($fila['fecha_solicitud']);
	$datos2=detalle_pago($fila['id_pago']);
	$fila2=mysqli_fetch_assoc($datos2);
	mysqli_free_result($datos2);
		$p=$fila['id_pago'];

		if($sub==2){
			$sub=1;
		}
		else{
			$sub=2;
		}

		echo "<tr id='tab".$sub."'><th>$i</th><th>".$fe."</th><th>$  ".$fila['cantidad'].".00</th><th>".$fila2['s_mat']."</th>
			<td>
				<form method='POST' action='activa_pago.php'><input type='hidden' value='$p' name='id_pago'>
					<input type='submit' value='Activar'></form>
			</td>

			<td><a href='pagos_detalle.php?pago=$p'>Ver...</a></td></tr>";
	
	$i=$i+1;
}
mysqli_free_result($datos);


echo "</table>";






$i=1;

$datos=b_pago2($_POST['id']);
$sub=2;
while($fila=mysqli_fetch_assoc($datos)){
	$j=$j+1;
	$fe=fecha($fila['fecha_pago']);
	$fe1=fecha($fila['fecha_caducidad']);
	$dias=restantes($fila['fecha_caducidad']);
	$cant=$fila['cantidad'];
	$datos2=detalle_pago($fila['id_pago']);
	$fila2=mysqli_fetch_assoc($datos2);
	mysqli_free_result($datos2);
	if($dias<0){
		$dias=0;
	}

	if ($i==1){
		echo "<br><br><br><div id='mensaje'>
				Est&aacute;s son los pagos que has realizado, s&oacute;lo para verificar datos
			</div><br><div id='titulo2'>Pagos Realizados</div>
			<table border='0' id='tabla1'><tr id='cab'><th>NUMERO</th><th>FECHA DE PAGO</th><th>FECHA DE 			CADUCIDAD</th><th width='20%'>COSTO</th><th># DE MATERIAS</th><th>DIAS RESTANTES</th><th></th></tr>";
	}

	if($sub==2){
		$sub=1;
	}
	else{
		$sub=2;
	}

	echo "<tr id='tab".$sub."'><th>$i</th><th>".$fe."</th><th>".$fe1."</th><th>$  ".$cant.".00</th><th>".$fila2['s_mat']."</th>
			<th>$dias</th>

			<th><div class='boton_seccion1'><a href='pagos_detalle.php?pago=".$fila['id_pago']."&us=".$_POST["id"]."'>Ver...</a></div></th></tr>";
	$i=$i+1;
}
mysqli_free_result($datos);

echo "</table>";

if ($j==0){
	echo "<br><br><br><center><div id='error'>NO HAY PAGOS POR MOSTRAR</div></center><br><br><br>";
}
?>
	</body>
</html>

