<!DOCTYPE HTML>
<?php
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/grupos.php");



?>

<title>CONTROL DE GRUPOS</title>
</head>
<body>

<?php
	

	
	$gr="";
	$datos=b_grupos();
	while($fila=mysqli_fetch_assoc($datos)){
		$gr=$gr."<a href='materia_ver.php?id=".$fila['id_grupo']."'>Grupo ".$fila['id_grupo']."</a><br>";
	}
	
	echo $gr;

	
	?>
</body>
</html>


