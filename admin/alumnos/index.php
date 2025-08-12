<?php
	session_start();
	$dir="../../general/";
	include($dir.'php/admin.php');
	include($dir.'db/admin.php');
	include($dir.'db/basica.php');

	$adicional="
	<link rel='stylesheet' href='assets/css/style.css'>
	<script type='text/javascript' src='".$dir."js/jquery-2.1.1.js'></script>
	<script src='assets/js/script.js'></script>";
	
	cabeza("Alumno - Udimex",$adicional, $dir);

	usuario("../../","index.php");
	menu_i();
?>
<body>
	<div class="main-container">
		<div class="second-container">
			<div class="search-container">
				<div class="search">
					<h3>Busca a un alumno</h3>
					<p>En esta sección, encontrarás un buscador que te permite localizar rápidamente a un alumno por su nombre. Solo tienes que ingresar el nombre o un apellido. Una vez encontrado, podrás acceder a su información detallada de manera rápida y sencilla.</p>
					<table>
						<tr>
							<td><input type='text' id='nom' name='nom' placeholder='Nombre(s)' autocomplete="off" class='campos'></td>
							<td><input type='text' id='ap' name='ap' placeholder='Apellido Paterno' autocomplete="off" class='campos'></td>
							<td><input type='text' id='am' name='am' placeholder='Apellido Materno'autocomplete="off" class='campos'></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="result-container">
				<div class="resultado" id="resultado"></div>
			</div>
		</div>
	</div>
</body>
</html>
