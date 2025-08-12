<?php 
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/promotor.php");
//permiso();

$adicional="
<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
<link rel='stylesheet' href='../../general/estilo/ad_estilo.css'>";
cabeza("Promotores - Udimex",$adicional);
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





<body>

<?php
usuario("../../",1);
menu_i();

$total=0;
$disponible=0;
$mensual=0;
$mensualAnt=0;
$al="";

//$comision_alumno=0;
$alumno=0;




$datos=b_us_ins($_SESSION["ad_id"]);

while($fila=mysqli_fetch_assoc($datos)){
	$imprime=0;
	$comi=0;
	if($alumno!=$fila['id_usuario']){
		$comision_alumno=0;
		$alumno=$fila['id_usuario'];
	}

	if ($comision_alumno<600){
		if($fila['cantidad']>50){
			$control=0;
			if($fila['concepto']=="Inscripción" && $fila['inscripcion']>0){
				$comi=$fila['cantidad']*150/$fila['inscripcion'];
				$imprime=1;
			}

			if($fila['concepto']=="Colegiatura" && $fila['colegiatura']>0){
				$comi=$fila['cantidad']*150/$fila['colegiatura'];
				$imprime=1;
			}

			if($fila['concepto']=="Certificado" && $fila['certificado']>0){
				if($fila['certificado']>=6500){
					$comi=$fila['cantidad']*600/$fila['certificado'];
					$imprime=1;
				}
			}

			
			if($comi>$fila['cantidad']){
				$comi=$fila['cantidad'];
			}
			/*if($comi>150 && $control==0){
				$comi=150;
			}*/

			$comision_alumno=$comision_alumno+$comi;
			

			if($comision_alumno>600){
				$diferencia=$comision_alumno-600;
				$comi=$comi-$diferencia;
				$comision_alumno=600;
			}

			if ($imprime==1){
				$cant=number_format($comi, 2, '.', ',');
				$al=$al."<tr><td>".$fila['nombre']."</td><td>".$fila['f_pago']."</td><td>".$fila['concepto']."</td><td>$ $cant</td></tr>";	
				$total=$total+$cant;

				$fecha = explode("-", $fila['f_pago']);
				if ($fecha[0]==date('Y')){
					if ($fecha[1]==date('m')){
						$mensual=$mensual+$comi;
					}

					if ($fecha[1]==date('m')-1){
						$mensualAnt=$mensualAnt+$comi;
					}
				}
			}

		}

	}


}


/*
	if($actual==$fila['id_usuario']){
		$contador=$contador+1;
	}
	else{
		$datos2=b_comision($fila['id_usuario']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$com_ins=$fila2['inscripcion'];
			$com_col=$fila2['colegiatura'];
			$tope=$fila2['pagos'];
		}
		$contador=0;
	}
	
	if($contador<$tope){
		$actual=$fila['id_usuario'];
		$ct=0;
		$comision=0;
		if ($fila['concepto']=='Colegiatura'){
			$ct=1;
			if ($fila['colegiatura']>0){
				$comision=$fila['cantidad']/$fila['colegiatura']*$com_col;
			}
			else{
				$comisicon=0;
			}

			if ($comision>$fila['colegiatura']){
				$comision=$fila['colegiatura'];
			}
		}


		if ($fila['concepto']=='Inscripción'){
			$ct=1;
			if ($fila['inscripcion']>0){
				$comision=$fila['cantidad']/$fila['inscripcion']*$com_ins;
			}
			else{
				$comisicon=0;
			}
			if ($comision>$fila['inscripcion']){
				$comision=$fila['inscripcion'];
			}
			if ($comision<150){
				$comision=150;
			}
		}

		if ($ct==1){
			$cant=number_format($comision, 2, '.', ',');
			$al=$al."<tr><td>".$fila['nombre']."</td><td>".$fila['f_pago']."</td><td>".$fila['concepto']."</td><td>$ $cant</td></tr>";
		}

		
	}
}




*/

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


$tabla_bono="";
$bono=0;
$datos=busca_bono($_SESSION["ad_id"]);
while($fila=mysqli_fetch_assoc($datos)){
	$cant=number_format($fila['cantidad'], 2, '.', ',');
	$tabla_bono=$tabla_bono."<tr><td>".$fila['fecha']."</td><td>".$fila['concepto']."</td><td>$ $cant</td><td></td></tr>";
	$bono=$bono+$fila['cantidad'];
}

$total=$total+$bono;
$dis=$total-$pagado-$solicitado;
$disponible=number_format($dis, 2, '.', ',');
$mensual=number_format($mensual, 2, '.', ',');
$mensualAnt=number_format($mensualAnt, 2, '.', ',');
$total=number_format($total, 2, '.', ',');




echo "
<center>
	<div style='width:90%' class='w3-margin w3-card'>
		<div class='w3-container w3-blue w3-margin' id='inicio'>
			<h3>
				<a href='liga.php' style='color:#00ff00'>Ver ligas de inscripción</a>
			</h3>
		</div>

		<div class='w3-container w3-blue w3-margin' id='inicio'><h1 align='center'>PROMOTORES</h1></div>
		<div class='container p-3 my-3 border'>

			<div class='w3-card w3-green w3-padding-16 w3-margin' style='width:200px;'>
					<h3>Disponible:  </h3>
					<h4>$ $disponible<br></h4>
					<input type='button' value='Retirar' class='w3-red' onclick='emergente();'>
		</div>
		
		<div class='w3-margin' style='height:150px;' style='text-align:center'>
			<div class='w3-third'>
				<div class='w3-center w3-light-blue w3-margin w3-padding-16' style='width:80%'>
					<h6>Ganancia de este mes:</h6><h3>$ $mensual</h3>
				</div>
			</div>  
			<div class='w3-third'>
				<div class='w3-center w3-amber w3-margin w3-padding-16' style='width:80%'>
					<h6>Ganancia mes anterior:</h6><h3>$ $mensualAnt</h3>
				</div>
			</div>
			<div class='w3-third'>
				<div class='w3-center w3-pale-red w3-margin w3-padding-16' style='width:80%'>
					<h6>Ganancia Total:</h6><h3>$ $total</h3>
				</div>
			</div>
		</div></div>
	
	
		<br><br>";

		if ($sol!=""){
			echo "<div class='w3-container w3-blue'><h4 align='center'>Solicitudes de retiro</h4></div><br>
			<table border='1' align='center'>
				<tr><th>Fecha de solicitud</th><th>Cuenta</th><th>Cantidad</th><td></td></tr>
				$sol
			</table><br><br><br>";
		}

		if ($pagos!=""){
			echo "
			<div class='w3-container w3-blue'><h4>Mis Pagos recibidos</h4></div><br>
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
		
		
		if($bono>0){
		    		echo "
        		<div class='w3-blue'><h4 align='center'>Mis bonos</h4></div>
        		<table class='w3-table-all'>
        			<thead><tr class='w3-light-grey'><th>Fecha</th><th>Concepto</th><th>Cantidad</th></tr></thead>
        			<tbody>$tabla_bono</tbody>
        		</table>";
		}
		

		$max=floor($dis);
		echo "
		<div class='w3-blue'><h4 align='center'>Mis inscripciones</h4></div>
		<table class='w3-table-all'>
			<thead><tr class='w3-light-grey'><th>Alumno</th><th>Fecha de pago</th><th>Concepto</th><th>Comisión</th></tr></thead>
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
