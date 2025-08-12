<?php
session_start();
include('funciones.php');
include('../consultas.php');
permiso();
cabeza();
?>

		<title>Pagos Pendientes</title>
	</head>

	<body>
<?php
usuario();
menu_i();
$i=0;
echo "<br><br><br><br><br><br><table border='1'><tr><th>#</th><th>Pago</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Materia</th><th>Fecha de solicitud</th><th>Cantidad</th></tr>";
$datos=pen_pagos();
while($fila=mysqli_fetch_assoc($datos)){
	$i=$i+1;
	echo "<tr><th>$i</th><td>".$fila['id_pago']."</td><td>".$fila['alumno']."</td><td>".$fila['ap_pat']."</td><td>".$fila['ap_mat']."</td><td>".$fila['materia']."</td><td>".$fila['fecha_solicitud']."</td><td>".$fila['cantidad']."</td></tr>";
}
?>

	
	</body>
</html>
