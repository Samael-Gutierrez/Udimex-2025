<?php
include("../general/todos.php");
include("../consultas/general.php");
include("../consultas/basic.php");
cabeza(0);
f_menu();
?>
	</head>
	<body onload="cambia('m2');">
<?php
menu_i();
?>
		<div id=titulo>Debes iniciar sesión !!!</div><br>
		<div id=cuerpo>

		Esta área requiere que inicies tu sesión de usuario, si aún no estas registrado puedes hacerlo ahora haciendo clic <a href='inscripcion.php'>AQUÍ</a><br><br>
		
		Si ya estás registrado pero no recuerdas tu nombre de usuario y/o contraseña da clic <a href='olvida.php'>AQUÍ</a><br><br>


<form method='POST' action='login.php' align='center'>
						Usuario:<br><input type='text' name='us'><br>
						Clave:<br><input type='password' name='pas'><br>
						<p align='center'>

						<input type='submit' value='Entrar' id='boton'></p>
					
					</form>

		</div>
		
		<br><br><br><br><br><br>
<?php
menu_c();
?>
	</body>
</html>

