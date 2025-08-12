<?php 
	include("../todos.php");
	include("../consultas.php");
cabeza(0);
f_menu();
?>

	</head>
	<body>



<?php

	echo "
		<div id='mensaje'>
			Este es el detalle del pago solicitado, si a&uacute;n no realizas el pago puedes realizarlo con la siguiente 				informaci&oacute;n </div><br><center>
		<div id='mensaje2'>DETALLE DE PAGO</div><br><br>";


   		echo "<table border='0' id='tabla1'>
			<tr id='cab'>
				<th>CLAVE</th><th>MATERIA</th><th>SEMESTRE</th><th>DURACI&Oacute;N</th><th>PRECIO</th>
			</tr>";
	$datos=b_pago3($_GET['pago'],$_GET['us']);
	$precio=0;
	$caduca=0;
	$sub=1;
	while($fila=mysqli_fetch_assoc($datos)){
		$costo=$fila['costo'];
		$precio=$precio+$costo;
		$caduca=$caduca+$fila['duracion'];

		if($sub==2){
			$sub=1;
		}
		else{
			$sub=2;
		}


		echo "
			<tr id='tab".$sub."'>
				<th>".$fila['id_materia']."</th><th>".$fila['nombre']."</th><th>".$fila['semestre']."</th><th>".$fila['duracion']."</th><th>$  $costo.00</th>
			</tr>";

	}
	mysqli_free_result($datos);

	

		echo "<tr><th></th><th></th><th></th><th id='resultados'>TOTAL</th>
			<th id='resultados'>$ $precio</th></tr>";

		echo "</table>";
		$res=(($caduca*7)+45)%30;
		$caduca=((($caduca*7)+45)-$res)/30;
		echo "<form method='POST' action='activa_pago.php'>
			<input type='hidden' value=".$_GET['pago']." name='id_pago'>
			<input type='submit' value='Activar'>
			
		</form><a href='javascript:history.back(1)'>Atrás</a>
		<br><br>Nota: El acceso al material selecionado es por <font size='5'>$caduca meses </font>, a partir de la fecha en que se realice el pago.";


?>
	</body>
</html>

