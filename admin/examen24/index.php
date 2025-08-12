<?php
    $error="";
    if($_GET){
        $error="Usuario y/o clave incorrecto";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="css/estilos_login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
</head>
<body> 
    <div class="container">
        <div class="header">
            <hr class="red-line">
            <hr class="blue-line">
        </div>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form id="login-form" method="POST" action="iniciaSesion.php">
                <label for="login-email">Correo Electrónico</label>
                <input type="email" id="login-email" name="email" required autocomplete="off">
                <label for="login-password">Contraseña</label>
                <div class="input-container">
                    <input type="password" id="login-password" name="password" required autocomplete="off">
                    <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" alt="icono de ojo" id="toggle-password">
                </div>
                <center><br>
                <?php echo $error; ?><br>
                    <button type="submit" name="login">Entrar</button>
                </center>
            </form>
            <p>¿Aún no te registras? <a href="#" id="show-register">Registrate</a></p>
        </div>

        <div class="register-container" style="display:none;">
            <h2>Registrate</h2>
            <form id="register-form" method="POST" action="iniciaSesion.php">
                <label for="register-name">Nombre</label>
                <input type="text" id="register-name" name="name" required autocomplete="off">
                <label for="register-ap1">Apellido Paterno</label>
                <input type="text" id="register-ap1" name="ap_paterno" required autocomplete="off">
                <label for="register-ap2">Apellido Materno</label>
                <input type="text" id="register-ap2" name="ap_materno" required autocomplete="off">
                <label for="register-email" >Correo Electrónico</label>
                <input type="email" id="register-email" name="email"  placeholder="Ejemplo@udimex.net" required autocomplete="off">
                <label for="register-password">Contraseña</label>
                <div class="input-container">
                    <input type="password" id="register-password" name="password" required autocomplete="off">
                    <img src="https://cdn-icons-png.flaticon.com/512/709/709612.png" alt="icono de ojo" id="toggle-register-password">
                </div>
                <center><br>
                    <button type="submit" name="register">Registrarse</button>
                </center>
            </form>
            <p>¿Ya tienes cuenta? <a href="#" id="show-login">Inicia Sesión</a></p>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('show-register').addEventListener('click', function () {
            document.querySelector('.login-container').style.display = 'none';
            document.querySelector('.register-container').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function () {
            document.querySelector('.login-container').style.display = 'block';
            document.querySelector('.register-container').style.display = 'none';
        });

        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('login-password');
        const toggleRegisterPassword = document.getElementById('toggle-register-password');
        const registerPasswordInput = document.getElementById('register-password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.src = type === 'password' ? 'https://cdn-icons-png.flaticon.com/512/709/709612.png' : 'https://as1.ftcdn.net/v2/jpg/08/55/54/28/1000_F_855542822_2v6fxMJ8IZWIfbhraJ8OBwWoUNjj6t9m.webp';
        });

        toggleRegisterPassword.addEventListener('click', function () {
            const type = registerPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            registerPasswordInput.setAttribute('type', type);
            this.src = type === 'password' ? 'https://cdn-icons-png.flaticon.com/512/709/709612.png' : 'https://as1.ftcdn.net/v2/jpg/08/55/54/28/1000_F_855542822_2v6fxMJ8IZWIfbhraJ8OBwWoUNjj6t9m.webp';
        });

    </script>
</body>
</html>