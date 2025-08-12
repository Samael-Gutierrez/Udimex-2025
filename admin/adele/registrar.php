<?php
session_start();
include('general/db/conecta.php');
include('general/db/usuario.php');

	$nombre="";
	$ap="";
	$am="";
	$email="";
	$tel="";
	$error="";
	
if ($_POST){
	$nombre=trim($_POST['nombre']);
	$ap=trim($_POST['ap']);
	$am=trim($_POST['am']);
	$email=trim($_POST['correo']);
	$tel=trim($_POST['tel']);
	$clave=trim($_POST['clave']);
	
	$datos=busca_usuario($email);
	if($fila=mysqli_fetch_assoc($datos)){
		$error="<li>El correo electronico ya ha sido registrado anteriormente, 
		selecciona otro o recupera tu clave</li>";
	}
	else{
		$clave=password_hash($clave, PASSWORD_DEFAULT); 
		$id=guarda_usuario($nombre,$ap,$am,$email,$clave);
		guarda_telefono($id,$tel);
		activa_aplicacion($id,1,'3000/01/01');
		
		$_SESSION['id']=$id;
		$_SESSION['nombre']=$nombre;
		$_SESSION['ap']=$ap;
		$_SESSION['am']=$am;
		header("location:inicio");
	}
	
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="general/css/estilo.css">
    <title>Registro</title>
</head>
<body>
    <div class="contenedor-login">
        <h2 class="titulo">Formulario de Registro</h2>
        <form method='POST' id='registroForm'>
            <label for="nombre" class="etiqueta">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required onfocusout='cadenaVacia(0,"nombre","El nombre");' value='<?php echo $nombre; ?>'>

            <label for="ap" class="etiqueta">Apellido Paterno:</label>
            <input type="text" id="ap" name="ap" required onfocusout='cadenaVacia(0,"ap","El apellido paterno");' value='<?php echo $ap; ?>'>

            <label for="am" class="etiqueta">Apellido Materno:</label>
            <input type="text" id="am" name="am" required onfocusout='cadenaVacia(0,"am","El apellido materno");' value='<?php echo $am; ?>'>

            <label for="correo" class="etiqueta">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required onfocusout='cadenaVacia(0,"correo","El correo"); validaCorreo(0);' value='<?php echo $email; ?>'>

            <label for="tel" class="etiqueta">Celular:</label>
            <input type="number" id="tel" name="tel" required onfocusout='cadenaVacia(0,"tel","El número de celular");validaTel(0);' value='<?php echo $tel; ?>'>

            <label for="clave" class="etiqueta">Contraseña:</label>
            <input type="password" id="clave" name="clave" required onfocusout='cadenaVacia(0,"clave","La contraseña");'>

            <label for="repetir_clave" class="etiqueta">Repetir Contraseña:</label>
            <input type="password" id="repetir_clave" name="repetir_clave" required onkeyup='validarClave(0);'>

            <ul id="errorMensaje" class="error"><?php echo $error; ?></ul>

            <button type="submit" class="boton" onclick='envia();'>Registrarse</button>
        </form>
    </div>

    <script>
		let error=0;
		
		function errores(mensajeError,tipo){
			const errorMensaje = document.getElementById('errorMensaje');
			
			//Validacion individual
			if (tipo==0){
				errorMensaje.innerHTML=mensajeError;
			}
			
			//Validacion final
			if (tipo==1){
				errorMensaje.innerHTML=errorMensaje.innerHTML + mensajeError;

			}
			
		}
		
		function cadenaVacia(tipo,campo,nombre) {
            const cadena = document.getElementById(campo).value;
			mensajeError="";
            if (cadena.length==0) {
				mensajeError = '<li>' + nombre + ' no puede estar en blanco</li>';
				error=error+1;
			} 
			
			errores(mensajeError,tipo)
        }
		
		function validaCorreo(tipo) {
            const cadena = document.getElementById('correo').value;
			dominio="@utzin.edu.mx";
			mensajeError="";
            if (!cadena.endsWith(dominio)){
				mensajeError = '<li>El correo no pertenece a la Universidad</li>';
				error=error+1;
			} 
			
			errores(mensajeError,tipo)
        }
		
		
        function validarClave(tipo) {
			control=0;
            const clave = document.getElementById('clave').value;
            const repetirClave = document.getElementById('repetir_clave').value;
			mensajeError ='';

            if (clave !== repetirClave) {
				control=1;
			}
			
			if (control>0){
				error=error+1;
				mensajeError ='<li>Las contraseñas no coinciden. Por favor, verifica.</li>';
			}

			errores(mensajeError,tipo)
        }
		
		function validaTel(tipo) {
            cadena = document.getElementById('tel').value;
			cadena=cadena.replace(/\s+/g, "");
			document.getElementById('tel').value=cadena;
			mensajeError="";
            if (cadena.length!=10) {
				mensajeError = '<li>El número celular debe de ser de 10 dígitos</li>';
				error=error+1;
			} 
			
			errores(mensajeError,tipo)
        }		
		
		
		function envia(){
			document.getElementById('errorMensaje').innerHTML="";
			cadenaVacia(1,"nombre","El nombre");
			cadenaVacia(1,"ap","El apellido paterno");
			cadenaVacia(1,"am","El apellido materno");
			cadenaVacia(1,"correo","El correo");
			cadenaVacia(1,"clave","La contraseña");
			validaCorreo(1);
			validarClave(1);
			if (error==0){
				document.getElementById('registroForm').submit();
			}
		}
    </script>
</body>
</html>
