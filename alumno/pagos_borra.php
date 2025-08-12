<?php
session_start(); 
include("../general/consultas.php");
include("../general/todos.php");
permiso();
if ($_SESSION['control']==1){
	pago_mat_borra($_GET['pago']);
	pago_borra($_GET['pago']);
	echo "<script type='text/javascript'> top.window.location='pagos_muestra.php'; </script>";
}
else{
	echo "	<body>
			<div id='degrada'>
				<div id='mensaje'>ELIMINAR PAGOS</div><br><br>
				<center><div id='error'>No tienes los privilegios necesarios para hacer esta operaci&oacute;n</div></center>
			</div>
		</body>
	</html>";
}
$_SESSION['control']=0;
?>

