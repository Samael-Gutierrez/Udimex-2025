<?php
session_start();
include("../general/todos.php");
include("../consultas/expediente.php");
cabeza();
permiso();


if ($_POST){
	$nom=$_POST['nom'];
	$ap=$_POST['ap'];
	$am=$_POST['am'];
	$sexo=$_POST['sexo'];

	$calle=$_POST['calle'];
	$ne=$_POST['ne'];
	$ni=$_POST['ni'];
	$col=$_POST['col'];
	$cp=$_POST['cp'];
	$mun=$_POST['mun'];
	$ef=$_POST['ef'];

	$fn=$_POST['fn'];

	$tca=$_POST['tca'];
	$tce=$_POST['tce'];
	$mail=$_POST['mail'];


	$id=g_paciente($nom,$ap,$am,$sexo,$fn);

	g_dom($id,$calle,$ne,$ni,$col,$cp,$mun,$ef);

	if(strlen(trim($tca))>0){
		g_tel($id,trim($tca),1);
	}

	if(strlen(trim($tce))>0){
		g_tel($id,trim($tce),2);
	}

	if(strlen(trim($mail))>0){
		g_mail($id,trim($mail));
	}

	$_SESSION['paciente']=$id;
	
	header("Location: aparato.php");

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










cabeza(0);

echo "</head><body><center>";

//permiso();
//menu_i();

//$control=0;







	echo "<div id='medio'><div id='resp'></div>
	<form method='POST' id='formulario' autocomplete='off'>

		Paciente<hr>
		<input type='text' value='' name='nom' id='nom' required class='bt_campo' placeholder='Nombre' size='14'>
		<input type='text' value='' name='ap' id='ap' class='bt_campo' placeholder='Apellido Paterno' size='14'>
		<input type='text' value='' name='am' id='am' class='bt_campo' placeholder='Apellido Materno' size='14'> 
		<br>Fecha de nacimiento <input type='date' value='' name='fn' id='fn' class='bt_campo' required><br>Sexo: <input type='radio' value='1' name='sexo' class='bt_campo'> Masculino &nbsp; &nbsp; &nbsp; <input type='radio' value='2' name='sexo' class='bt_campo'> Femenino 
		



		<br><br>
		Dirección<hr>
		<input type='text' value='' name='calle' id='calle' size=27 class='bt_campo' placeholder='Calle'>
		<input type='text' value='' name='ne' id='ne' size=12 class='bt_campo' placeholder='N° ext.'>
		<input type='text' value='' name='ni' id='ni' size=12 class='bt_campo' placeholder='N° int.'>
		<input type='text' value='' name='col' id='col' size=20 class='bt_campo' placeholder='Colonia'>
		<input type='text' value='' name='cp' id='cp' size=2 class='bt_campo' placeholder='CP'>
		<input type='text' value='' name='mun' id='mun' size=15 class='bt_campo' placeholder='Municipio'>
		<input type='text' value='' name='ef' id='ef' size=13 class='bt_campo' placeholder='Entidad Federativa'>

		<br><br>
		Medios de Contacto<hr>
		<input type='text' value='' name='tca' id='tca' class='bt_campo' size=10 placeholder='Tel casa'>
		<input type='text' value='' name='tce' id='tce' class='bt_campo' size=10 placeholder='Tel celular'>
		<input type='email' value='' name='mail' id='mail' class='bt_campo' size=18 placeholder='e-mail'>


	
	<div id='g_btn'><input type='submit' value='Guardar Cliente' class='bt_enviar'></div>
		
	</form>

	</div>";




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




