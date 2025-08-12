  <?php
	$error="<br>";
	$correo="";
	if($_GET){
		$correo=$_GET['c'];
		if($_GET['error']==1){
			$error="<br>El correo no es correcto";
		}
		if($_GET['error']==2){
			$error="<br>La clave no es correcta";
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración Electrónica Educativa</title>
  <style>
    /* Estilos generales */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #ffffff; /* Fondo blanco */
      font-family: 'Arial', sans-serif;
      flex-direction: column; /* Alinear elementos verticalmente */
      overflow: hidden; /* Evitar desbordamiento durante la transición */
    }

    /* Contenedor del logotipo */
    .logo {
      text-align: center;
      margin-bottom: 20px; /* Espacio entre el texto y los círculos */
    }

    /* Estilos para el texto principal "ADELE" */
    .logo .main-text {
      font-size: 60px;
      font-weight: bold;
      color: #0077B6; /* Azul */
      text-transform: uppercase;
      margin-bottom: 10px;
    }

    /* Estilos para la descripción */
    .logo .sub-text {
      font-size: 18px;
      color: #333333; /* Gris oscuro */
      text-transform: uppercase;
      letter-spacing: 2px;
    }

    /* Contenedor de la animación */
    .loader {
      display: flex;
      gap: 10px; /* Espacio entre los círculos */
      opacity: 1; /* Inicialmente visible */
      transition: opacity 1s ease-in-out; /* Transición de difuminado */
    }

    /* Estilos para los círculos */
    .circle {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background-color: #0077B6; /* Azul */
      animation: bounce 1.4s infinite ease-in-out;
    }

    /* Círculo 2 (verde) */
    .circle:nth-child(2) {
      background-color: #00B74A; /* Verde */
      animation-delay: 0.2s;
    }

    /* Círculo 3 (naranja) */
    .circle:nth-child(3) {
      background-color: #FF6F00; /* Naranja */
      animation-delay: 0.4s;
    }

    /* Círculo 4 (rojo) */
    .circle:nth-child(4) {
      background-color: #FF3D00; /* Rojo */
      animation-delay: 0.6s;
    }

    /* Animación de rebote */
    @keyframes bounce {
      0%, 80%, 100% {
        transform: translateY(0);
      }
      40% {
        transform: translateY(-20px);
      }
    }

    /* Contenedor del formulario de login (inicialmente oculto) */
    .login-container {
      opacity: 0; /* Inicialmente invisible */
      visibility: hidden; /* Ocultar completamente */
      transition: opacity 1s ease-in-out, visibility 1s ease-in-out; /* Transición suave */
      text-align: center;
      margin-top: 20px; /* Espacio entre los círculos y el formulario */
    }

    /* Estilos para el formulario de login */
    .login-container h2 {
      font-size: 24px;
      color: #0077B6; /* Azul */
      margin-bottom: 20px;
    }

    .login-container input {
      width: 200px;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #0077B6; /* Borde azul */
      border-radius: 5px;
      font-size: 16px;
    }

    .login-container button {
      padding: 10px 20px;
      background-color: #0077B6; /* Azul */
      color: #ffffff; /* Blanco */
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .login-container button:hover {
      background-color: #005f8a; /* Azul más oscuro al pasar el mouse */
    }

    /* Estilos para el enlace de registro */
    .login-container a {
      display: block;
      margin-top: 10px;
      color: #0077B6; /* Azul */
      text-decoration: none;
      font-size: 14px;
    }

    .login-container a:hover {
      text-decoration: underline; /* Subrayado al pasar el mouse */
    }
  </style>
</head>
<body>
  <!-- Contenedor del logotipo y círculos de carga -->
  <div class="logo">
    <div class="main-text">ADELE</div>
    <div class="sub-text">Administración Educativa Electrónica</div>
  </div>
  <div class="loader">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
  </div>

  <!-- Contenedor del formulario de login (inicialmente oculto) -->
  <div class="login-container">
    <h2><hr></h2>
        <form action="login.php" method="POST">
			<?php echo "<input type='text' id='correo' name='correo' value='$correo' required placeholder='Correo'>"; ?>
            
            <input type="password" id="clave" name="clave" required placeholder='Clave'>

            <button type="submit" class="boton">Iniciar Sesión</button>
            <center>
                <div class='error'><?php echo $error; ?></div>
                <br><br>

      
            </center>
        </form>
    <a href="registrar.php">¿No tienes cuenta? Regístrate aquí</a>
	<a href="olvido.php" class="liga">¿Olvidaste tu contraseña?</a>
  </div>

  <script>
    // Ocultar los círculos y mostrar el formulario de login después de 8 segundos
    setTimeout(() => {
      // Difuminar los círculos
      document.querySelector('.loader').style.opacity = 0;

      // Mostrar el formulario de login
      setTimeout(() => {
        document.querySelector('.login-container').style.opacity = 1;
        document.querySelector('.login-container').style.visibility = 'visible';
      }, 1000); // Esperar 1 segundo para la transición
    }, 5000); // 8 segundos
  </script>
</body>
</html>