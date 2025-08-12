<?php
session_start();
include("../general/todos.php");
include("../consultas/basic.php");
include("../consultas/general.php");
cabeza(0);
f_menu();
?>
<script>
	function suma(ob){

		var n1=document.getElementById(ob).value;
		var n2=document.getElementById("total").innerHTML;
		
		if(document.getElementById(ob).checked){
			tot=parseInt(n1)+parseInt(n2);
		}
		else{
			tot=parseInt(n2)-parseInt(n1);
		}

		document.getElementById("total").innerHTML=tot;
	}
</script>
	</head>
	<body onload="cambia('m2');">
<?php
menu_i();
$id=$_SESSION["g_id"];
$datos=b_alcar($id);
$fila=mysqli_fetch_assoc($datos);

echo "<br><center><br>";

if ($fila['id_carrera']>1){
	if ($fila['id_carrera']<5){
		header('location: horario_muestra.php');
	}
}

/*
if ($fila['id_carrera']==4){
	//include("../principal/p_abierta_b.php");
}

if ($fila['id_carrera']==2){
	//include("../principal/ceneval_b.php");
}

if ($fila['id_carrera']==3){
	//include("../principal/colbach_b.php");
	
}*/

if ($fila['id_carrera']<2 or $fila['id_carrera']>4){
	include("../alumno/act_ba.php");
}

echo "	</div>";

menu_c();
?>
	</body>
</html>

