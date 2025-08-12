<?php
include("../consultas.php");
include("../todos.php");
cabeza(0);
//f_menu();
?>
	</head>
	<body>
<?php



if($_POST){
	g_mensaje($_POST['titulo'],$_POST['mensaje'],$_POST['caja']);
	echo "El mensaje se guardó";
	formulario($_POST['titulo'],$_POST['mensaje']);
}
else{
	formulario("","");
}



function formulario($titulo,$mensaje){
	echo "<form method='POST' action='mensaje_nuevo.php'> 

<center><br>

<table border=0><tr><td>Titulo:</td><td><input name='titulo' type='text' value='$titulo' size=30></td></tr>
<tr><td>Para:</td><td>
<select name='para'>
	<option value='0'>Público general</option>
	<option value='1'>Usuarios Registrados</option>
	<option value='3'>Grupo</option>
	<option value='4'>Alumno(s)</option>
</select>

</td></tr>
</table>

Mensaje:<br>
<TEXTAREA NAME='mensaje' COLS='45' ROWS='10'>$mensaje</TEXTAREA><br>

<input type='reset' Value='B O R R A R'> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Caja
<select name='caja'>
	<option value='1' default>1</option>
	<option value='2'>2</option>
	<option value='3'>3</option>
</select>
<input Value='<<< E N V I A R >>>' type='submit' ></form></center>";
}

?>
	</body>
</html>

