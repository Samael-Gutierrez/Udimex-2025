<?php
session_start();
include("../general/todos.php");
include("../consultas/expediente.php");
include("../consultas/paciente.php");
cabeza();
permiso();




if ($_POST){
	$app=$_POST['app'];
	$pa=$_POST['pa'];
	$equipo=$_POST['equipo'];

	$ruido=$_POST['ruido'];
	$tiempo=$_POST['tiempo'];
	$masc=$_POST['masc'];
	$blanco=$_POST['blanco'];
	$col=$_POST['colab'];
	
	//deshabilita expedientes anteriores
		q_exp($_SESSION['paciente']);

	//---------------------------------------
	$id=g_exp($app, $pa, $equipo, $ruido, $tiempo, $masc, $blanco, $col, $_SESSION['paciente']);
	$_SESSION['exp']=$id;
	
	header("location: ../expediente");
}





$id=$_SESSION['us_id'];
$nom=$_SESSION['us_nom'];
?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	</head>
	<body class="is-preload">

		<?php
			menu();
		?>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container"> <span id='movil' hidden onclick='mmenu(1);'>&#9776;</a></span> <?php echo $nom; ?>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">










<?php




if (isset($_SESSION['paciente'])){

	$datos=b_pac2($_SESSION['paciente']);
	if($fila=mysqli_fetch_assoc($datos)){
		$nombre=$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
	}

	cabeza(0);



	echo "<div id='medio'><div id='resp'></div>
	Paciente: <b><u> $nombre </u><b><hr>
	<form method='POST' id='formulario' autocomplete='off'>

		Datos del equipo<hr>
		<input type='text' value='' name='app' class='bt_campo' placeholder='APP' required>
		<input type='text' value='' name='pa' class='bt_campo' placeholder='PA' required>
		<input type='text' value='' name='equipo' class='bt_campo' placeholder='Equipo' required> 
		<input type='text' value='' name='ruido' class='bt_campo' placeholder='Nivel de ruido' required>
		<input type='text' value='' name='tiempo' class='bt_campo' placeholder='Tiempo' required>
		<input type='text' value='' name='blanco' id='am' class='bt_campo' placeholder='Otoscopia' required> 
		<input type='text' value='' name='colab' id='am' class='bt_campo' placeholder='Colaboración B.R.M.' required><br>
		Enmascarador: 
		<input type='radio' value='1' name='masc' class='bt_campo' checked> SI &nbsp; &nbsp; &nbsp; &nbsp; 
		<input type='radio' value='1' name='masc' class='bt_campo'> NO


	<div id='g_btn'><input type='submit' value='Guardar Cliente' class='bt_enviar'></div>
		
	</form>

	</div>";

	
}
else{
	header("Location: paciente_nuevo.php");
}










?>









































                        
                           
                        




					  
					</section>

				<!-- About Me --><!-- Contact -->
			</div>

		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class='copyright'>
						<?php pie(); ?>
					</ul>

			</div>




	</body>
</html>




