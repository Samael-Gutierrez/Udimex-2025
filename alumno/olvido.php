<?php
include("../general/todos.php");
include("../general/consultas.php");
cabeza(0);
f_menu();
?>

<meta name="description" content="¿Has olvidado tu contraseña?. No te preocupes, solo llena el siguiente formulario y con gusto te ayudaremos a recuperar tu clave.">
	</head>
	<body onload="cambia('m2');">
<?php
menu_i();

if ($_POST){
	$mail=$_POST['mail'];
	$datos=b_correo($mail);
	$fila=mysqli_fetch_assoc($datos);
	$cad=aleatorio(6);
	if ($fila['cuenta']>0){
		$tema="Recuperación de acceso - UDIMEX";
		$msg="Haz clic en la siguente dirección para recuperar tu cuenta\n\n http://udimex.net/recupera.php?cad=$cad";
		mail($mail,$tema,$msg);
		ev_guar($mail,$cad,0,5);
		echo "<center><font color='#669966'>Revisa tu correo electrónico porfavor</font></center>";
	}
	else{
		recupera($mail,"<font color='#996666'>No se encontró el correo electrónico, verrificalo e intenta de nuevo</font>");
	}
}
else{
	recupera("","");
}


function recupera($mail,$men){
echo "<center>
<div id='mensaje'>Escribe tu dirección de correo electrónico, revisa tu bandeja de entrada, en breve recibirás instrucciones para recuperar tu acceso</div><br>$men<br><br>
<form method='POST'>
	e-mail: <input type='email' name='mail' value='$mail'><br><br>
	<input type='submit' value='Recuperar'>
</form></center>";

}



		

menu_c();
?>
	</body>
</html>

