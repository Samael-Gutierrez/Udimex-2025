<?php
session_start();
include("../general/todos.php");
include("../general/consultas.php");
cabeza(0);
f_menu();

$ar=$_GET['ar'];
?>

<meta name='description' content='Encuentra promociones, cupones de descuento y otras opciones para fomentar tu estudio en la preparatoria abierta y CENEVAL'>

	</head>
	<body onload="cambia('m4');">
<?php
menu_i();

if ($ar==1) {
include("prom_gratis.php");
}

if ($ar==2) {
include("prom_cupon.php");
}

if ($ar==3) {
include("prom_fomento.php");
}


menu_c();
?>
	</body>
</html>

