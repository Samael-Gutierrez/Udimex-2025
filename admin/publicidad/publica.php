<!DOCTYPE>
<html>
<head>
<style>
	button{
		padding:10% 0%;
		width:100%;
	}

</style>
</head>
<?php
include ("db/basicas.php");
include ("db/publicidad.php");
include ("db/acciones.php");
include ("funciones.php");

antierror("..");

$datos=buscaPublicidad();
if($fila=mysqli_fetch_assoc($datos)){
	if(isset($fila['id_publicidad'])){
		$texto=$fila['contenido'];
		$imagen=$fila['imagen'];
		
		//actualiza numero de grupos
		actualiza_grupos2($fila['id_publicidad']);
		
		$estricto=0;
		if($fila['lugar']==2){
		    $estricto=1;
		}

		$datos2=busca_grupo($fila['lugar'],$estricto);
		$fila2=mysqli_fetch_assoc($datos2);
		if(isset($fila2['id_grupo'])){
			$grupo=$fila2['liga'];
			a_acceso($fila2['id_grupo']);
		}
		tabla($grupo,$imagen,$texto);
		
	}
}
else{
	//Desativa la publicidad
	actualiza_accion(1, 1, 1);

	header("location:http://localhost/01_Plataforma/IA/fin.html");
}


function tabla($grupo,$imagen,$texto){
	echo "
	<body>
	<table border='1' width='100%' align='center'>
		<tr height='50%'>
			<td width='50%' valign='top'>
				<a href='$grupo' target='_blank'><button>Ir al grupo</button></a>
			</td>
			<td width='50%' rowspan='2' align='right'>
			<img src='img/$imagen' width='100%' height='500px'>
			</td>
		</tr>
		<tr height='50%'>
			<td><textarea cols='100%' rows='29%'>$texto</textarea></td>
		</tr>
	</table>";
}

//				

?>

</body>
</html>
