<?php

session_start();
include("../general/funcion/basica.php");
include("../general/consultas/pagos.php");
include("../general/consultas/grupos.php");
include("../general/consultas/basic.php");
include("../general/consultas/general.php");
carga_estilo('../');
	permiso();
	menu('../');
echo "
<meta name='description' content='Es una plataforma educativa que te permite estudiar tu Preparatoria en línea con reconocimiento oficial de la SEP mediante CENEVAL (acuerdo 286) o Prepa Abierta'>
<script type='text/javascript' src='../general/js/jquery-1.6.4.js'></script>
	<link rel='stylesheet' type='text/css' href='../general/js/style.css'>
	<script type='text/javascript' src='../general/js/wowslider.js'></script>
	</head>
	<body onload=\"cambia('m1');\">";










$i=1;
$j=0;
$datos=b_pagos($_SESSION["g_id"]);

$ce=1;
$cp=0;
$cc=0;
$cpt=0;
$pendientes="";
$pagados="";
$condonados="";

while($fila=mysqli_fetch_assoc($datos)){
	/*if($fila['tipo']==1){
		$ce=$ce+1;
		$pendientes="";
	}*/
$idPago = $fila['id_pago'];


	/*if($fila['concepto']=="Inscripción"){
		$b64=base64_encode($fila['id_pago'].$_SESSION["g_id"].$fila['f_pago']);
		$pago=number_format ($fila['cantidad'],2);
		$pagados=$pagados."<tr>
			<td>$cp</td>
			<td>".$fila['f_pago']."</td>
			<td>".$fila['concepto']."</td>
			<td align='center'>$ ".$pago."</td>
			<td align='center'><a href='pagos_recibo.php?id=$b64' target='_blank'><img src='../general/imagen/descarga.png' width='30px'></a></td>
		</tr>";
	}

	if($fila['concepto']=="Colegiatura"){*/

	if ($fila['cantidad']>0){ 
		$b64=base64_encode($fila['id_pago'].$_SESSION["g_id"].$fila['f_pago']);
		$cp=$cp+1;

		$pago=number_format ($fila['cantidad'],2);
		$pagados=$pagados."<tr align='center'>
			<td>$cp</td>
			<td>".$fila['f_pago']."</td>
			<td>".$fila['concepto']."</td>
			<td align='center'>$ ".$pago."</td>
			<td align='center'>
				<a href='pagos_recibo.php?id=$b64&&pago=$idPago' target='_blank'><img src='../general/imagen/descarga.png' width='30px'></a></td>
		</tr>";
		$cpt=$cpt+$fila['cantidad'];
	}



	if($fila['concepto']=="Condonado"){
		$cc=$cc+1;
		$condonados=$condonados."<tr>
			<td>$cp</td>
			<td>".$fila['fecha_solicitud']." al ".$fila['fecha_caducidad']."</td>
			<td>".$fila['fecha_pago']."</td>
			<td>".$fila['referencia']."</td>
			<td align='center'>".$fila['cantidad']."</td>
		</tr>";
		$cct=$cct+$fila['cantidad'];
	}
	
	
}

echo "<center>";

function semana_fecha($fe){
	echo $fe;
	$fecha=explode("-",$fe);
	$semana = date('W',  mktime(0,0,0,$fecha[1],$fecha[2],$fecha[0])); 
	return $semana;
}

/*$datos=b_ufp($_SESSION["g_id"]);
if($fila=mysqli_fetch_assoc($datos)){
	$ce=1;
	$usem=semana_fecha($fila['ufp']);
	$asem=semana_fecha(date('Y-m-d'));
	
	echo $usem;
	echo $asem;
	$adeudo=$asem-$usem;
	echo $adeudo;



}*/



$datos2=b_fi($_SESSION["g_id"]);
if($fila2=mysqli_fetch_assoc($datos2)){
	$st=explode("-",$fila2['f_ingreso']);
	$semi = date('W',  mktime(0,0,0,$st[1],$st['2'],$st['0'])); 
	$sema = date('W');
	$fad=$sema-$semi;
	$semtot=$fad;
	//busca los pagos realizados
	$pagado=0;
	$datos3=b_pagos2($_SESSION["g_id"]);
	if($fila3=mysqli_fetch_assoc($datos3)){
		$pagado=$fila3['pagos'];		
	}
	//---------------------
	
	//Obtiene el número de semanas pagadas
	$sempag=intdiv ($pagado,$fila2['colegiatura']);
	$fad=$fad-$sempag;
	//
		if ($fad<0){
		$fad=0;
	}
}
else{
	$fad=0;
}

$adeudo=($semtot*$fila2['colegiatura'])-$pagado;




/*if ($adeudo>0){
	$datos=colegiatura($_SESSION["g_id"]);
	$fila=mysqli_fetch_assoc($datos);
	$total=$fila['colegiatura']*$adeudo;
	echo "<div id='titulo2'>Adeudos</div><br>
	<table border='1'>
		<tr>
			<th colspan='2'>Tienes<u> $adeudo </u>semanas de adeudo</th>
		</tr>
		<tr>
			<td> Realiza tu pago por $$total</td>
			<td><a href='ficha_pago.php?id=".$_SESSION["g_id"]."'>Ver ficha de pago</a></td>
		</tr>
	</table><br><br>";
}*/



if ($cc>=0){
	/*echo "<div id='titulo2'>Apoyo por contingencia santitaria</div><br>
		<table border='1'>
		<tr><th>#</th>
		<th>Periodo</th>
		<th>Fecha</th>
		<th>Concepto</th>
		<th>Cantidad</th>
	</tr>$condonados
	<tr><th colspan='4'>TOTAL</th><th>$cct</th></tr></table><br><br>";*/
}

$mes=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
$dato=b_fechaPago($_SESSION["g_id"]);
if($fila=mysqli_fetch_assoc($dato)){
	$fpag=explode('-',$fila['f_pago']);
	$dp=$fpag[2];
	$m=intval($fpag[1]);
	$mp=$mes[$m];
	$ap=$fpag[0];

	$fec=strtotime($fila['f_pago']);
	$fac=strtotime(date('Y-m-d'));

	if ($fec>=$fac){
		$cpago="<br>Realiza tu pago antes del:<br><b><u> $dp de $mp de $ap</u></b>";
	}
	else{
		$cpago="<br>Tienes un atraso en <br>tu pago de colegiatura !!</b>";
	}
}
else{
	$cpago="";
}

echo "
<div class='ficha'>
	Tu Colegiatura mensual es de:
	<div class='resalta'>$ ".$fila2['colegiatura']."</div>
	$cpago
</div>
";

$cpt=number_format ($cpt,2);
if ($cp>=0){
	echo "<div class='resalta'>Consulta tu recibo de pago</div><br>
	<table border='0' width='60%'>
		<tr><th>#</th>
		<th>Fecha de pago</th>
		<th>Concepto</th>
		<th>Cantidad</th>
		<th>Recibo de pago</th>
	</tr>$pagados<tr></table><br><br>";
}



echo "</center>";









menu_flota();
?>
	</body>
</html>

