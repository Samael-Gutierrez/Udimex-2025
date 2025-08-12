<?php
session_start();
include("../consultas.php");

//Registro de usuarios

if ($_POST){
	if($_POST['con']<4){
		$nom=$_POST['nom'];
		$ap=$_POST['ap'];
		$am=$_POST['am'];
		$correo=$_POST['correo'];
		$tel=$_POST['tel'];
		$cel=$_POST['cel'];
		$sexo=$_POST['sexo'];
		$e_civil=$_POST['e_civil'];
		$f_na=$_POST['f_na'];
		$calle=$_POST['calle'];
		$colonia=$_POST['colonia'];
		$numero=$_POST['numero'];
		$municipio=$_POST['municipio'];
		$cp=$_POST['cp'];
		
	}
	if($_POST['con']==1){
		$colegiatura=$_POST['colegiatura'];
		$grupo=$_POST['grupo'];
		$ins=$_POST['ins'];
		$prom=$_POST['prom'];
		$f_in=$_POST['f_in'];

		$datos=alumno_nuevo($nom,$ap,$am,$correo,$tel,$cel,$sexo,$e_civil,$f_na,$calle,$colonia,$numero,$municipio,$cp,$colegiatura,$grupo,$ins,$prom,$f_in);

		$datos=$datos=b_id("id_alumno","alumno");;
		if($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['res'];
		}

		echo "<script>
			alert('Se registró al alumno con la matricula=".$id."');
			top.window.location='menu_alumno.php';
		</script>";
	}
	
	if($_POST['con']==2){
		$car=$_POST['car'];
		$datos=asesor_nuevo($nom,$ap,$am,$correo,$tel,$cel,$sexo,$e_civil,$f_na,$calle,$colonia,$numero,$municipio,$cp,$car);
		$datos=b_id("id_asesor","asesor");
		if($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['res'];
		}

		echo "<script>
			alert('Se registró al profesor con la matricula=".$id."');
			top.window.location='menu_profesor.php';
		</script>";
	}

	if($_POST['con']==3){
		$datos=promotor_nuevo($nom,$ap,$am,$correo,$tel,$cel,$sexo,$e_civil,$f_na,$calle,$colonia,$numero,$municipio,$cp);
		$datos=b_id("id_promotor","promotor");
		if($fila=mysqli_fetch_assoc($datos)){
			$id=$fila['res'];
		}

		echo "<script>
			alert('Se registró al profesor con la matricula=".$id."');
			top.window.location='menu_promotor.php';
		</script>";	
	}

//------------------------------------------

//Registro de calificaciones
	if($_POST['con']==4){
		$al=$_POST['alumno'];
		$sem=$_POST['sem'];
		$mat=$_POST['mat'.$sem];
		$cal=$_POST['cal'];
		g_calif($al,$mat,$cal);
		echo "<script>alert('Se registró la calificación satisfactoriamente');
			top.window.location='menu_alumno.php';
			</script>";
	}
	
	


//------------------------------------------

//Registro de grupos
	if($_POST['con']==5){
		$prof=$_SESSION['g_prof'];
		$hi=$_POST['hi'];
		$hf=$_POST['hf'];
		$tp=$_POST['tipo'];

		$dias=$_POST['lu']." ".$_POST['ma']." ".$_POST['mi']." ".$_POST['ju']." ".$_POST['vi']." ".$_POST['sa']." ".$_POST['do'];

		g_grupo($prof,$hi,$hf,$dias,$tp);
		echo "<script>alert('Se registró el grupo satisfactoriamente');
			top.window.location='reg_gru.php';
			</script>";
	}

//Elimina grupos
	if($_POST['con']==6){
		$gr=$_POST['grupo'];
		e_grupo($gr);
		echo "<script>alert('Se dío de baja al grupo');
			top.window.location='reg_gru.php';
			</script>";
	}

}




?>
			
		</div>



