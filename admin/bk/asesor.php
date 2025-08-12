<?php
session_start();
include("consultas.php");


echo "
<html>
<head>
	<title>Asesor - Instituto Kambes </title>
	<link rel='stylesheet' href='estilo/estilo.css'>
	<meta charset='utf-8'>
</head>
<body>
";


if ($_POST){
	$nom=$_POST['nom'];
	$ap=$_POST['ap'];
	$am=$_POST['am'];
	$correo=$_POST['correo'];
	$tel=$_POST['tel'];
	$cel=$_POST['cel'];
	$sexo=$_POST['sexo'];
	$e_civil=$_POST['e_civil'];
	$f_na=$_POST['f_na'];
	$calle=$_POST['calle'];
	$colonia=$_POST['colonia'];
	$numero=$_POST['numero'];
	$municipio=$_POST['municipio'];
	$cp=$_POST['cp'];

	$datos=asesor_nuevo($nom,$ap,$am,$correo,$tel,$cel,$sexo,$e_civil,$f_na,$calle,$colonia,$numero,$municipio,$cp);
	echo "Registro satisfactorio";
	login("");
}
else{
	login("");
	
}
echo "
	</body>
	</html>
";



	function login($mensaje){
		echo "
			<div id='cuerpo'>

				<form method='POST'>
					Registro Asesor<br>
					<br>
					Nombre:<br><input type='text' name='nom' id='caja_texto'><br>
					Apellido paterno:<br><input type='text' name='ap' id='caja_texto'><br>
					Apellido materno:<br><input type='text' name='am' id='caja_texto'><br>
					Sexo
					<input type='radio' name='sexo' value='2' />Femenino
	      				<input type='radio' name='sexo' value='1' />Masculino
        				<br><br>
					Estado Civil:<select name='e_civil'>
					<option value='1'>Soltero</option>
					<option value='2'>Casado</option>
					<option value='3'>Viudo</option>
					<option value='4'>Divorciado</option>
					<option value='5'>Union Libre</option>
					</select><br><br>
					Fecha de Nacimiento:<br><input type='date' name='f_na' id='caja_texto'><br>
					Correo:<br><input type='text' name='correo' id='caja_texto'><br>
					Telefono:<br><input type='text' name='tel' id='caja_texto'><br>
					Celular:<br><input type='text' name='cel' id='caja_texto'><br>					
					Calle:<br><input type='text' name='calle' id='caja_texto'><br>
					Colonia:<br><input type='text' name='colonia' id='caja_texto'><br>
					Numero:<br><input type='text' name='numero' id='caja_texto'><br>
					Municipio:<br><input type='text' name='municipio' id='caja_texto'><br>						  						Codigo Postal:<br><input type='text' name='cp' id='caja_texto'><br>
					<p align='center'>
					&nbsp; &nbsp; &nbsp; &nbsp;
					<input type='submit' value='Entrar' id='boton'></p>
				</form>
				$mensaje
			</div>
		";

	}
?>
