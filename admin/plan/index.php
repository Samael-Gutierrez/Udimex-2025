<?php 
session_start();
include("../funciones.php");
include("../../general/consultas/carreras.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/funcion/basica.php");
//permiso();
cabeza("Plan de estudios - Udimex","");
?>
</head>
<body>

<?php
usuario("../../","index.php");
menu_i();


	echo "<br><br><br><br><br>";




	echo "
				<fieldset align='center'>OFERTA EDUCATIVA</fieldset><br><br>
			";

		$datos=b_carrera(">0");
		while($fila=mysqli_fetch_assoc($datos)){
			echo"
 	
				<div class='w3-quarter w3-card-4 w3-margin' style='height:80px; width:200px'>
					<a href='plan.php?car=".$fila['id_carrera']."' id='al' name='al'><img src='".$fila['imagen']."' height='60'></a>";

					
			/*echo "<font size='1'><br><a href='plan.php?car=".$fila['id_carrera']."' id='al' name='al'>
					<a href='e_carr.php?car=".$fila['id_carrera']."' id='al' name='al'>
					Editar</a></font>";*/

			echo "
				</div>";
		}


echo "
	
				<div class='w3-quarter w3-card-4 w3-margin' style='height:80px; width:200px'>
					<a href='e_carr.php?car=0' id='al' name='al'><img src='../../general/imagen/mas.png' height='60'>
					<br>Nueva Carrera</a>
				</span>

		<br><br><br><hr><br><br>";


?>
</body>
</html>
