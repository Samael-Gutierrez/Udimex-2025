<?php
	session_start();
	$dir="../general/";
	include($dir."php/alumno.php");
	include($dir."db/basica.php");
	include($dir."db/pagos.php");
	include($dir."db/materias.php");
	
	$adicional="
	<link rel='stylesheet' href='assets-index/style.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
	<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js' integrity='sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q'crossorigin='anonymous'></script>";

	
	cabeza("Indice - Udimex",$adicional,$dir);
	
	permiso();
	menu($dir);

	$mat=$_GET['mat'];
	$_SESSION['materia']=$mat;
	$us=$_SESSION["g_id"];
	$pagina=[];


//Verifica que el usuario tenga activada la materia en su grupo
$datos=b_mat_al($us,$mat);
if ($fila=mysqli_fetch_assoc($datos)){

	echo "<center>
	<div class='w3-card w3-border-red' style='width:450px;'><h2 class='w3-pink'>".$fila['nombre']."</h2></div>
	<h3>Temas</h3>";


	echo "<div class='w3-card' style='width:800px; padding:30px 80px;' align='left'>";
	

	$indice="";
	$unidad="";
	$i=0;
	$datos=b_ord2($mat);
	$control=1;
	$temas=1;
	$temasF=0;
	$temasAbiertos=0;
	while($fila=mysqli_fetch_assoc($datos)){	
		$temas++;
		$temasF=$temas-1;
		$barra= round(100*$temasAbiertos/$temasF);
		if($control==1){
			$temasAbiertos=$temas-1;
			$barra= 100*$temasAbiertos/$temasF;
			// $progreso=100*$temasAbiertos/$temasF;
			if ($unidad!=$fila['titulo']){
				$i++;
				$indice=$indice."<font color='#db0c4b'><a href='materia_apunte.php?apunte=".
				$fila['id_material']."' class='w3-button w3-round-xlarge'>
				<h4>$i.- ".$fila['titulo']."</h4></a></font>";
				$unidad=$fila['titulo'];
				
				

			}
				
			$color="#b9bfc8";
			$im=$dir."imagen/viñeta.png";
			$datos2=b_orden_alumno($us,$fila['id_material']);
			if($fila2=mysqli_fetch_assoc($datos2)){
				$color="#0e3b83";
				$im=$dir."imagen/viñeta2.png";
			}
			$indice=$indice."
			<font color='$color'><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
				<a href='materia_apunte.php?apunte=".$fila['id_material'].
				"' class='w3-bar-item w3-button w3-round-xlarge'>
					<img src='$im' width='15px'> ".$fila['subtitulo']."
				</a>
			</font><br>";
		}
		
		//Crea las páginas para el índice
		$pagina[]=$fila['id_material'];
		
		if($color=="#b9bfc8"){
			$control=0;
		}
	}
	
	$_SESSION['pagina']=$pagina;
	
	echo "<div class='barraProgreso'>
			<label>Progreso...</label><br>
			<progress id='file' max='100' value='$barra'></progress>
			<p>$barra%</p>
		  </div>";

	echo $indice;
	
	if($i==0){
		/*$datos=b_raiz($mat,0);
		$fila=mysqli_fetch_assoc($datos);
		if($fila['id_material']!=''){
			g_ordi($us,$fila['id_material']);
			$red="materia_indice.php?mat=".$mat;
			echo " <meta http-equiv=\"refresh\" content=\"0;url=$red\">";
		}else{*/
			echo "Esta materia no tiene contenido, verifica con tu profesor";
		//}
	}
	echo "</div>";
	echo "<br><br><br>";
}
else{
	//Si el usuario no tiene acceso a la materia lo regresa para ver materias disponibles
	echo "<script>window.location.href ='../alumno/index.php'</script>";
}

menu_flota();

?>
</html>

