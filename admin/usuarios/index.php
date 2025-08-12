<?php
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/usuario.php");
cabeza("Control de Usuarios","");
?>



<script>
	function bloquea(id) {
	    document.getElementById('bloquea').style.display='block';
	    document.getElementById('emergente'+id).style.display='block';
		document.getElementById('cfoc').focus();
	}
</script>







<body>

<?php

if ($_POST){

	if ($_POST['ct']==1){
		$id=$_POST['id'];
		$us=$_POST['us'];
		$nom=$_POST['nombre'];
		$ap=$_POST['ap_pat'];
		$am=$_POST['ap_mat'];
		$mail=$_POST['mail'];

		$clave=$_POST['clave'];

		a_us($id, $us, $nom, $ap, $am, $mail);

		if (strlen(trim($clave))>0){
			a_cl($us,$clave,0);
		}
	}


	if ($_POST['ct']==2){
		$nom=$_POST['nombre'];
		$ap=$_POST['ap_pat'];
		$am=$_POST['ap_mat'];
		$mail=$_POST['mail'];
		$us=$_POST['us'];
		$clave=$_POST['clave'];

		$id=guarda_usuario($us,$clave,$nom,$ap,$am,'0000-00-00',$mail);
		bitacora($id,"ALTA de usuario $nom $ap");

		if ($_POST['prof']==1){
			$datos=b_app("where id_area=1");
			while($fila=mysqli_fetch_assoc($datos)){
				g_acc($id,$fila['id_app']);
			}
		}

		if ($_POST['ad']==1){
			$datos=b_app("where not(id_area=1)");
			while($fila=mysqli_fetch_assoc($datos)){
				g_acc($id,$fila['id_app']);
			}	
		}
	}

	if ($_POST['ct']==3){
		$us=$_POST['us'];
		q_us($us);
		q_acc($us);
	}

	if ($_POST['ct']==4){
		$id=$_POST['id'];
		$max=$_POST['max'];
		q_acc($id);
		for($i=1; $i<=$max; $i=$i+1){
			$app=$_POST['ap'.$i];
			if ($app>0){
				g_acc($id,$app);
			}
		}
	}
header("location:../usuarios");
}
else{


	usuario("../../","index.php");
	echo "<center>";
	menu_i();
	echo "<br><br><br><br>
		<fieldset id='subtitulo'>CONTROL DE USUARIO</fieldset>";

	$datos=b_ad();
	while($fila=mysqli_fetch_assoc($datos)){
		$capa='emergente'.$fila['id_usuario'];
		echo "<div id='$capa' class='emergente'><br>
		<font size='6'>MODIFICAR USUARIO</font><hr><br><br>
		<form method='POST'>
			<input type='hidden' name='id' value='".$fila['id_usuario']."'>
			<input type='text' name='nombre' placeholder='Nombre' required='required' value='".$fila['nombre']."'>
			<input type='text' name='ap_pat' placeholder='Apellido Paterno' required='required' value='".$fila['ap_pat']."'>
			<input type='text' name='ap_mat' placeholder='Apellido Materno' value='".$fila['ap_mat']."'>
			<br><hr>
			<table border='0'>
				<tr>
					<td>e-mail: </td>
					<td><input type='mail' name='mail' placeholder='Correo electrónico' value='".$fila['correo']."'></td>
				</tr>
				<tr>
					<td>Usuario: </td>
					<td><input type='text' name='us' placeholder='Usuario' required='required' value='".$fila['usuario']."'></td>
				</tr>
				<tr><td>Contraseña: </td><td><input type='text' name='clave' placeholder='Clave'></td></tr>
			</table>
			<input type='hidden' name='ct' value='1'>
		<input type='submit' value='Actualizar'> &nbsp; &nbsp; &nbsp;<a href=''><input type='button' value='Cancelar'></a>
		</form></div>";

		

		// BUSCA LAS ÁREAS EXISTENTES
		$datos2=b_area();
		$i=1;
		$areas="";
		$app="";
		while($fila2=mysqli_fetch_assoc($datos2)){
			$areas=$areas."<th>".$fila2['descripcion']."</th>";
			//Busca aplicaciones por área
			$datos3=b_app('where id_area='.$fila2['id_area']);
			$app=$app."<td>";
			while($fila3=mysqli_fetch_assoc($datos3)){
				$datos4=b_pus($fila['id_usuario'], $fila3['id_app']);
				$fila4=mysqli_fetch_assoc($datos4);
				$ch="";
				if($fila4['r']>0){
					$ch=" checked";
				}
				
				$app=$app."<input type='checkbox' name='ap$i' value='".$fila3['id_app']."' $ch> ".$fila3['nombre']."<br>";
				$i=$i+1;
			}
			$app=$app."</td>";
			//-------------------------------
		}
		//-------------------------------



		echo "<table border='0' width='80%'>
			<tr>
				<th colspan='5'>
					<br><br>
					<form method='POST'>
						".$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']."
						<input type='button' onclick='bloquea(".$fila['id_usuario'].")' value='Editar'>
						<input type='hidden' value='3' name='ct'>
						<input type='hidden' value='".$fila['id_usuario']."' name='us'>
						<input type='submit'  value='X'>
					</form><br><br>
				</th>
			</tr>
			
			<tr>
				<form method='POST'>
				$areas
				<th rowspan='3'>
					<input type='hidden' name='ct' value='4'>
					<input type='hidden' name='max' value='$i'>
					<input type='hidden' name='id' value='".$fila['id_usuario']."'>
					<input type='submit' value='Guardar'>
				</th>
			</tr>
			<tr>
				$app
			</tr>
			
			</form>
			</table><hr>";
	}



}

?>
<input type='button' onclick='bloquea(0)' value='Nuevo Usuario'>

	<div id='emergente0' class='emergente'><br>
		<div align='center'><font size='6'>NUEVO USUARIO</font><hr><br><br>
			<form method='POST'>
				<input type='text' name='nombre' placeholder='Nombre' required='required' id='cfoc'>
				<input type='text' name='ap_pat' placeholder='Apellido Paterno' required='required'>
				<input type='text' name='ap_mat' placeholder='Apellido Materno'><hr>
				
				Tipo: &nbsp;<input type='checkbox' value='1' name='prof' checked> Profesor <input type='checkbox' value='1' name='ad'> Administrador<hr>
				<table border='0'>
					<tr><td>e-mail: </td><td><input type='mail' name='mail' placeholder='Correo electrónico'></td></tr>
					<tr><td>Usuario: </td><td><input type='text' name='us' placeholder='Usuario' required='required'></td></tr>
					<tr><td>Contraseña: </td><td><input type='text' name='clave' placeholder='Clave' required='required'></td></tr>
				</table>
			
				<input type='hidden' name='ct' value='2'><br>
				<input type='submit' value='Guardar'>&nbsp; &nbsp; &nbsp;<a href=''><input type='button' value='Cancelar'></a>
			</form>
			 
		</div>
	</div>
	<div id='bloquea' class='bloquea'>&nbsp;</div>

	

	
