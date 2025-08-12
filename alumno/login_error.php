<?php
include("../general/todos.php");
include("../consultas/general.php");
include("../consultas/basic.php");
cabeza(0);
f_menu();
?>
	</head>
	<body onload="cambia('m1');">
<?php
menu_i();
?>
		<div id=titulo>Error de Acceso !!!</div><br>
		<div id=cuerpo>
		
		El nombre de usuario y/o contraseña no es válido, verificalo y vuelve a intentar, si no recuerdas tu nombre de usuario 
		y/o contraseña da clic <a href='olvido.php'>AQUÍ</a><br><br>

		Si aún no esta registrado, puesde hacerlo haciendo clic <a href='javascript:bloquea();'>AQUÍ</a>


		</div>
		
		<br><br><br><br><br><br>
<?php
menu_c();
?>
	</body>
</html>

