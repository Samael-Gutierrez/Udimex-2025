<?php 
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/promotor.php");
include("../../general/consultas/carreras.php");
include("../../general/consultas/usuario.php");
//permiso();
cabeza();
?>





<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='../../general/estilo/ad_estilo.css'>


</head>
<body>

<?php
usuario("../../",1);
menu_i();


// Busca nivel educativo y crea botón select
function nivel($compara){
	$nivel="";
	$datos=b_nivel();
	while($fila=mysqli_fetch_assoc($datos)){
		$add="";
		if ($fila['id_nivel']==$compara){
			$add='selected';
		}
		$nivel=$nivel."<option value='".$fila['id_nivel']."' $add>".$fila['nombre']."</option>";	
	}
	return $nivel;
}


// Busca promociones vigentes y crea botón select

function promocion($compara){
	
	$prom="<option value='0'>Ninguna</option>";
	$datos=b_promocion();
	while($fila=mysqli_fetch_assoc($datos)){
		$add='';
		if($compara==$fila['id_promocion']){
			$add='selected';
		}
		$prom=$prom."<option value='".$fila['id_promocion']."' $add>".$fila['nombre']."</option>";	
	}
	return $prom;
}


$datos=b_us($_SESSION["ad_id"]);
if($fila=mysqli_fetch_assoc($datos)){
	$correo=$fila['correo'];
}

$datos=busca_tel2($_SESSION["ad_id"]);
if($fila=mysqli_fetch_assoc($datos)){
	$tel=$fila['numero'];
}

echo "
<center><div style='width:90%' class='w3-margin w3-card'>
	<div class='w3-container w3-blue w3-margin' id='inicio'>
		<h3>Configura tus ligas de inscripción
		</h3>
	</div>

	<div style='width:50%'>
			<div class='w3-card'><h4 class='w3-blue'>Verifica que tu correo sea correcto</h4>
			Tu correo electrónico y teléfono será la forma en la que te avisaremos cuando un alumno se inscriba usando alguna de tus ligas, asegurate que sean correctos y recuerda mantenerlos actualizados.<br><br>
			<form method='POST' action='g_contacto.php'>
				<input type='email' value='$correo' name='correo' placeholder='e-mail'><input type='n' value='$tel' name='tel'  placeholder='Teléfono' maxlength='10'><input type='submit' value='Guradar'>
			</form><br>
	</div></div>";

	$datos=b_liga($_SESSION["ad_id"]);
	while($fila=mysqli_fetch_assoc($datos)){
		$nivel=nivel($fila['id_nivel']);
		$prom=promocion($fila['id_promocion']);
		$el="&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href='elimina.php?id=".$fila['id_liga']."' align='right'><img src='../../general/imagen/cerrarmenumovil.png' width='30px'></a>";
		formulario($nivel, $prom, $fila['id_liga'], $fila['inscripcion'], $fila['mensualidad'], $fila['certificado'], $fila['modalidad'], $fila['fi'], $fila['ff'], $fila['fc'],$el);
	
	}
	
	$fecha=date('Y-m-d');
	$nivel=nivel(3);
	$prom=promocion(0);
	formulario($nivel, $prom, 0, 0, 0, 'Examen único',0,$fecha,$fecha,$fecha,'');

echo "	
</div></center>";

function formulario($nivel, $prom, $tp, $ins, $mens, $cert, $mod, $fi, $ff, $fc, $el){

	$bt='Actualizar';
	if($tp<1){
		$bt='Guardar';
	}

	
	if($tp>0){
		$liga="https://udimex.net/inscribe?id=$tp";
	}
	else{
		$liga=" &nbsp; ";
	}


	$s1='';
	$s2='';
	if($mod==1){
		$s1='checked';
	}

	if($mod==2){
		$s2='checked';
	}
	if($mod==3){
		$s1='checked';
		$s2='checked';
	}

	echo "<div style='width:50%'>
		<div class='w3-card'><h2 class='w3-blue'>$liga $el</h2>

			
			<form method='POST' action='guarda.php'>
				<table>
					<tr>
						<td>Nivel:</td>
						<td><select name='nivel'>
							$nivel
						</select></td>
					</tr>
					<tr>
						<td>Inscripción:</td>
						<td>$ <input type='number' value='$ins' name='ins'></td>
					</tr>
					<tr>
						<td>Mensualidad:</td>
						<td>$ <input type='number' value='$mens' name='mens'></td>
					</tr>
					<tr>
						<td>Promoción:</td>
						<td><select name='prom'>
							$prom
						</select></td>
					</tr>
					<tr>
						<td>Forma de certificación:</td>
						<td><textarea name='cert'>$cert</textarea></td>
					</tr>
					<tr>
						<td>Modalidad:</td> 
						<td><input type='checkbox' value='1' name='pres' $s1> Presencial <br>
						<input type='checkbox' value='2' name='ln' $s2> En línea</td>
					</tr>
					<tr>
						<td>Fecha de<br>Inscripción</td>
						<td>
							Del <input type='date' name='fi' value='$fi'><br>
							Al &nbsp; <input type='date' name='ff' value='$ff'></td>
					</tr>
					<tr>
						<td>Inicio de clases </td>
						<td>&nbsp; &nbsp; &nbsp; <input type='date' name='fc' value='$fc'> </td>
					</tr>
					<input type='hidden' name='tp' value='$tp'>
					<tr>
						<td colspan='2'><input type='submit' value='$bt'></td>
					</tr> 
				</table>
			</form>

		</div><br><br>
	</div>";


}

?>

</body>
</html>
