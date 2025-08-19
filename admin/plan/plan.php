<?php 
session_start();
$dir = "../../general/";
include($dir."db/admin.php");
include($dir."db/carreras.php");
include($dir."db/materias.php");
include($dir."db/basica.php");
include($dir."php/admin.php");

cabeza("Plan de estudio","", "");
?>

<script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script> 

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





<body onload='manda(0);'>

<?php
usuario("../../","index.php");
menu_i();

if ($_GET){
	$id=$_GET['car'];
	$datos=b_car("=$id");
	$fila=mysqli_fetch_assoc($datos);
	$nom=$fila['nombre'];
	if ($fila['duracion']>11){
		$dura=$fila['duracion']/12;
		$dura=$dura." años (".$fila['duracion']." meses)";
	}
	else{
		$dura=$fila['duracion']." meses";
	}
	$des=$fila['descripcion'];
	$imagen=$fila['imagen'];

	$tp="Varios examenes";
	if($fila['tipo']==1){
		$tp="Examen único";
	}
}


	echo "<br><br>
	<fieldset align='center'>
		<div class='w3-card-4 w3-margin w3-white' style='width:500px; display:inline-block;'>
			<header class='w3-container fondo_azul_oficial' align='center' style='height:80px;'>
	 			<h3>$nom</h3>
			</header>
			<div class='w3-container' width='138px' align='left'>     					
				Tipo: $tp<br>
				Duración: $dura<br>
				<center><img src='$imagen' width='150px'></center><br>
			<hr>
			</div>
			<div class='w3-padding w3-block' align='center'>
				<a href='#' onclick=\"document.getElementById('id01').style.display='block'\">editar</a><a href=''></a>
			</div>
		</div>	
	</fieldset>




  <div id='id01' class='w3-modal'>
    <div class='w3-modal-content w3-card-4 w3-animate-zoom' style='max-width:600px'>
  
      <div class='w3-center'><br>
        <span onclick=\"document.getElementById('id01').style.display='none'\" class='w3-button w3-xlarge w3-transparent w3-display-topright' title='Close Modal'>×</span>
        <img src='img_avatar4.png' alt='Avatar' style='width:30%' class='w3-circle w3-margin-top'>
      </div>

      <form class='w3-container' action='/action_page.php'>
        <div class='w3-section'>
          <label><b>Username</b></label>
          <input class='w3-input w3-border w3-margin-bottom' type='text' placeholder='Enter Username' name='usrname' required>
          <label><b>Password</b></label>
          <input class='w3-input w3-border' type='text' placeholder='Enter Password' name='psw' required>
          <input class='w3-check w3-margin-top' type='checkbox' checked='checked'> Remember me
        </div>
      </form>

      <div class='w3-container w3-border-top w3-padding-16 w3-light-grey'>
        <button onclick='document.getElementById('id01').style.display='none'' type='button' class='w3-button w3-red'>Cancel</button>
        <span class='w3-right w3-padding w3-hide-small'>Forgot <a href='#'>password?</a></span>
      </div>

    </div>
  </div>














	<input type='hidden' value='0' id='materia'>
	<input type='hidden' value='$id' id='carrera'>





<table border='0' width='95%' align='center'>
		<tr>
			<th colspan='3'><input type='button' value='Nueva Materia' onclick='manda(0);'></th>
		</tr>
		<tr>
			<th>#</th><th>Materia</th><th></th><th></th><th rowspan='20' valign='top'><div id='resultado' name='resultado'></div></th>
		</tr>
		";


		$i=0;
		$datos=b_materias($id);
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
			echo"
			<tr id='$es'>
	 			<td>$mat</td>
				<td>".$fila['nombre']."</td>
				<th><input type='button' value='editar' name='bt' id='bt' onclick='manda($mat);'></th>
			</tr>";
		}


echo "	</table>";


?>
</body>
</html>
