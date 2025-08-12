<?php
session_start();
include("../funciones.php");
include("../../general/consultas/calendario.php");
include("../../general/consultas/usuario.php");
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');

cabeza(0);

?>

	</head>
		<body>




<?php
$id=$_SESSION["ad_id"];
$nom=$_SESSION["ad_nom"];
usuario("../../",'index.php');
menu_i();

echo "<table border='1'><tr><th>Fecha</th><th>Titulo</th><th>Descripción</th><th>Responsable</th><th></th><th></th></tr>";
$datos=b_ev2(1, $id);
while($fila=mysqli_fetch_assoc($datos)){
	$datos2=b_us($fila['id_usuario']);
	$fila2=mysqli_fetch_assoc($datos2);

	$el="";
	if ($fila['id_us']==$id){
		$el="<img src='../../general/imagen/cerrarmenumovil.png' height='20px'>";
	}

	echo "<form><tr>
		<td><input type='date' value='".$fila['fc']."'></td>
		<td>".$fila['nombre']."</td>
		<td>".$fila['descripcion']."</td>
		<td>".$fila2['nombre']." ".$fila2['ap_pat']."</td>
		<td><a href='agenda_act.php?ev=".$fila['id_evento']."&es=2'><img src='../../general/imagen/bien.png' height='20px'></a></td>
		<td>$el</td>
	</tr></form>";
}

echo "</table><hr>";

echo "<table border='1'><tr><th>Fecha</th><th>Hora</th><th>Titulo</th><th>Descripción</th><th>Responsable</th><th></th></tr>";
$datos=b_ev3(1, $id);
while($fila=mysqli_fetch_assoc($datos)){
	$datos2=b_us($fila['id_usuario']);
	$fila2=mysqli_fetch_assoc($datos2);

	echo "<tr><td>".$fila['fc']."</td><td>".$fila['hi']."</td><td>".$fila['nombre']."</td><td>".$fila['descripcion']."</td><td>".$fila2['nombre']." ".$fila2['ap_pat']."</td></tr>";
}

echo "</table>";
?>
