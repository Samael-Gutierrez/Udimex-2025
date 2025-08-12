<!DOCTYPE HTML>
<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
//include("../../consultas/grupos.php");
//include("../../consultas/carreras.php");
permiso();
cabeza();




?>


<title>CONTROL DE GRUPOS - UDIMEX</title>
</head>
<body>

<?php
	usuario("../../","index.php");
	echo "<center>";
	menu_i();
	echo "<br><br><br><br>
		<fieldset id='subtitulo'>CONTROL DE GRUPOS</fieldset>";

	

?>
	



</body>
</html>


