<?php
session_start();
include('../funciones.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/carreras.php');
?>



<!DOCTYPE HTML>
<html>
<head>
	<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
	<meta charset='utf-8'>

	<?php
	cabeza('../');
	?>
	<title>Inscripciones</title>

	<script>
	$(document).ready(function(){  
		$('#nom').keyup(function() {  
			$.ajax({  
				url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(),  
				success: function(data) {  
					$('#resultado').html(data);
				}  
			});  
		}); 
	}); 

	function valida(c){
		error=0;
		if(c==1){
			v=1;
			nombre=document.getElementById('nombre').value.trim();
			if(nombre.length<1){
				document.getElementById('nombre').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('nombre').style.backgroundColor='white';
			}

			nombre=document.getElementById('ap_pat').value.trim();
			if(nombre.length<1){
				document.getElementById('ap_pat').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('ap_pat').style.backgroundColor='white';
			}

			nombre=document.getElementById('fn').value.trim();
			if(nombre.length<1){
				document.getElementById('fn').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('fn').style.backgroundColor='white';
			}

			nombre=document.getElementById('calle').value.trim();
			if(nombre.length<1){
				document.getElementById('calle').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('calle').style.backgroundColor='white';
			}

			nombre=document.getElementById('numero').value.trim();
			if(nombre.length<1){
				document.getElementById('numero').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('numero').style.backgroundColor='white';
			}

			nombre=document.getElementById('colonia').value.trim();
			if(nombre.length<1){
				document.getElementById('colonia').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('colonia').style.backgroundColor='white';
			}

			nombre=document.getElementById('municipio').value.trim();
			if(nombre.length<1){
				document.getElementById('municipio').style.backgroundColor='red';
				error=1;
			}
			else{
				document.getElementById('municipio').style.backgroundColor='white';
			}

			campo=document.getElementById('mail').value.trim() + document.getElementById('tel').value.trim();
			if(campo.length<1){
				document.getElementById('mail').style.backgroundColor='yellow';
				document.getElementById('tel').style.backgroundColor='yellow';
				document.getElementById('adv').innerHTML='Debes colocar por lo menos un medio de contacto';
				error=1;
			}
			else{
				document.getElementById('mail').style.backgroundColor='white';
				document.getElementById('tel').style.backgroundColor='white';
				document.getElementById('adv').innerHTML=' ';
			}

			var fn = new Date(document.getElementById('fn').value);
			var fa = new Date();

			var dif = fa.getTime()-fn.getTime();
			
			menor=((dif/(365*24*60*60*1000))-18);
			if (menor<0){
				document.getElementById('menor').style.display='block';
				if(menor+0.6>=0){
					document.getElementById('ema').innerHTML='El alumno puede entrar a plan de 6 meses';
				}
				else{
					document.getElementById('ema').innerHTML=' ';
					v=0;
				}
			}
			else{
					document.getElementById('menor').style.display='none';
			}

			for(i=1; i<=document.getElementById('l_car').value; i++){
				document.getElementById('op'+i).style.display='block';
			}
			

			if(v==0){
				for(i=1; i<=document.getElementById('l_car').value; i++){
					if(document.getElementById('tp'+i).value>9){
						document.getElementById('op'+i).style.display='none';
					}
				}
			}
		}
	}
	</script>
</head>
<body>
	<?php
		usuario("../../",1);
		menu_i();

		$i=0;
		$carreras="";
		$datos=b_carrrera(1);
		while($fila=mysqli_fetch_assoc($datos)){
			$i=$i+1;
			$carreras=$carreras.
			"<div id='op$i'>
				<input type='checkbox' value='".$fila['id_carrera']."' name='op$i' id='c$i'> ".$fila['nombre'].
				"<input type='text' value='".$fila['tipo']."' id='tp$i'>
			</div>";
		}
		$l_car=$i;
	
	?>


	<center>
	Formato de Registro
	<form method='POST'>
		<div id='generales' class='caja'>
			Datos Generales
			<input type="text" name="nombre" id="nombre" placeholder="Nombre(s)">
			<input type="text" name="ap_pat" id="ap_pat" placeholder="Apeliido Paterno">
			<input type="text" name="ap_mat" id="ap_mat" placeholder="Apeliido Materno">
			<input type="date" name="fn" id="fn"  value="" min="1950-01-01" max="2020-12-31">
			<input type="text" name="calle" id="calle" placeholder="Calle">
			<input type="text" name="numero" id="numero" placeholder="Número">
			<input type="text" name="colonia" id="colonia" placeholder="Colonia">
			<input type="text" name="municipio" id="municipio" placeholder="Municipio o Localidad">
			<input type="text" name="estado" id="estado" placeholder="Estado" value='México'>
			<input type="text" name="tel" id="tel" placeholder="Teléfono">
			<input type="email" name="mail" id="mail" placeholder="Correo Electrónico">
			<div id='adv'> </div>
			<button type="button" onclick='valida(1);'>Siguiente</button>
		</div>
		<div>Datos Escolares
		Nivel Educativo:
<?php 
	echo $carreras."<input type='text' value='$l_car' name='l_car' id='l_car'>";
?>

   <p>Modalidad</p>


    <input type="radio" id="linea" name="mod" value="1"> En Línea
    <input type="radio" id="pres" name="mod" value="2"> Presencial


     <p>Fecha de Inicio</p><input type="date" name="trip-start" id="start"  value="2018-07-22"
       min="1998-01-01" max="2030-12-31">
<label for="inscripcion"><input type="number" name="inscripcion" id="inscripcion" placeholder="Inscripcion">
   <label for="colegiatura"><input type="number" name="colegiatura" id="colegiatura" placeholder="Colegiatura">

<div id='menor' hidden>
	 <h4>El alumno es menor de edad</h4>
	<h4 id='ema'> </h4>
	<label for="nombrep"><input class="step__input type="text" name="nombrep" id="nombre" placeholder="Nombre padre o tutor">
	<label for="telefono"><input class="step__input type="text" name="telefono" id="telefono" placeholder="Telefono">
	   <label for="correo"><input type="email" name="correo" id="correo" placeholder="Correo">
	<form>


                        <textarea rows="4" cols="80" placeholder="Dirección" class="step__input"></textarea>
                    </div>


                    <div class="step__footer">
                        <button type="button" class="step__button step__button--back" data-to_step="1" data-step="2">Regresar</button>
                        <button type="submit" class="step__button step__button--next" data-to_step="3" data-step="2">Siguiente</button>
                    </div>
                </div>
                <div class="step" id="step-3">
                    <div class="step__header">
                        <h2 class="step__title">Documentos  a entregar<small></small></h2>
                    </div>
                    <div class="step__body">
<h4>CURP</h4>


    Sube tu archivo:

    <input type="file" name="archivosubido">

  </p>
</br>
  <h4>Acta de Nacimiento</h4>
     <p>

    Sube un archivo:

    <input type="file" name="archivosubido">

  </p>
       </br>
  <h4>Credencial de elector(En caso de ser menor de edad anexar la del Padre o Tutor)</h4>
<p>

    Sube un archivo:

    <input type="file" name="archivosubido">

  </p>
</br>
  <h4>Certificado de secundaria</h4>
      <p>

    Sube un archivo:

    <input type="file" name="archivosubido">

  </p>
   </br>
  <h4>Comprobante de Domicilio(Agua, Luz, Teléfono etc..)</h4>
      
  <p>

    Sube un archivo:

    <input type="file" name="archivosubido">
 </p>



                    </div>
                    <div class="step__footer">
                        <button type="button" class="step__button step__button--back" data-to_step="2" data-step="3">Regresar</button>
                        <button type="submit" class="step__button">Registrarse</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="js/app.js"></script>
</body>
</html>
