<?php
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();

echo "</head><body>";

usuario();

menu_i();

echo "<br><br><br>";
$dato2=curso_muestra($_GET['tema']);
	echo "<ul>";
	while($fila2=mysqli_fetch_assoc($dato2)){
		echo "<li>".$fila2['subtitulo']."<a href='editor.php?cont=".$fila2['id_material']."'>editar</a></li>";	
	}
	echo "</ul>";

?>

<a href='curso_tema.php'> < ---- ATRÁS</a>





</body>
</html>

