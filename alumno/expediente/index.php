<?php
	session_start();
	include("../../general/funcion/basica.php");
	include("../../general/consultas/basic.php");
	include("../../general/consultas/pagos.php");
	include("../../general/consultas/alumno.php");
	
	carga_estilo("../../");
?>
	
	</head>
	<body>
<?php
	permiso();
	menu("../../");




if ($_POST){
	$te=$_POST['tipo_ex'];
	for($i=1;$i<12;$i++){
		if ($_POST['v'.$i]){
			$v[$i]=$_POST['v'.$i];
		}
		else{
			$v[$i]=-100;
		}
		if ($_POST['v'.$i]==0){
			$v[$i]=0;
		}
	}

	$enm=0;
	$sn=0;
	if($_POST['enm']){
		$enm=$_POST['enm'];
	}
	if($_POST['sn']){
		$sn=$_POST['sn'];
	}

	
	q_ex($_POST['exp'],$_POST['oido'],$te,$enm,$sn);
	g_audio($_POST['exp'],$_POST['oido'],$v[1],$v[2],$v[3],$v[4],$v[5],$v[6],$v[7],$v[8],$v[9],$v[10],$v[11],$enm,$sn,$te);
}


$v_com='hidden';
$v_ar='hidden';
$v_dic='hidden';

$id=$_SESSION['us_id'];
$nom=$_SESSION['us_nom'];
?>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<script type='text/javascript' src='../general/js/jquery-1.6.4.js'></script> 
		<script>
			function t_oid(r){
				document.getElementById('f_dat').style.display='block';
				document.getElementById('bt_guardar').style.display='block';
				document.getElementById('oido').value=r;
				if(r==1){
					document.getElementById('bt_od').style.background='#e33b81';
					document.getElementById('bt_oi').style.background='#dddddd';
				}
				if(r==2){
					document.getElementById('bt_od').style.background='#dddddd';
					document.getElementById('bt_oi').style.background='#e33b81'
				}
			}

			function muestra(a){
				document.getElementById('sec_com').style.display='none';
				document.getElementById('archivos').style.display='none';
				document.getElementById('dictamen').style.display='none';
				if (a==1){
					document.getElementById('sec_com').style.display='block';
				}
				if (a==2){
					document.getElementById('archivos').style.display='block';
				}
				if (a==3){
					document.getElementById('dictamen').style.display='block';
				}


			}


			function bloquea(id) {
				window.scrollTo(0, 0);
				document.getElementById('bloquea').style.display='block';
				document.getElementById('emergente'+id).style.display='block';
				document.getElementById('emergente'+id).style.height='400px';
			}


		function act(n){
			
			document.getElementById('bloquea').style.display='none';
			document.getElementById('emergente0').style.display='none';
			document.getElementById('control').value=n;
			if (n>0){
				var url = 'index.php';
        			$.ajax({               
			   		type: 'POST',                 
					url: url,                     
					data: $('#f_audiometria').serialize(), 
					success: function(data)             
					{
						window.location.reload(); 
					}
				});
				
			}
		}


		function b_aud(){
			var oido=document.getElementById('oido').value;
			var tipo=document.getElementById('tipo_ex').value;

			document.getElementById('r_oi').innerHTML='Derecho';
			if (oido==2){
				document.getElementById('r_oi').innerHTML='Izquierdo';
			}


			document.getElementById('r_tp').innerHTML='Vía aérea';
			if (tipo==2){
				document.getElementById('r_tp').innerHTML='Vía ósea';
			}

			if (tipo==3){
				document.getElementById('r_tp').innerHTML='Vía ósea con enmascaramiento';
			}

			if (tipo==4){
				document.getElementById('r_tp').innerHTML='MCL';
			}

			if (tipo==5){
				document.getElementById('r_tp').innerHTML='UCL';
			}

			var url = 'auxiliar.php';
        		$.ajax({               
		   		type: 'POST',                 
				url: url,                     
				data: {oido:oido, tipo:tipo}, 
				success: function(data)             
				{
					$('#resp').html(data);
					if(data>0){
						bloquea(0);
					}
					else{
						act(4);
					}
				}
			});
		}

		</script>
	</head>
	




		<?php
			if ($_GET){
				echo "<body class='is-preload' onload='muestra(".$_GET['c'].");'>";
			}
			else{
				echo "<body class='is-preload' onload='muestra(1);'>";
			}
		?>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">












<?php

if ($_SESSION['exp']>0){
	$exp=$_SESSION['exp'];
	//$datos=b_exp($exp);
/*	if($fila=mysqli_fetch_assoc($datos)){
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
	} */
}







echo "<br><div id='examen'><hr>EXAMEN AUDIOMÉTRICO<br>";



echo "<div id='oderecho'>
	Oido Derecho<br>
	<canvas id='der' width='280' height='270'></canvas>";
	//lineas('der');

/*	$datos=b_aud($_SESSION['exp'],1);

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

			
			if ($fila['te']==1){				//*** VIA AEREA ***/
				/*if ($fila['enm']==0){				// SIN ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(1,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(2,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				} 
				else{						// CON ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(3,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(4,$x,$v);		//Sin umbral
						//echo $simbolo;
					}
				}
				echo $simbolo;
				$tl=1;							//Línea continua
			}



			if ($fila['te']==2){				//*** VIA ÓSEA ***/
				/*if ($fila['enm']==0){				// SIN ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(5,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(6,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				} 
				else{						// CON ENMASCARAR //
					if($fila['sn']==0){
						$simbolo=simbolos(7,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(8,$x,$v);		//Sin umbral
						//echo $simbolo;
					}
				}
				echo $simbolo;
				$tl=2;							//Línea punteada
			}

			if ($fila['te']==3){				//*** Umbral de diconfort ***/
				//if ($fila['enm']==0){				// SIN ENMASCARAR //
					/*if($fila['sn']==0){
						$simbolo=simbolos(9,$x,$v);		//Con umbral
						//echo $simbolo;
					}
					else{
						$simbolo=simbolos(10,$x,$v);		//Sin umbral
						//echo $simbolo;
					}		
				//} 
				echo $simbolo;
				$tl=1;							//Línea punteada
			}

		
			if ($fila['valor'.$i]!=-100 ){
				if (!isset($yi)){
					$xi=$x;
					$yi=$v;
				}

				linea($xi,$yi,$x,$v,$tl);
				

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
	}*/
echo "</div>";

echo "<div id='oizquierdo'>Oido izquierdo<br><canvas id='iz' width='280' height='270'></canvas>";
//lineas('iz');

/*$datos=b_aud($_SESSION['exp'],2);

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

		if ($fila['te']==1){				//*** VIA AEREA ***/
			/*if ($fila['enm']==0){				// SIN ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(11,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(12,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			} 
			else{						// CON ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(13,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(14,$x,$v);		//Sin umbral
					//echo $simbolo;
				}
			}
			echo $simbolo;
			$tl=1;							//Línea continua
		}



		if ($fila['te']==2){				//*** VIA ÓSEA ***/
			/*if ($fila['enm']==0){				// SIN ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(15,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(16,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			} 
			else{						// CON ENMASCARAR //
				if($fila['sn']==0){
					$simbolo=simbolos(17,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(18,$x,$v);		//Sin umbral
					//echo $simbolo;
				}
			}
			echo $simbolo;
			$tl=2;							//Línea punteada
		}

		if ($fila['te']==3){				//*** Umbral de diconfort ***/
			//if ($fila['enm']==0){				// SIN ENMASCARAR //
				/*if($fila['sn']==0){
					$simbolo=simbolos(19,$x,$v);		//Con umbral
					//echo $simbolo;
				}
				else{
					$simbolo=simbolos(20,$x,$v);		//Sin umbral
					//echo $simbolo;
				}		
			//} 
			
			echo $simbolo;
			$tl=1;							//Línea punteada
		}


		

		
		if ($fila['valor'.$i]!=-100){
			if (!isset($yi)){
				$xi=$x;
				$yi=$v;
			}
			linea($xi,$yi,$x,$v,$tl);

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
*/
echo "</div>






 </div><div id='d_audio'><br><br><form method='POST' id='f_audiometria' name='f_audiometria' action='index.php'>
Oido: <input type='button' name='od' value='Derecho' id='bt_od' onclick='t_oid(1);'><input type='button' name='od' value='Izquierdo' id='bt_oi' onclick='t_oid(2);'> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;

Tipo: <select name='tipo_ex' id='tipo_ex'>
		<option value='1' default>Vía aérea</option>
		<option value='2' default>Vía ósea</option>
		<option value='3' default>Umbral de Disconfort</option>
	</select>


<br><br>
<table border='1' align='center'><tr><td align='center'>Enmascarado: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br>
<label class='switch'>
	<input type='checkbox' id='enm' value='1' name='enm'>
	<span class='slider round'></span>
</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td><td align='center'>Sin umbral: <br>
<label class='switch'>
	<input type='checkbox' id='sn' value='1' name='sn'>
	<span class='slider round'></span>
</label></td></tr></table>


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
	<input type='hidden' id='control' value='4'>
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


echo "<div id='sec_com' $v_com><form method='POST' action='g_com.php' id='com'>
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

	$documentos="";
	$carpeta='archivo/'.$_SESSION['exp'].'/';
	$datos=b_exp_doc($_SESSION['exp']);
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
			<div class='icono'><a href='".$carpeta.$fila['doc'].$fila['ext']."' target='_blank'><img src='../imagen/$icono' width='42px'></a></div></a>
			<div class='ar_nom'><a href='".$carpeta.$fila['doc'].$fila['ext']."' target='_blank'>".$fila['comentario']."</a></div>
			</a>
			<div class='detalles'><h2>Fecha: ".$fila['fecha']."</h2><h1>Subió: ".$fila['emp']."</h1></div>
			<span><a href='q_doc.php?id=".$fila['id_de']."' id='quita'> x </a></span>
		</div><hr>";
	}

	echo "</div></div>
	<div id='archivos' $v_ar align='left'>
		ar
		$documentos

		<br><br>
		<div id='subir'>
			<form method='POST' action='g_doc.php' enctype='multipart/form-data'>
				Nombre: <input type='text' name='desc' size='14' value=''> <input type='submit' value='Guardar'><br>
				<input type='file' name='doc'>
				<input type='hidden' value='$exp' name='exp'>
				<input type='hidden' value='$nom' name='emp'>
				
			</form>
		</div>
		
	</div>";




//dictamen
$dictamen="";
$datos=b_dictamen($_SESSION['exp']);

while ($fila=mysqli_fetch_assoc($datos)){
	$fe=explode("-",$fila['fecha']);

	$dictamen=$dictamen."<div class='historico'>
		<div class='fecha'>".$fe['2']." / ".$fe['1']." / ".$fe['0']."</div>
		<br><hr>
		<div class='comentario'>".$fila['dictamen']."
			<a href='dictamen.php?id=".$fila['id_dictamen']."' target='blank'>
				<img src='../imagen/ver.png' width='45px' align='right'>
			</a>
		</div>
	</div>";
}




	echo "
	<div id='dictamen' $v_dic align='left'>
		<form method='POST' action='g_dic.php' id='com' align='center'>
		Dictamen:<br><textarea rows='2' cols='60' name='dictamen'></textarea><br>
		<input type='submit' value='Guardar'>
		<input type='hidden' name='exp' value='".$_SESSION['exp']."'>
		</form>

		$dictamen

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
