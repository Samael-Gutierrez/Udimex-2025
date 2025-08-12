<?php
	session_start();
	include("../general/funcion/basica.php");
	include("../general/consultas/basic.php");
	include("../general/consultas/pagos.php");
	include("../general/consultas/materias.php");
	
	carga_estilo('../');
?>
	</head>
	<body>
<?php
	permiso();
	menu('../');

	$datos=b_calificacion($_SESSION["g_id"]);
	$fila=mysqli_fetch_assoc($datos);
	$red=1;
	if($fila['r']==0){
		$_SESSION['mat']=1144;
		$_SESSION['tema']=425;
		$_SESSION['sub']=4114;
	}
	/*if($fila['r']==1){
		$_SESSION['mat']=1080;
		$_SESSION['tema']=356;
		$_SESSION['sub']=3891;
	}
	if($fila['r']==2){
		$_SESSION['mat']=1080;
		$_SESSION['tema']=357;
		$_SESSION['sub']=3892;
	}
	if($fila['r']==3){
		$_SESSION['mat']=1080;
		$_SESSION['tema']=358;
		$_SESSION['sub']=3893;		
	}*/
	if($fila['r']>0){
			$prom=0;
	$i=0;
	$ficha="";
	$datos=b_cal2($_SESSION["g_id"]);
	while($fila=mysqli_fetch_assoc($datos)){
		$prom=$prom+$fila['valor'];
		$i=$i+1;
		if ($fila['valor']<=10){
			$com="<h4 class='w3-green'>EXCELENTE</h4>Tienes un gran desepeño !!!";
		}
		if ($fila['valor']<=9){
			$com="<h4 class='w3-green'>BUENO</h4>Tienes buenos conocimientos en ésta área !!";
		}
		if ($fila['valor']<=7){
			$com="<h4 class='w3-yellow'>SUFICIENTE</h4>Necesitas estudiar más";
		}
		if ($fila['valor']<6){
			$com="<h4 class='w3-red'>NO SUFICIENTE</h4>Requieres mucho estudio en esta área.";
		}

		$ficha=$ficha."<div class='w3-card-2 linea2 w3-margin w3-animate-bottom w3-padding' style='max-width:300px; height:300px;'>
			<center><h1 class='rojo_oficial'>".$fila['valor']."</h1><h3>".$fila['titulo']."</h3>
             			$com
			</center>
  		</div>";
	}

	/*$prom=$prom/$i;
	$text="Hola, mi nombre es ".$_SESSION['g_nom']." ".$_SESSION['g_ap']." y quiero inscribirme al curso para ingreso a la preparatoria.";

		if ($prom<=10){
			$com2="<h4 class='w3-green'>EXCELENTE</h4>Muy bien, no dejes de praticar y tendrás éxito. Si tienes alguna duda con mucho gusto podemos apoyarte.<h5><a href='https://api.whatsapp.com/send?phone=527226352407&text=$text' target='_blank'><img src='../general/imagen/wp_color.png' width='20px'> 722 635 2407</a></h5>";
		}
		if ($prom<9){
			$com2="<h4 class='w3-green'>BUENO</h4>Tu resultado es bueno pero no debes confiarte, recuerda que hay muchos aspirantes para un lugar. Si quiere practicar más y tener más oportunidad de acreditar, te invitamos a nuestro <b>curso de ingreso a preparatoria</b>. <h5><a href='https://api.whatsapp.com/send?phone=527226352407&text=$text' target='_blank'><img src='../general/imagen/wp_color.png' width='20px'> 722 635 2407</a></h5>";
		}
		if ($prom<=7){
			$com2="<h4 class='w3-yellow'>SUFICIENTE</h4>Aunque acreditaste, tu resultado no es el adecuado para obtener un lugar, recuerda que hay muchos aspirantes y este resultado pudiera no beneficiarte. Te recomendamos te inscribas a nuestro <b>curso de ingreso a preparatoria</b>. <h5><a href='https://api.whatsapp.com/send?phone=527226352407&text=$text' target='_blank'><img src='../general/imagen/wp_color.png' width='20px'> 722 635 2407</a></h5>";
		}
		if ($prom<6){
			$com2="<h4 class='w3-red'>NO SUFICIENTE</h4>Tu resultado no es satisfactorio, requieres con urgencia repasar más las guías, inscríbete ahora al <b>curso de ingreso a preparatoria</b>.<h5><a href='https://api.whatsapp.com/send?phone=527226352407&text=$text' target='_blank'><img src='../general/imagen/wp_color.png' width='20px'> 722 635 2407</a></h5>";
		}*/

echo "<center><div align='center' width='20%' style='max-width:700px;'>
			<h1>Resultado Global<p class='rojo_oficial'>$prom</p></h1>
			
		</div> $ficha </center>";
		$red=0;		
	}





	if ($red==1){
		header("location:cuestionario.php");
	}


?>
	</body>
</html>

