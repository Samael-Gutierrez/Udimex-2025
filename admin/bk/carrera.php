<?php 
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();
?>
</head>
<body>

<?php
usuario();
menu_i();


	echo "<br><br><br><br><br>";




	echo "<table border='0' width='95%' align='center'>
		<tr>
			<td  align='center' colspan=4>	
				<fieldset>OFERTA EDUCATIVA</fieldset><br><br>
			</td>
		</tr>
		<tr>";

		$datos=b_carrera();
		while($fila=mysqli_fetch_assoc($datos)){
			echo"
 			<td  align='center'>	
				<div class=c1>
					<a href='plan.php?car=".$fila['id_carrera']."' id='al' name='al'><img src='../imagen/".$fila['imagen']."' height='60'>
					<br>".$fila['nombre']."</a>

					<font size='1'><br><a href='plan.php?car=".$fila['id_carrera']."' id='al' name='al'>
					<a href='e_carr.php?car=".$fila['id_carrera']."' id='al' name='al'>
					Editar</a></font>
				</div>

					
			</td>";
		}


echo "
			<td  align='center'>	
				<div class=c1>
					<a href='e_carr.php?car=0' id='al' name='al'><img src='../imagen/mas.png' height='60'>
					<br>Nueva Carrera</a>
				</div>
			</td>
		</tr>
	</table><br><br><br><hr><br><br>";


?>
</body>
</html>
