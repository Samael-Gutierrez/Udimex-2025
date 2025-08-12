<?php 
session_start();
include("funciones.php");
include("../consultas.php");
permiso();
cabeza();
?>

<script type='text/javascript' src='../js/jquery-1.6.4.js'></script> 

<script>
	function manda(m){
		document.getElementById('materia').value=m;
		$(document).ready(function(){  	
      			$.ajax({  
          			url: 'mat_nueva.php?mat='+$('#materia').val()+'&car='+$('#carrera').val(),  
          			success: function(data) {  
         				$('#resultado').html(data);
				}  
      			});  
		});

	}

	
</script>





</head>
<body onload='manda(0);'>

<?php
usuario();
menu_i();

if ($_GET){
	$id=$_GET['car'];
	$datos=b_car($id);
	$fila=mysqli_fetch_assoc($datos);
	$nom=$fila['nombre'];
}


	echo "<br><br><br><br><br><fieldset align='center'>$nom</fieldset><input type='hidden' value='0' id='materia'><input type='hidden' value='$id' id='carrera'>";




	echo "<table border='0' width='95%' align='center'>
		<tr>
			<th colspan='3'><input type='button' value='Nueva Materia' onclick='manda(0);'></th>
		</tr>
		<tr>
			<th>#</th><th>Materia</th><th></th><th></th><th rowspan='20' valign='top'><div id='resultado' name='resultado'></div></th>
		</tr>
		";


		$i=0;
		$datos=b_plan($id);
		while($fila=mysqli_fetch_assoc($datos)){
		if($i==0){
			$i=1;
			$es="tab1";
		}
		else{
			$i=0;
			$es="tab2";
		}
			$mat=$fila['id_materia'];
			if ($fila['id_carrera']==0){
				$e="mal.png";
			}
			else{
				$e="bien.png";
			}
			echo"
			<tr id='$es'>
	 			<td>$mat</td>
				<td>".$fila['nombre']."</td>
				<th><img src='../imagen/$e' width='20px'></th>
				<th><input type='button' value='editar' name='bt' id='bt' onclick='manda($mat);'></th>
			</tr>";
		}


echo "	</table><br><br><br><hr><br><br>";


?>
</body>
</html>
