<?php
	session_start();
	include("../general/todos.php");
	//include("../consultas/general.php");

	include("../consultas/basic.php");
	include("../consultas/pagos.php");
	include("../consultas/materias.php");
	include("../consultas/alumno.php");

cabeza(0);
f_menu();
?>
	</head>
	<body onload="cambia('m2');">
<?php
menu_i();

	permiso();
	$al=$_SESSION["g_id"];


	$exp="";
	$nom="";


	$documentos="";
	$carpeta='archivo/'.$al.'/';
	$datos=b_exp_doc($al);
	while($fila=mysqli_fetch_assoc($datos)){
		$icono='doc.png';
		if ($fila['ext']=='.doc' or $fila['ext']=='.docx'){
			$icono='word.png';
		}

		if ($fila['ext']=='.xls' or $fila['ext']=='.xlsx'){
			$icono='excel.png';
		}

		if ($fila['ext']=='.pdf'){
			$icono='pdf.png';
		}

		$documentos=$documentos."<div class='ar' align='left'>
			<div class='icono'><a href='".$carpeta.$fila['doc'].$fila['ext']."' target='_blank'><img src='../general/imagen/$icono' width='42px'></a></div></a>
			<div class='ar_nom'><a href='".$carpeta.$fila['doc'].$fila['ext']."' target='_blank'>".$fila['comentario']."</a></div>
			</a>
			<div class='detalles'><h2>Fecha: ".$fila['fecha']."</h2><h1>Subió: </h1></div>
			<span><a href='q_doc.php?id=".$fila['id_de']."' id='quita'> x </a></span>
		</div><hr>";
	}


	echo "
	<div id='archivos' align='left'>
		$documentos

		<br><br>
		<div id='subir'>
			<form method='POST' action='g_doc.php' enctype='multipart/form-data'>
				Nombre: <input type='text' name='desc' size='14' value=''> <input type='submit' value='Guardar'><br>
				<input type='file' name='doc'>
				<input type='hidden' value='$al' name='exp'>
				
			</form>
		</div>
		
	</div>";




echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
menu_c();
?>
	</body>
</html>





	














<?php

if ($_SESSION['exp']>0){
	$exp=$_SESSION['exp'];
	$datos=b_exp($exp);
	if($fila=mysqli_fetch_assoc($datos)){
		$edad=d_edad($fila['f_na']);


		$folio=$_SESSION['exp'];
		while(strlen($folio)<4){
			$folio="0".$folio;
		}

		if ($fila['sexo']==1){
			$sex="Hombre";
		}
		else{
			$sex="Mujer";
		}

		if ($fila['enmascarado']==1){
			$en="Si";
		}
		else{
			$en ="No";
		}
$fe=explode("-",$fila['fa']);

		echo "<div id='d_cl'>
			<h3 class='folio'>Folio: ".$folio."</h3>
			<div class='col1'>
				<div class='el-grupo'>
					<div id='et_n'>Nombre:</div>
					<div id='val_n'>".$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat']."</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Edad:</div>
					<div class='val'>".$edad."</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Sexo:</div>
					<div class='val'>$sex</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Fecha:</div>
					<div class='val'>".$fe[2]." / ".$fe[1]." / ".$fe[0]."</div>
				</div> 
				<div class='el-grupo'>
					<div class='et'>App:</div>
					<div class='val'>".$fila['app']."</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>PA:</div>
					<div class='val'>".$fila['pa']."</div>
				</div>
			</div>

			<div class='col2'>
				<div class='el-grupo'>
					<div class='et'>Equipo:</div>
					<div class='val'>".$fila['equipo']."</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Nivel de ruido:</div>
					<div class='val'>".$fila['n_ruido']." db</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Tiempo:</div>
					<div class='val'>".$fila['tiempo']."</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Enmascarador: </div>
					<div class='val'>$en R.</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Blanco:</div>
					<div class='val'>".$fila['blanco']." db</div>
				</div>
				<div class='el-grupo'>
					<div class='et'>Colaboración B.R.M. </div>
					<div class='val'>".$fila['colaboracion']." D</div>
				</div>
			</div>
		</div>";
	}
}


function lineas($cont){
	echo "<script>
	var c = document.getElementById('$cont');
	var ctx = c.getContext('2d');
	ctx.strokeStyle= '#cccccc';
	ctx.beginPath();
	";

	$esc=125;
	$inc=40;
	for ($x=25; $x<=280; $x=$x+$inc){
		if ($x>70){
			$inc=20;
		}

		echo "ctx.moveTo($x, 270);
		ctx.lineTo($x, 15);";

		if ($esc==0){
			$esc="  0";
		}

		if ($esc>0){
			$esc=" ".$esc;
		}


		echo "
		ctx.fillText('$esc',$x-10, 10);
		ctx.stroke();";
		$esc=$esc+10;
	}

	$esc=-20;
	for ($y=20; $y<=280; $y=$y+20){
		echo "ctx.moveTo(270, $y);
		ctx.lineTo(19, $y);";

		if ($esc==0){
			$esc="  0";
		}

		if ($esc>0){
			$esc=" ".$esc;
		}


		echo "
		ctx.fillText('$esc',0, $y+2);
		ctx.stroke();";
		$esc=$esc+10;
	}



	echo "ctx.stroke();
	</script>";
}




echo "<br><div id='examen'><hr>EXAMEN AUDIOMÉTRICO<br>";


echo "<div id='oderecho'>
	Oido Derecho<br>
	<canvas id='der' width='280' height='270'></canvas>";
	lineas('der');

	$datos=b_aud($_SESSION['exp'],1);

	while($fila=mysqli_fetch_assoc($datos)){
		unset($yi);

		$color="#ff0000";

		echo "<script>
		var c = document.getElementById('der');
		var ctx = c.getContext('2d');
		ctx.strokeStyle= '$color';";

		$x=25;
		for($i=1;$i<=11;$i++){

			$sn=0;

			$v=($fila['valor'.$i] + 30)*2;

				echo "ctx.beginPath();
				ctx.fillStyle = '$color';";

			//Símbolo de vía aérea
			if ($fila['te']==1){
				echo "
				ctx.beginPath();
				ctx.arc($x, $v, 4, 0, 2 * Math.PI);
				ctx.stroke();";
			}

			//Símbolo de vía ósea
			if ($fila['te']==2){
				echo "
				ctx.setLineDash([5, 10]);
				ctx.beginPath();
				ctx.font='bold 20px arial';
				ctx.fillText('<',$x, $v+8);
				ctx.stroke();";
			}

			//Símbolo de vía OSEA con enmascaramiento
			if ($fila['te']==3){
				
				echo "ctx.setLineDash([]);
				ctx.beginPath();
				ctx.font='15px arial';
				ctx.fillText('[',$x-1, $v+4);
				ctx.stroke();";
			}

			//Umbral de Confort
			if ($fila['te']==4){
				
				echo ";
				ctx.setLineDash([5, 10]);
				ctx.beginPath();
				ctx.font='15px arial';
				ctx.fillText('M',$x-1, $v+4);
				ctx.stroke();";
			
			}

			//Umbral de Disconfort
			if ($fila['te']==5){
				
				echo ";
				ctx.setLineDash([5, 10]);
				ctx.beginPath();
				ctx.font='15px arial';
				ctx.fillText('m',$x-1, $v+4);
				ctx.stroke();";
			
			}
		
			if ($fila['valor'.$i]!=-100 ){
				if (!isset($yi)){
					$xi=$x;
					$yi=$v;
				}
				echo "
				ctx.beginPath();
				ctx.moveTo($xi, $yi);
				ctx.lineTo($x, $v);
				ctx.stroke();";

				$xi=$x;
				$yi=$v;
			}

			$pos=$x-3;
			if ($fila['valor'.$i]<0){
				$pos=$x-11;
			}
			if ($fila['valor'.$i]>9){
				$pos=$x-7;
			}

			if ($fila['valor'.$i]>99){
				$pos=$x-11;
			}

			

			$ad=20;
			if ($i<3){
				$ad=40;
			}
			$x=$x+$ad;

		
		}
		echo "</script>";		
	}
echo "</div>";

echo "<div id='oizquierdo'>Oido izquierdo<br><canvas id='iz' width='280' height='270'></canvas>";
lineas('iz');

$datos=b_aud($_SESSION['exp'],2);

while($fila=mysqli_fetch_assoc($datos)){
	unset($yi);

	$color=$color="#0000ff";;

	echo "<script>
	var c = document.getElementById('iz');
	var ctx = c.getContext('2d');
	ctx.strokeStyle= '$color';";

	$x=25;
	for($i=1;$i<=11;$i++){
		$v=($fila['valor'.$i] + 30)*2;

		echo "
		ctx.beginPath();
		ctx.fillStyle = '$color';";


		//Símbolo de vía aérea
		if ($fila['te']==1){
			echo "ctx.beginPath();
			ctx.moveTo($x-7, $v-7);
			ctx.lineTo($x+7, $v+7);
			ctx.moveTo($x-7, $v+7);
			ctx.lineTo($x+7, $v-7);
			ctx.stroke();";
		}

		//Símbolo de vía ósea
		if ($fila['te']==2){
			echo "
			ctx.setLineDash([5, 10]);
			ctx.beginPath();
			ctx.font='bold 20px arial';
			ctx.fillText('>',$x-8, $v+8);
			ctx.stroke();";
		}


		//Símbolo de vía OSEA CON MASCARA
		if ($fila['te']==3){
			
			echo "ctx.setLineDash([]);
			ctx.beginPath();
			ctx.font='15px arial';
			ctx.fillText(']',$x-2, $v+4);
			ctx.stroke();";
		}

			//Umbral de Confort
			if ($fila['te']==4){
				
				echo ";
				ctx.setLineDash([5, 10]);
				ctx.beginPath();
				ctx.font='15px arial';
				ctx.fillText('M',$x-1, $v+4);
				ctx.stroke();";
			
			}

			//Umbral de Disconfort
			if ($fila['te']==5){
				
				echo ";
				ctx.setLineDash([5, 10]);
				ctx.beginPath();
				ctx.font='15px arial';
				ctx.fillText('m',$x-1, $v+4);
				ctx.stroke();";
			
			}
		
		if ($fila['valor'.$i]!=-100){
			if (!isset($yi)){
				$xi=$x;
				$yi=$v;
			}
			echo "
			ctx.beginPath();
			ctx.moveTo($xi, $yi);
			ctx.lineTo($x, $v);
			ctx.stroke();";

			$xi=$x;
			$yi=$v;
		}

		$pos=$x-3;
		if ($fila['valor'.$i]<0){
			$pos=$x-11;
		}
		if ($fila['valor'.$i]>9){
			$pos=$x-7;
		}

		if ($fila['valor'.$i]>99){
			$pos=$x-11;
		}

		

		$ad=20;
		if ($i<3){
			$ad=40;
		}
		$x=$x+$ad;
		

	}

echo "</script>";
}

echo "</div>






 </div><div id='d_audio'><br><br><form method='POST' id='f_audiometria' name='f_audiometria' action='index.php'>
Oido: <input type='button' name='od' value='Derecho' id='bt_od' onclick='t_oid(1);'><input type='button' name='od' value='Izquierdo' id='bt_oi' onclick='t_oid(2);'> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

Tipo: <select name='tipo_ex' id='tipo_ex'>
		<option value='1' default>Vía aérea</option>
		<option value='2' default>Vía ósea</option>
		<option value='3' default>Vía ósea con enmascaramiento</option>
		<option value='4' default>MCL</option>
		<option value='5' default>UCL</option>
	</select>

<div id='f_dat' hidden>
	<div class='valor'>
	125 hz<br><input type='text' name='v1' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	250 hz<br><input type='text' name='v2' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	500 hz<br><input type='text' name='v3' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	750 hz<br><input type='text' name='v4' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	1000 hz<br><input type='text' name='v5' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	1500 hz<br><input type='text' name='v6' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	2000 hz<br><input type='text' name='v7' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	3000 hz<br><input type='text' name='v8' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>

	<div class='valor'>
	4000 hz<br><input type='text' name='v9' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>
	<div class='valor'>
	6000 hz<br><input type='text' name='v10' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>
	<div class='valor'>
	8000 hz<br><input type='text' name='v11' size='1' class='inp' min='-10' max='110' maxlength='3'>
	</div>



</div>
	<input type='text' id='control' value='4'>
<div id='bt_guardar' hidden>
	<input type='button' value='Guardar' onclick='b_aud();'>
</div>

	
<hr><br><br><br>
<div id='bot'>
	<span onclick='muestra(1);' id='op1' class='op'>Comentarios</span>
	<span onclick='muestra(2);' id='op2' class='op'>Archivos</span>
	<span onclick='muestra(3);' id='op3' class='op'>Dictamen</span>
</div>

<br><input type='hidden' value='$exp' name='exp'><input type='hidden' value='0' name='oido' id='oido'>
</form></div><hr>";


echo "<div id='sec_com' hidden><form method='POST' action='g_com.php' id='com'>
	Comentario: <input type='text' name='com' size='50%'>
	<input type='submit' value='Guardar'>
	<input type='hidden' name='us' value='$id'>
	<input type='hidden' name='exp' value='".$_SESSION['exp']."'>
	</form>
";

$fant="";
$usant="";

$datos=b_his($_SESSION['exp']);
$i=0;
	while ($fila=mysqli_fetch_assoc($datos)){
		$ct=1;
		if ($fila['id_usuario']!=$usant){
			$ct=0;
		}
		if ($fila['fecha']!=$fant){
			$ct=0;
		}

		$usant=$fila['id_usuario'];
		$fant=$fila['fecha'];



		if ($i==0){
			$ini="";
		}
		else{
			$ini="</div>";
		}
	
		$i=$i+1;

		$datos2=b_us($fila['id_usuario'],"");
		$fila2=mysqli_fetch_assoc($datos2);

		if ($ct==0){

			$fe=explode("-",$fila['fecha']);

			echo "$ini
		
			<div class='historico'>
				<div class='nombre'>".$fila2['nombre']." ".$fila2['ap_pat']."</div><div class='fecha'>".$fe['2']." / ".$fe['1']." / ".$fe['0']."</div>
				<br><hr><div class='comentario'><li>".$fila['comentario']."</li></div>
			";

		}
		else{
			echo "<div class='comentario'><li>".$fila['comentario']."</li></div>";
		}
	}








	echo "
	<div id='dictamen' hidden align='left'>
		+ Nuevo Dictamen
	</div>";


echo "
<br><br>

<br>

";
?>


<div id='resp'></div>

	<div id='emergente0' class='emergente'><br>
		<div><font size='6' align='center' id='t_av'>AVISO</font><hr><br>
			Registro duplicado:<u> Oido <span id='r_oi'></span></u> de tipo <u><span id='r_tp'></span></u><br> ¿Qué dedeas hacer?
			
			<center><input type='button' value='Cancelar' onclick='act(0);'>&nbsp; &nbsp; &nbsp;
			<input type='button' value='Reemplazar' onclick='act(1);'>&nbsp; &nbsp; &nbsp;
			<input type='button' value='Actualizar' onclick='act(2);'></center>
			
			 
		</div>
	</div>
	<div id='bloquea' class='bloquea'>&nbsp;</div>




































                        
                           
                        




					  
					</section>

				<!-- About Me --><!-- Contact -->
			</div>

		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class='copyright'>
						<?php pie(); ?>
					</ul>

			</div>




	</body>
</html>
