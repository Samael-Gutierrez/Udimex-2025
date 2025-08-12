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
	if (isset($_POST['estado'])){
		$estado=1;
	}
	else{
		$estado=0;
	}
	$datos=a_mensaje($_POST['id'],$_POST['titulo'],$_POST['mensaje'],$_POST['caja'],$estado);
	echo "<script type='text/javascript'> top.window.location='mensaje.php'; </script>";
}
else{
	if($_GET){
		$datos=b_mensaje3($_GET['msg']);
		$fila=mysqli_fetch_assoc($datos);
		formulario($fila['id_mensaje'],$fila['titulo'],$fila['texto'],$fila['caja'],$fila['estado']);
	}
}



function formulario($id,$titulo,$mensaje,$caja,$estado){
	if ($estado==1){
		$r="checked";
	}
	else{
		$r="";
	}
	echo "<form method='POST'> 

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

<input type='checkbox' name='estado' value='1' $r>Mensaje Activo
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Caja
<select name='caja'>
	<option value='1' default>1</option>
	<option value='2'>2</option>
	<option value='3'>3</option>
</select>
<input type='text' Value='$id' name='id' >
<input Value='<<< Actualizar >>>' type='submit' ></form></center>";
}

?>
	</body>
</html>

