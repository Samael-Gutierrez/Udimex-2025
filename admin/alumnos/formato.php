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
		$cer=$fila["certificado"];
		    
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


	$doc_ent="<div class='borde122'><table border='0'>";
	$datos=b_documentos($id);
	while($fila=mysqli_fetch_assoc($datos)){
		$edo=" No entregado";
		if($fila['estado']==1){
			$edo=" Entregado (Original)";
		}
		if($fila['estado']==2){
			$edo=" Entregado (Copia)";
		}
		$doc_ent=$doc_ent."<tr><td>".$fila['doc']."</td><td><center>".$edo."</td></tr>";
	}
	$doc_ent=$doc_ent."</table></div>";






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
<center> <img src='../../general/imagen/logo.png' width=350px height:600px;><hr id='linea1' class=fondo_rojo '><hr id='linea2' class=fondo_azul '></center><br>

<h3> <center><b><span class='letra'>Formato de inscripción</span></b><br></center></h3>

<div align =right> Matricula:<span class='borde2'>$id</span></div>

<hr id='linea3' class=fondo_azul_grisaceo_oscuro '>

 <br>  <center> Nombre:<span class='borde'> $nom $apepa $apema</span>Fecha de nacimiento:<span class='borde1'>$fechaden</span></span></center><br>
 <br><center>Teléfono personal:<span class='borde1'>$telefonoa</span>&nbsp Correo electrónico:<span class='borde1'>$correoele</span> </center>



<br><hr id='linea3' class=fondo_azul_grisaceo_oscuro '>

<center><b><span class='letra'>Datos escolares</span></b></center>
<div align=right>Fecha de inicio:<span class='borde2'>$f_inicio</span></div><br>
<center>Plan de estudios:<span class='borde1'> $carrera2 </span>
Modalidad:<span class='borde1'> $mo </span></center><br>
<br><br>
<hr id='linea3' class=fondo_azul_grisaceo_oscuro '>

<b><center><span class='letra'>Datos de pago</span></center></b>
<div align =right>Fecha de pago:<span class='borde2'>$f_pago</span><br></div><br>
<center>Inscripción:$<span class='borde1'> $ins</span>    Colegiatura mensual:$ <span class='borde1'>$cm</span> Certificado$ <span class='borde1'>$cer</span></center><br>
<br>
<hr id='linea3' class=fondo_azul_grisaceo_oscuro '>

<center><b><span class='letra'>En caso de ser menor</span></b></center><br>
<center>Nombre del padre o tutor:<span class='borde1'>$nombredepadre $appa $appma</span></center><br>
<center>Teléfono:<span class='borde1'>$telefonop</span> Correo electrónico:<span class='borde1'>$cee</span></center><br>
<div align=center>Promotor:<span class='borde4'>$promotor</span></div><br><br><br><br>


<hr id='linea4' class=fondo_azul_verde_claro '><br>
<center>Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.</center><br>
<center>www.udimex.net</center>

</div>


<div class='page'>
<center> <img src='../../general/imagen/logo.png' width=310px height:600px;></center><br><hr id='linea1' class=fondo_rojo '><hr id='linea2' class=fondo_azul '><br>
<center><b><span class='letra'>Entrega de documentos</span></b></center><br>
<div class=table> 
	<div class=caption> 
		$doc_ent
	</div>
</div>
<br><br><br><br>
                 
 <br><div align=center>____________________________________________</div><br>
 <div align=center>Nombre y firma de quien recibe</div>  <br>
<br>
<b><center><mark>AVISO DE PRIVACIDAD</mark></b></center><br>
En términos de la Ley Federal de Protección de Datos Personales en Posesión de los Particulares y su Reglamento, la Universidad Digital de México solicita su consentimiento expreso para la protección de los datos personales de acuerdo con la siguiente información:<br>
1.- Como usuario de algún servicio escolar se le puede solicitar información personal, que varía según el caso, relativa a:<br>
•	Su nombre, domicilio, fecha y lugar de nacimiento, estado civil, ocupación, comprobante de domicilio, Registro Federal de Contribuyentes, relaciones de parentesco, entre otros.<br>
•	Su correo electrónico y número telefónico.<br>
•	La misma información sobre su padre o tutor en caso de ser menor de edad.<br>
•	Comprobantes oficiales que acrediten su identidad y la información que usted declara, así como su RFC y CURP.<br>
•	Su imagen.<br>
2.- Sus datos serán utilizados para formalizar su proceso de inscripción en la Universidad Digital de México y gestionar todos los trámites ante las autoridades educativas correspondientes como CENEVAL, EXBACH, PREPA ABIERTA Y/O SECRETARÍA DE EDUCACIÓN PÚBLICA.<br>
3.- Sus datos personales solo son tratados por el personal de la Universidad Digital de México y solo pueden ser compartidos con las instituciones antes mencionadas, salvo autorización expresa de su parte.<br>
4.- Usted puede solicitar en cualquier momento la recuperación de sus documentos originales y/o con copia en posesión de la escuela de forma independiente y sin importar que existan adeudos por conceptos educativos.<br><br>


<br><br><br>
<div align='center'>     _________________________________________<br>$nom $apepa $apema</div> <br><br><br><br>
<hr id='linea4' class=fondo_azul_verde_claro '><br>
<center>Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.</center><br>
<center>www.udimex.net</center>

</div>



<div class='page'>
<center> <img src='../../general/imagen/logo.png' width=310px height:600px;></center><br><hr id='linea1' class=fondo_rojo '><hr id='linea2' class=fondo_azul '>
<h2>Hola $nom $apepa $apema</h2> 

<p>Por este medio te damos la cordial bienvenida a la Universidad Digital de México, te comentamos que tanto alumnos presenciales o como nuestros alumnos en línea tienen acceso a nuestra plataforma.</p> <br>

Tu cuenta ha sido creada y desde este momento puedes tener acceso, primero abre tu navegador de internet y coloca la siguiente dirección:
<br>
<div align='center' class='letrarr'>www.udimex.net</div>

<p>Tus datos de acceso son:</p>
<div align='center'>
<div class='borde'>usuario:<div align='center' class='letrar'>$usuario</div>contraseña:<div class='letrar'>$clave</div></div></div>
<br>


<p>Tu fecha de inicio de clases es el <b>$f_inicio</b>, tu día de pago es el <b>$dp de cada mes</b> y tu primer pago sería el <b>$f_pago</b>.</p>


<p>Adicional a la plataforma, tus profesores se pondrán en contacto contigo dos veces por semana para checar avances o dudas, esto mediante videoconferencia usando la aplicación de Google Meet.</p>
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


<div class='page'>
	<center><img src='../../general/imagen/logo.png' width=300px;></center><br>
	<hr id='linea1' class='fondo_rojo'>
	<hr id='linea2' class='fondo_azul'>
	<h2 align='center'><mark>MÉTODOS DE PAGO</mark></h2>
	<div class='borde122'> <div align='center'><img src='../../general/imagen/bancoppel.png' width=15%> </div>
	<table border='0' width='70%' align='center'>
		<tr><th>Titular: </th><td>Alfredo Tomás Dorado Flores</td></tr>
		<tr><th>CLABE: </th><td>1374 2010 4212 4575 02</td></tr>
		<tr><th>Tarjeta: </th><td>4169 1614 0028 9426</td></tr>
	</table>
	<br>
	<div align='center'><mark> <b>O DESDE TU CELULAR CON LA APP DE TU BANCO CON LOS MISMOS DATOS</b></mark></div><br>
	</div><br>

	<div class='borde122'> <div align='center'><img src='../../general/imagen/banco azteca.jpg' width=20%> </div>
	<table border='0' width='70%' align='center'>
		<tr><th>Titular: </th><td>Alfredo Tomás Dorado Flores</td></tr>
		<tr><th>CLABE: </th><td>1274 2001 3190 0335 05</td></tr>
		<tr><th>Tarjeta: </th><td>4027 6658 1431 5579</td></tr>
	</table>
	<br>
	<div align='center'><mark> <b>O DESDE TU CELULAR CON LA APP DE TU BANCO CON LOS MISMOS DATOS</b></mark></div><br>
	</div><br>


	<div class='borde122'> <div align='center'><img src='../../general/imagen/bbva.png' width=20%> </div>
	<table border='0' width='70%' align='center'>
		<tr><th>Titular: </th><td>Alfredo Tomás Dorado Flores</td></tr>
		<tr><th>CLABE: </th><td>0124 2001 5943  8264 67</td></tr>
		<tr><th>Tarjeta: </th><td>4152 3141 7476 2180</td></tr>
	</table></div>
	<br>
	<div class='borde122'> <div align='center'><img src='../../general/imagen/oxxo.jpg' width=15%> </div>
	<table border='0' width='70%' align='center'>
		<tr><th>Titular: </th><td>Alfredo Tomás Dorado Flores</td></tr>
		<tr><th>CLABE: </th><td>1374 2010 4212 4575 02</td></tr>
		<tr><th>Tarjeta: </th><td>4169 1614 0028 9426</td></tr>
	</table>
	
	</div>

	<hr id='linea4' class=fondo_azul_verde_claro '><br>
	<center>Av. 16 de Septiembre 303, San Miguel, 51354 San Miguel Zinacantepec, Méx.</center><br>
	<center>www.udimex.net</center>
</div>";



?>
</body>
</html>

