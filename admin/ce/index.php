
<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/grupos.php");
include("../../general/consultas/pagos.php");
include("../../general/consultas/alumno.php");

date_default_timezone_set('America/Mexico_City');

//permiso();
cabeza();

usuario("../../",1);
	echo "<head>
		<title>Menú </title>
		<link rel='stylesheet' href='../estilo/estilo.css'>
		<meta charset='utf-8'>
	</head>
	<body>";

menu_i();

echo "<center><br><br>
		<fieldset id='subtitulo'>CONTROL ESCOLAR</fieldset>";


	echo "<div class=c1>
		<a href=''><img src='../general/imagen/' height='60'>
		<br>Estado del alumno</a>
	</div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<div class=c1>
		<a href=''><img src='../general/imagen/' height='60'>
		<br>Publicación de resultados</a>
	</div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<div class=c1>
		<a href=''><img src='../general/imagen/' height='60'>
		<br>Constancia de estudios</a>
	</div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<div class=c1>
		<a href=''><img src='../general/imagen/' height='60'>
		<br>Administración de documentos</a>
	</div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";

b_alumnos(1);


?>


</body>
</html>
