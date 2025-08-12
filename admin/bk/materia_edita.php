<?php
include("../consultas.php");
include("../todos.php");

cabeza(2);

echo "<link href='../estilo/estilo.css' type='text/css' rel='stylesheet' /></head><body><br><br><br><center>";



$dato2=materia_muestra();
	echo "<table border='0'>";
	echo "<ul>";
	$i=0;
	while($fila2=mysqli_fetch_assoc($dato2)){
		if($i==0){
			$i=1;
			$es="tab1";
		}
		else{
			$i=0;
			$es="tab2";
		}
		echo "<tr id=$es><td>".$fila2['semestre']."</td><td><li>".$fila2['nombre']."</li></td><td><a href='materia_contenido.php?mat=".$fila2['id_materia']."'>editar</a></td><td><a href='ordena.php?mat=".$fila2['id_materia']."'>Reordenar Temas</a></td></tr>";	
	}
	echo "</ul></table></center>";

?>






</body>
</html>

