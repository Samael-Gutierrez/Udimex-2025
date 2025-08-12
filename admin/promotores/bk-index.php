<?php 
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/promotor.php");
//permiso();
cabeza();
?>


<script>
	function emergente(){
		document.getElementById('bloquea').style.display='block';
		document.getElementById('emergente').style.display='block';
		document.getElementById('banco').focus();
		
	}

	function cancela(){
		document.getElementById('bloquea').style.display='none';
		document.getElementById('emergente').style.display='none';
	}

</script>

<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='../../general/estilo/ad_estilo.css'>
<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<!-- Popper JS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>
<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>

</head>
<body>

<?php
usuario("../../",1);
menu_i();

$al="";
$total=0;
$anual=0;
$mensual=0;
$mensualAnt=0;

$datos=b_us_ins($_SESSION["ad_id"]);
while($fila=mysqli_fetch_assoc($datos)){
	$ct=0;
	$comision=0;
	if ($fila['concepto']=='Colegiatura'){
		$ct=1;
		if ($fila['colegiatura']>0){
			$comision=$fila['cantidad']/$fila['colegiatura']*100;
		}
		else{
			$comisicon=0;
		}
	}


	if ($fila['concepto']=='Inscripción'){
		$ct=1;
		if ($fila['inscripcion']>0){
			$comision=$fila['cantidad']/$fila['inscripcion']*200;
		}
		else{
			$comisicon=0;
		}
	}

	if ($ct==1){
		$cant=number_format($comision, 2, '.', ',');
		$al=$al."<tr><td>".$fila['nombre']."</td><td>".$fila['f_pago']."</td><td>".$fila['concepto']."</td><td>$ $cant</td></tr>";
	}

	$fecha = explode("-", $fila['f_pago']);
	$total=$total+$comision;
	if ($fecha[0]==date('Y')){
		$anual=$anual+$comision;
		if ($fecha[1]==date('m')){
			$mensual=$mensual+$comision;
		}

		if ($fecha[1]==date('m')-1){
			$mensualAnt=$mensualAnt+$comision;
		}
	}


}

$sol="";
$solicitado=0;
$datos=b_pago($_SESSION["ad_id"], 0);
while($fila=mysqli_fetch_assoc($datos)){
	$cant=number_format($fila['cantidad'], 2, '.', ',');
	$sol=$sol."<tr><td>".$fila['f_sol']."</td><td>".$fila['cta']."</td><td>$ $cant</td><td><a href='manda.php?ct=1&val=".$fila['id_egreso']."'><img src='../../general/imagen/cierra.png' width='20px'></a></td></tr>";
	$solicitado=$solicitado+$fila['cantidad'];
}

$pagos="";
$pagado=0;
$datos=b_pago($_SESSION["ad_id"], 1);
while($fila=mysqli_fetch_assoc($datos)){
	$cant=number_format($fila['cantidad'], 2, '.', ',');
	$pagos=$pagos."<tr><td>".$fila['f_sol']."</td><td>".$fila['f_at']."</td><td>$ $cant</td><td>".$fila['cta']."</td><td></td></tr>";
	$pagado=$pagado+$fila['cantidad'];
}

$dis=$total-$pagado-$solicitado;


$disponible=number_format($dis, 2, '.', ',');
$mensual=number_format($mensual, 2, '.', ',');
$anual=number_format($anual, 2, '.', ',');
$total=number_format($total, 2, '.', ',');
echo "
	<div class='container p-3 my-3 bg-primary text-white' id='inicio'><h1 align='center'>PROMOTORES</h1></div>
	<div class='container p-3 my-3 border'>
		<center>
			<div class='d-inline-flex p-3 bg-white text-white'>
				<div class='p-2 bg-success' align='center'>
					<h3>Disponible:  </h3>
					<h4>$ $disponible<br></h4>
					<input type='button' value='Retirar' class='btn btn-danger' onclick='emergente();'>
				</div>
			</div><br>
		
			<div class='d-inline-flex p-3 bg-white text-white'>
				<div class='p-2 bg-info' align='center'><h6>Ganancia de este mes:</h6><h3>$ $mensual</h3></div> &nbsp;  &nbsp;  &nbsp;  &nbsp; 
				<div class='p-2 bg-warning' align='center'><h6>Ganancia mes anterior:</h6><h3>$ $mensualAnt</h3></div> &nbsp;  &nbsp;  &nbsp;  &nbsp; 
				<div class='p-2 bg-primary' align='center'><h6>Ganancia de este año:</h6><h3>$ $total</h3></div>
			</div>
		</center>
	
		<br><hr>";

		if ($sol!=""){
			echo "<div class='p-2 bg-primary text-white' id='retiro'><h4 align='center'>Solicitudes de retiro</h4></div><br>
			<table border='1' align='center'>
				<tr><th>Fecha de solicitud</th><th>Cuenta</th><th>Cantidad</th><td></td></tr>
				$sol
			</table><br><br><br>";
		}

		if ($pagos!=""){
			echo "
			<div class='p-2 bg-primary text-white'><h4 align='center'>Mis Pagos recibidos</h4></div><br>
			<table border='1' align='center'>
				<tr><th>Fecha de solicitud</th><th>Fecha de pago</th><th>Cantidad</th><th>Cuenta</th><th>Recibo</th></tr>
				$pagos
			</table><br><br><br>";
		}

		$banco="";
		$cta="";

		$prom=$_SESSION["ad_id"];
		$datos=b_cuenta($prom);

		if($fila=mysqli_fetch_assoc($datos)){
			$banco=$fila['banco'];
			$cta=$fila['cuenta'];
		}
		

		$max=floor($dis);
		echo "
		<div class='p-2 bg-primary text-white'><h4 align='center'>Mis inscripciones</h4></div>
		<table class='table table-hover'>
			<thead><tr><th>Alumno</th><th>Fecha de pago</th><th>Concepto</th><th>Comisión</th></tr></thead>
			<tbody>$al</tbody>
		</table>
		<div id='emergente' class='emergente'><h3><p class='text-muted'>Solicitud de retiro de efectivo</p></h3><hr>
		
		<form method='POST' action='manda.php'>


			 <div class='input-group mb-3'>
    				<div class='input-group-prepend'>
      					<span class='input-group-text'>Banco</span>
				</div>
  				<input type='text' class='form-control' id='banco' name='banco' value='$banco' required>
			</div>

			 <div class='input-group mb-3'>
    				<div class='input-group-prepend'>
      					<span class='input-group-text'>No. de cuenta o tarjeta:</span>
				</div>
  				<input type='number' class='form-control' id='cta' name='cta' value='$cta'  min=99999 max=99999999999999999999 required>
			</div>

			<br><p class='text-success'>Máximo disponible $ $disponible</p>
			 <div class='input-group mb-3'>
    				<div class='input-group-prepend'>
      					<span class='input-group-text'>Cantidad a retirar:</span>
				</div>
  				<input type='number' class='form-control' id='cantidad' name='cantidad' value='$max' max='$max' min='1'>
			</div>

			<p align='right'><input type='button' class='btn btn-danger' value='Cancelar' onclick='cancela();'> &nbsp; &nbsp; &nbsp; &nbsp; 
			<input type='submit' class='btn btn-primary' value='Solicitar'></p>
		</form>
		</div>
	</div>";
?>

<div class='bloquea' id='bloquea'></div>
</body>
</html>
