<?php
session_start();
include('../funciones.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/alumno.php');
  
$prom = "";

$datos = b_promotor();
while ($fila = mysqli_fetch_assoc($datos)) {
    $prom = $prom . "<option value='" . $fila['id_usuario'] . "'>" . $fila['nombre'] . " " . $fila['ap_pat'] . " " . $fila['ap_mat'] . "</option>";
}

$carrera = "<option value=''>Selecciona una categoría</option>";
$datos = b_tcarrera();
while ($fila = mysqli_fetch_assoc($datos)) {
    $carrera = $carrera . "<option value='" . $fila['id_carrera'] . "'>" . $fila['nombre'] . "</option>";
}

//Titulo y adicional
$extras = "
	<link rel='stylesheet' href='assets/css/inscribe.css'>
";

cabeza("Formato de inscripción - Udimex",$extras);

?>
<title></title>
<body>
<?php
usuario("../../", 'index.php');
menu_i();
?>

<div style="margin: 0% 20%;">
<form method="POST" action="guarda.php" class='w3-card-4 w3-padding w3-margin' align='center'>
	<h1 align='center'>FORMATO DE INSCRIPCIÓN</h1>
	<h3 class="w3-round w3-teal">Datos Generales</h3>

	<input type="text" name="user" id="user" placeholder="Usuario" class="w3-input w3-padding w3-half" required>
	<input type="password" name="clave" id="clave" placeholder="Clave" class="w3-input  w3-padding w3-half" required>
	<br><br><br>
	<input type="text" name="nombre" id="nombre" class="w3-input w3-padding w3-third" placeholder='Nombre' required> 
	<input type="text" name="ap" id="ap" class="w3-input w3-padding w3-third" placeholder='Apellido Paterno' required> 
	<input type="text" name="am" id="am" class="w3-input w3-padding w3-third" placeholder='Apellido Materno'> 
	<br><br><br>
	<input type="text" name="curp" id="curp" maxlength='18' onkeyup='checa_edad();' class="w3-input w3-padding" placeholder='CURP' required> 
	<div id='edad'>
	  <p id='p_edad'><br></p>
	</div>
	
	<h3 class="w3-round w3-teal">Datos de Contacto</h3>
	<input type="text" maxlength='10' name="telef" id="telef" class="w3-input w3-padding w3-half" placeholder='Teléfono'> 
	<input type="email" name="ce" id="ce" class="w3-input w3-padding w3-half" placeholder='Correo electrónico'> 

	<br><br><br><br>
	<h3 class="w3-round w3-teal">Datos de Escolares</h3>
	<p class='w3-third'> Plan de estudios:</p> 
	
	<select name="carrera" id="carrera" class="w3-input w3-padding w3-half">
		<?php echo $carrera;?>
	</select><br><br><br>
	<div class='w3-third'> Modalidad:</div> 
	<div class='w3-half'>
		<input type="radio" value="1" name="mo" id="m" checked class='w3-check'> Presencial &nbsp; &nbsp; 
		<input type="radio" value="2" name="mo" id="g" class='w3-check'> Linea &nbsp; &nbsp; 
		<input type="radio" value="3" name="mo" id="x" class='w3-check'> Mixto &nbsp; &nbsp; 
	</div>
	<br><br>
	<div>
		<p class='w3-third'>Fecha de inicio<input  type="date" name="fdii" id="fdii"></p> 
		<p class='w3-third'>Fecha de pago<input type="date" name="fdp" id="fdp"></p> 
		<p class='w3-third'>Fecha de examen<input type="date" name="f_examen" id="f_examen"></p> 
	</div>

	<center>
		<div id="resultado" class='resultado'></div>
	</center>
	<a id='openModal' class='openModal' style='display:none'>Crear grupo</a>

	<br><br><br>
	<h3 class="w3-round w3-teal">Datos de Pago</h3>
	<input type="text"  name="i" id="i" placeholder='Inscripción' class='w3-input w3-third'>
	<input type="text"  name="cm" id="cm" placeholder='Mensualidad' class='w3-input w3-third'>
	<input type="text"  name="cer" id="cer" placeholder='Certificado' class='w3-input w3-third'>

	
	<div id='menor_edad' hidden><br><br><br><br>
		<h3 class="w3-round w3-teal">Menores de edad</h3>
		<p align='left' class='w3-margin w3-padding'>Tutor:</p>
		<input type="text" name="ndpot" id="ndpot" placeholder='Nombre' class='w3-input w3-third'>
		<input type="text" name="appa" id="appa" placeholder='Apellido Paterno' class='w3-input w3-third'>
		<input type="text" name="apom" id="apom" placeholder='Apellido Materno' class='w3-input w3-third'>
		<br><br><br>
		<input maxlength="10" type="text" name="telefono" id="telefono" placeholder='Teléfono' class='w3-input w3-half'>
		<input type = "email" name="cee" id="cee" placeholder='Correo electrónico' class='w3-input w3-half'>
	</div>
	
	<br><br><br><br>
	<h3 class="w3-round w3-teal">Documentos a entregar</h3>

	<table class='w3-table w3-margin w3-padding w3-striped w3-bordered file-table'>
		<tr>
			<th>Documentos</th>
			<th>Original</th>
			<th>Copia</th>          
			<th>No entregado</th>
		</tr>
		<tr>
			<td>CURP</td>
			<td class='w3-center'><input type="radio" value="1" name="cr" id="corp" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="cr" id="s" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="cr" id="cs" checked class='w3-check'></td>
	  
		<tr>
			<td>Acta de nacimiento</td>
			<td class='w3-center'><input type="radio" value="1" name="c" id="acd" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="c" id="s" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="c" id="cs" checked class='w3-check'></td>
		</tr>
		
		<tr>
			<td>Credencial de elector</td>
			<td class='w3-center'><input type="radio" value="1" name="gr" id="cdel" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="gr" id="h" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="gr" id="bn" checked class='w3-check'></td>
		</tr>
		
		<tr>
			<td>Certificado de estudios</td>
			<td class='w3-center'><input type="radio" value="1" name="gl" id="cdugde" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="gl" id="mj" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="gl" id="fg" checked class='w3-check'></td>
		</tr>
		<tr>
			<td>Comprobante de domicilio</td>
			<td class='w3-center'><input type="radio" value="1" name="dk" id="cded" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="dk" id="mn" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="dk" id="ff" checked class='w3-check'></td>
		</tr>
		<tr id='tb_menor' hidden>
			<td>Identificación del padre o tutor</td>
			<td class='w3-center'><input type="radio" value="1" name="df" id="cdepot" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="2" name="df" id="hg" class='w3-check'></td>
			<td class='w3-center'><input type="radio" value="0" name="df" id="rr" checked class='w3-check'></td>
		</tr>

	</table>

	<div class='w3-half'>Promotor:</div>
	<select name="prom" class='w3-input w3-half'>
		<?php echo $prom; ?>
	</select>

	<br><br><br><br>
	<div align='right'><input type="submit" value="Guardar" class='w3-button w3-teal w3-round-large'></div>
	<br><br>
</form>

<div id="modal" class="modal">
	<div class="modal-content">
		<span id="closeModal" class="close dfrc">&times;</span>
		<p class='aviso title-groups'>Selecciona los días para el grupo</p>
		<form method='POST' id='sendGroup'>
			<label class="custom-checkbox">
				<input type="checkbox" value='Lunes' name='dias[]'/>
				<span></span>Lunes
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Martes' name='dias[]'/>
				<span></span>Martes
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Miercoles' name='dias[]'/>
				<span></span>Miercoles
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Jueves' name='dias[]'/>
				<span></span>Jueves
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Viernes' name='dias[]'/>
				<span></span>Viernes
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Sábado' name='dias[]'/>
				<span></span>Sábado
			</label>
			<label class="custom-checkbox">
				<input type="checkbox" value='Domingo' name='dias[]'/>
				<span></span>Domingo
			</label><br>
			<input class='style-box' type='hidden' name='carrera' value='' id='carreraHidden'>
			<a onclick="sendForm()" class='crearGrupo'>Crear</a>
		</form>
		<div class='separador'></div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/inscribe.js"></script>
</body>
</html>






