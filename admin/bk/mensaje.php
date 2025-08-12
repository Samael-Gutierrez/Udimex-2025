<?php
include("../consultas/general.php");
include("../consultas/basic.php");
include("../general/todos.php");
cabeza(0);
//f_menu();
?>
	</head>
	<body>
	<a href='mensaje_nuevo.php'>Mensaje nuevo</a><br><br><br>
<?php

if ($_POST){
	e_mensaje($_POST['id']);
	echo "El mensaje se elimino correctamente";
}
carga_mensajes();

function carga_mensajes(){
	$datos=b_mensaje2();

	echo "<table border='1'><tr><th>Titulo</th><th>Texto</th><th>Estado</th><th></th><th></th></tr>";
	
	$i=0;
	while($fila=mysqli_fetch_assoc($datos)){
		if($i==0){
			$i=1;
			$es="tab1";
		}
		else{
			$i=0;
			$es="tab2";
		}
		echo "<tr id=$es>
			<td>".$fila['titulo']."</td>
			<td>".$fila['texto']."</td>
			<th>".$fila['estado']."</th>
			<td><a href='mensaje_edita.php?msg=".$fila['id_mensaje']."'>editar</a></td>
			<td><form method='POST'><input type='hidden' name='id' value='".$fila['id_mensaje']."'><input type='submit' value='Borrar'></form></td>
		</tr>";	
	}
	echo "</table>";
}	

?>

