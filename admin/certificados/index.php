<?php
session_start();
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/certificados.php");
include($dir."db/admin.php");
include($dir."php/admin.php");
include($dir."db/usuario.php");

?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
carga_estilo2("../../");
usuario("../../",'index.php');
menu_i("../../");
?>

</head>
<style>

	.table-certificados {
		border:1px outset rgba(0, 0, 0, 0.2);
	}

	tr {
		vertical-align:middle
	}

	.guarda {
		width: 55px;
		height: 55px;
		border-radius: 50%;
		text-align: center;
		align-content: center;
		position: fixed;
		right: 20px;
		color: white;
		font-size: 20px;
		border: 3px outset gray;
		box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.6);
		background-color: rgb(213, 1, 1);
		bottom: 80px;
	}

	.guarda img {
		width: 55%;
		height: 55%;
	}

	.guardaNI {
		background-color: #dc3546;
		bottom: 150px;
	}

	.guardaIN {
		background-color: #fec107;
		bottom: 85px;
	}

	.CE {
		background-color: #188754;
		bottom: 20px;
	}

	.guardaNI:hover, .guardaIN:hover, .CE:hover{
		width: 60px;
		height: 60px;
		right: 18px;
		background-color: white;
		transition: all 500ms ease;
	}

	.separacion {
		width: 100%;
		height: 1px;
		border: 1px outset gray;
		box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.5);
	}
</style>

<?php
function opciones($op,$i){
	$op="<select name='op$i'>$op</select>";
	return $op;
}

$opciones="<option value='0' default> </option>";
$datos=busca_estados();
while($fila=mysqli_fetch_assoc($datos)){
	$opciones=$opciones."<option value='".$fila['id_estado']."'>".$fila['estado']."</option>";
}

$id=0;
$i=1;
$no_ingresado="";
$ingresado="";
$entregado="";
$datos2=busca_seguimiento_fecha();
while($fila2=mysqli_fetch_assoc($datos2)){
	$datos=busca_datos_seguimiento($fila2['id_usuario']);
	if($fila=mysqli_fetch_assoc($datos)){
		$op=opciones($opciones,$i);
		if ($fila['id_estado']<3){
			$no_ingresado=$no_ingresado."<tr>
				<td>".$fila['fecha']."</td>
				<td>".$fila['ap_pat']."</td>
				<td>".$fila['ap_mat']."</td>
				<td>".$fila['nombre']."</td>
				<td>".$fila['estado']."<br>".$fila['persona']."</td>
				<td>".$fila['observacion']."</td>
				<td>
					Estado:<br>$op<br>Observación:<br>
					<textarea name='obs$i' cols='40'></textarea>
				</td>
			</tr>
			<input type='hidden' value='".$fila['id_usuario']."' name='us$i'>";
		}

		if ($fila['id_estado']>2 && $fila['id_estado']!=8){
			$ingresado=$ingresado."<tr>
				<td>".$fila['fecha']."</td>
				<td>".$fila['ap_pat']."</td>
				<td>".$fila['ap_mat']."</td>
				<td>".$fila['nombre']."</td>
				<td>".$fila['estado']."<br>".$fila['persona']."</td>
				<td>".$fila['observacion']."</td>
				<td>
					Estado:<br>$op<br>Observación:<br>
					<textarea name='obs$i' cols='40'></textarea>
				</td>
			</tr>
			<input type='hidden' value='".$fila['id_usuario']."' name='us$i'>";
		}

		//Certificados entregados
		if ($fila['id_estado']==8){
			$entregado=$entregado."<tr>
				<td>".$fila['fecha']."</td>
				<td>".$fila['ap_pat']."</td>
				<td>".$fila['ap_mat']."</td>
				<td>".$fila['nombre']."</td>
				<td>".$fila['estado']."<br>".$fila['persona']."</td>
			</tr>
			";
		}

		$id=$fila['id_usuario'];
		$i++;
	}
}

$tabla = "<table class='table table-striped table-bordered text-center table-certificados";
$color1 = "table-danger'>";
$color2 = "table-warning'>";
$color3 = "table-success'>";

$encabezado="<tr>
				<th class='col-2'>Fecha</th>
				<th class='col-1'>Apellido Paterno</th>
				<th class='col-1'>Apellido Materno</th>
				<th class='col-1'>Nombre (s)</th>
				<th class='col-2'>Estado</th>";
$cierreT=	"</tr>";

$observaciones="<th class='col-2'>Observación</th>
				<th class='col-1'></th>
			</tr>";
		
$cierre="	<tr>
				<input type='hidden' value='$i' name='control'>";
$cierreT="	</tr>
		</table>";

$guardaNI = "<div class='guarda guardaNI'>	
				<img src='img/ban.svg' alt='ban' onclick='enviar_formNI()'>
			</div>";
$guardaIN = "<div class='guarda guardaIN'>	
				<img src='img/hourglass.svg' alt='ban' onclick='enviar_formIN()'>
			</div>";

$separacion= "<div class='separacion'></div>";

echo "	<div class='guarda CE'>	
			<a href='#CE'><img src='img/check-lg.svg' alt='ban'></a>
		</div>";

echo "<div class='container container-fluid' id='NI'>";
echo "<form method='POST' action='guarda.php' id='send_formNI'>
		<h3 class='text-center text-danger'>Trámite de Certificados <br>(NO INGRESADOS)</h3>";
echo "$tabla $color1 $encabezado $observaciones $no_ingresado $cierre $guardaNI $cierreT";
echo "</form>";

echo $separacion;
echo "<form method='POST' action='guarda.php' id='send_formIN'>
		<h3 class='text-center text-warning'>Trámite de Certificados <br>(INGRESADOS)</h3>";
echo "$tabla $color2 $encabezado $observaciones $ingresado $cierre $guardaIN $cierreT";
echo "</form>";

echo $separacion;
echo "<h3 class='text-center text-success' id='CE'>CERTIFICADOS ENTREGADOS<br>(INGRESADOS)</h3>$tabla $color3 $encabezado $cierre $entregado $cierreT";
echo "</table>";
?>

<script>
	function enviar_formNI(){
		let send_formNI =document.getElementById('send_formNI');
		send_formNI.submit();
	}

	function enviar_formIN(){
		let send_formIN =document.getElementById('send_formIN');
		send_formIN.submit();
	}
</script>