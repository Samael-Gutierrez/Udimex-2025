<?php
	session_start(); 
	include("../general/todos.php");
	include("../general/consultas.php");
cabeza(0);
f_menu();
?>

<script>
	function imprSelec(imprimir){
		var ficha=document.getElementById(imprimir);
		var ventimp=window.open(' ','popimpr');
		ventimp.document.write(ficha.innerHTML);
		ventimp.document.close();
		ventimp.print();
		ventimp.close();
	}
</script>


	</head>
	<body onload="cambia('m1');">


<?php
menu_i();
?>


<?php


permiso();


	$us=$_SESSION["g_id"];
	
	$datos=b_alumno($us);
	$fila=mysqli_fetch_assoc($datos);
	mysqli_free_result($datos);

	$datos2=b_tarjeta(1);
	$fila2=mysqli_fetch_assoc($datos2);
	mysqli_free_result($datos2);
	$tar=$fila2['numero'];
	$fp1=$fila2['fp1'];
	$fp2=$fila2['fp2'];
	$com1=$fila2['com1'];
	$com2=$fila2['com2'];


	echo "
		<div id='mensaje'>
			Este es el detalle del pago solicitado, si a&uacute;n no realizas el pago puedes realizarlo con la siguiente 				informaci&oacute;n </div><br><center>
		<div id='imprimir'>
		<div id='mensaje2'>DETALLE DE PAGO</div><br><br>";

echo "<table border=0 id=tabla><tr id=tab3><th colspan=6 align=left><br>TARJETA: $tar<br>USUARIO: ".
	$fila['nombre']." ".$fila['ap_pat'].
	"<br><br></th></tr><tr id=cab><th>CLAVE</th><th>MATERIA</th><th>SEMESTRE</th><th>DURACI&Oacute;N</th><th>PRECIO</th></tr>";

	$carrera=$fila['id_carrera'];


	$precio=0;
	$caduca=0;
	$sub=1;

if ($carrera==4){
	$datos=b_pago3($_GET['pago'],$_SESSION["g_id"]);

	while($fila=mysqli_fetch_assoc($datos)){

		$caduca=$caduca+$fila['duracion'];

		if($sub==2){
			$sub=1;
		}
		else{
			$sub=2;
		}

		
			$costo=$fila['costo'];
			$precio=$precio+$costo;
			echo "
				<tr id='tab".$sub."'>
					<th>".$fila['id_materia']."</th><th>".$fila['nombre']."</th><th>".$fila['semestre']."</th><th>".$fila['duracion']."</th><th>$  $costo.00</th>
				</tr>";
		


		
	}
}

if ($carrera==3){
	$datos=b_pago5($_GET['pago']);

	while($fila=mysqli_fetch_assoc($datos)){

		$caduca=$caduca+1;


		$r=col_mat($fila['id_materia'],$sub);
		if ($r>0){
			$precio=$precio+$r;
			if($sub==2){
				$sub=1;
			}
			else{
				$sub=2;
			}
		}
	}
}

function col_mat($mat,$sub){
	$r=0;
	if ($mat==74){
		$r=500;
		$nom="Matemáticas";
	}
	if ($mat==78){
		$r=850;
		$nom="Ciencias Naturales";
	}
	if ($mat==89){
		$r=250;
		$nom="Aplicaciones para el Trabajo";
	}
	if ($mat==81){
		$r=350;
		$nom="Lenguaje y Comunicación";
	}
	if ($mat==84){
		$r=300;
		$nom="Ciencias Histórico-Sociales";
	}
	if ($mat==87){
		$r=200;
		$nom="Metodología y Filosofía";
	}
	if ($mat==93){
		$r=800;
		$nom="Capacitación para el Trabajo";
	}
	if ($r>0){
		echo "<tr id='tab".$sub."'>
		<th>$mat</th><th>$nom</th><th>COLBACH</th><th>-</th><th>$  $r.00</th></tr>";
	}
	return $r;
}


	

		echo "<tr id=tab3><th colspan=3></th><th id=resultado>TOTAL</th>
			<th id=resultado>$ $precio.00</th></tr>
		</table>";

		$res=(($caduca*7)+45)%30;
		$caduca=((($caduca*7)+45)-$res)/30;



		echo "
		<br><br><br><br>
		Puedes realizar tu pago en:<br><br>
		<table border=0 align=center width=100%>
			<tr>
				<td align=center width='50%'><img src=../general/imagen/$fp1></td>
				<td align=center width='50%'><img src=../general/imagen/bancomer.jpg></td>
			</tr>
			<tr>
				<td align=center>(Más comisión)</td>
				<td align=center>Comisión: <b>$ $com2.00</b></td>
			</tr>
		</table>
		<br>";

		echo "
			<br>Nota: El acceso al material selecionado es por <font size=5>$caduca meses</font>, 
			a partir de la fecha en que se realice el pago.</div>";



?>
		<br><table border='0' width='50%'><tr>
			<td align='center'><a href='javascript:history.back(1)'><img src='../general/imagen/at.jpg' width='60px'><br>Regresar</a></td>
			<td align='center'><a href='#' onclick="javascript:imprSelec('imprimir');"><img src='../general/imagen/imp.png' width='40px'><br>IMPRIMIR</a></td></tr></table></div>
		
<?php
menu_c();
?>

	</body>
</html>

