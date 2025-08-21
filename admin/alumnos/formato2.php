<?php
$dir = "../../general/";
include($dir."db/admin.php");
include($dir."db/basica.php");
include($dir."db/usuario.php");
include($dir."db/alumno.php");
include($dir."db/promotor.php");
include($dir."db/carreras.php");





if($_GET){
	$id=$_GET['id']; 
	$datos=b_us($id);
	if ($fila=mysqli_fetch_assoc($datos)){
        	// Datos para tabla de usuario
		$usuario=$fila["usuario"];
		$clave=$fila["clave"];
		$nom=$fila["nombre"];
		$apepa=$fila["ap_pat"];
		$apema=$fila["ap_mat"];
		$fechaden=$fila["Fecha de nacimiento"];
		$correoele=$fila["correo"];
     	}
    

	$datos=busca_alumno_tutor($id);
	if ($fila=mysqli_fetch_assoc($datos)){
		// Datos del tutor
		$nombredepadre=$fila["nombre"];
		$appa=$fila["ap_pat"];
		$appma=$fila["ap_mat"];
		$cee=$fila["correo"]; 
		$id_tutor=$fila['id_tutor'];
	}



	$datos=b_carrera_al($id);
	if ($fila=mysqli_fetch_assoc($datos)){

		// Datos para tabla de alumno
		$ins=$fila["inscripcion"];
		$cm=$fila["colegiatura"];
		    
		$fdp=$fila["f_pago"];
		$carrera=$fila["id_carrera"];
		$promotor=$fila["id_promotor"];   
		$mo=$fila["modalidad"];
		$fdii=$fila["f_ingreso"];
    	}

	$datos=busca_domicilio($id);
	if ($fila=mysqli_fetch_assoc($datos)){
		 //Datos para tabla de domicilio
		$esdo=$fila["estado"];
		$muni=$fila["municipio"];
		$cp=$fila["cp"];
		$calle=$fila["calle"];
		$numer=$fila["numero"];
		$colo=$fila["colonia"];
	}



	$datos=busca_tel2($id);
	if ($fila=mysqli_fetch_assoc($datos)){
		//datos para la tabla de telefono
		$telefonoa=$fila["numero"];
		//datos para la tabla de documentos
	}

	if (isset($id_tutor)){
		$datos=busca_tel2($id_tutor);
		if ($fila=mysqli_fetch_assoc($datos)){
			//datos para la tabla de telefono
			$telefonop=$fila["numero"];
		}
	}


	$doc_ent="";
	$datos=b_documentos($id);
	while($fila=mysqli_fetch_assoc($datos)){
		$edo=" No entregado";
		if($fila['estado']==1){
			$edo=" Entregado (Original)";
		}
		if($fila['estado']==2){
			$edo=" Entregado (Copia)";
		}
		$doc_ent=$doc_ent.$fila['doc'].$edo."<br>";
	}






	//regreso
	$dato1= b_car(' like '.$carrera);
	if ($fila=mysqli_fetch_assoc($dato1)){
	   $carrera2=$fila['nombre'];
	}
	$dato=b_prom($promotor);
	if ($fila=mysqli_fetch_assoc($dato)){

	   $promotor=$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
}
	if($clave=='clave'){
	  $clave= 'udim1020';
	}

	if($mo==1){
	    $mo= 'Presencial';
	 
	 }
	 if($mo==2){
	    $mo= 'Línea';
	 
	 }
	 if($mo==3){
	    $mo= 'Mixto';
	 
	 }
	 
	$mes=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
	$f_inicio=explode("-",$fdii);
	$m=intval($f_inicio[1]);
	$m=$mes[$m];
	$f_inicio=$f_inicio[2]." de ".$m." de ".$f_inicio[0];

	$f_pago=explode("-",$fdp);
	$m=intval($f_pago[1]);
	$m=$mes[$m];
	$dp=$f_pago[2];
	$f_pago=$f_pago[2]." de ".$m." de ".$f_pago[0];

}

echo "<!DOCTYPE>

<html>
<head>
<link rel='stylesheet' href='../../general/estilo/inscripcion.css'>
</head>
<body>

<div class='page'>
<center> <img src='../../general/imagen/logo.png' width=310px height:600px;></center><br><hr id='linea1' class=fondo_rojo '><hr id='linea2' class=fondo_azul '>
<h2>Hola $nom $apepa $apema</h2> 

<p>Por este medio te damos la cordial bienvenida a la Universidad Digital de México, te comentamos que tanto alumnos presenciales o como nuestros alumnos en línea tienen acceso a nuestra plataforma.</p> <br>

Tu cuenta ha sido creada y desde este momento puedes tener acceso, primero abre tu navegador de internet y coloca la siguiente dirección:
<br>
<div align='center' class='letrarr'>www.udimex.net</div>

<p>Tus datos de acceso son:</p>
<div align='center'>
<div class='borde'><br>Usuario:<div align='center' class='letrar'>$usuario</div><br>Contraseña:<div class='letrar'>$clave</div></div></div>
<br>


<p>Tu registro para presentar examen de conocimientos de <b>PREPARATORIA</b> se ha generado correctamente. Entra a nuestra plataforma con tu usuario y contraseña para descargar tu guía de estudio.</p>

<p>Recuerda que esta aplicación es <b>GRATIS</b> y en caso de acreditar se pagan los derechos de certificación vigentes de la Secretaría de Educación Pública.</p>

<p>También ponemos a tu disposición el siguiente contacto para cualquier duda con tu plan de estudios, tú forma de pago, uso de la plataforma o cualquier duda en general:</p>
<p align='center'><img src='../../general/imagen/wp_color.png' width=5%; align='left';><div class='letra'>720 287 4706  &nbsp <b>    Ing. Alfredo T. Dorado</b></p></div>

<p>Deseamos que tu estancia con nosotros sea la más productiva posible, estamos para apoyarte.</p><br><br><br>
<div align ='center'><img src='../../general/imagen/firma.png' width=25%; align='center';>
<br>_____________________________________________<br>Ing. Alfredo Tomás Dorado<br>
<b>Dirección general</b><br></div>
<br><br><br><br><br><hr id='linea4' class=fondo_azul_verde_claro '><br>
<center>Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.</center><br>
<center>www.udimex.net</center>
</div>






</body>";



?>
</body>
</html>












