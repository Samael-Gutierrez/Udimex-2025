<?php
include('../funciones.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');




if($_GET){
	$id=$_GET['id'];
	$datos=b_usu($id);
	if ($fila=mysqli_fetch_assoc($datos)){
        	// Datos usuario
		$nom=$fila["nombre"];
		$apepa=$fila["ap_pat"];
		$apema=$fila["ap_mat"];	
     	}
 
	$datos=b_dat_pros($id);
	if ($fila=mysqli_fetch_assoc($datos)){
			// Datos prospecto
		$liga=$fila["m_contacto"];
		$ins=$fila["c_insc"];
		$cm=$fila["c_mens"];
		$ccer=$fila["c_cert"];
		$mo=$fila["modalidad"];
		$carrera=$fila["carrera"];
		$prom=$fila["id_promotor"];
	
	}
	
	$datos=b_dat_segpros($id);
	if ($fila=mysqli_fetch_assoc($datos)){

			// Datos prospecto_seguimiento
		$fecha=$fila["fecha"];
		$est=$fila["estatus"];
		$obs=$fila["observaciones"];
    	}
		

	$datos=busca_tel2($id);
		if ($fila=mysqli_fetch_assoc($datos)){
			//datos telefono
			$telefonoa=$fila["numero"];
			
		}

	//devuelve
		
	$dato=b_prom($prom);
	if ($fila=mysqli_fetch_assoc($dato)){

	   $prom=$fila['nombre']." ".$fila['ap_pat']." ".$fila['ap_mat'];
}
}

echo "<!DOCTYPE>

<html>
<head>
<link rel='stylesheet' href=''>
</head>
<body>
<div class='page'>


<h3> <center><b><span class=''>Registro Prospecto</span></b><br></center></h3>

<div align =center> #Seguimiento:<span class=''>$id</span></div>



 <br>  <center> Nombre:<span class=''> $nom $apepa $apema</span><br>
 <center>Teléfono personal:<span class=''>$telefonoa</span></center><br>

<center><b><span class=''>Informes</span></b></center>
<div align=center>Fecha:<span class=''>$fecha</span></div><br>
<center>Servicio ofrecido:<span class=''> $carrera </span>
Modalidad:<span class=''> $mo </span>
Medio de contacto:<span class=''> $liga </span>
Estatus:<span class=''> $est </span></center><br>
<br><br>


<b><center><span class=''>Costos</span></center></b>
<center>Inscripción:$<span class=''> $ins</span> Colegiatura mensual:$ <span class=''>$cm</span> Costo certificado:$ <span class=''>$ccer</span></center><br>
<br>

<b><center><span class=''>Observaciones</span></center></b>
<center><span class=''> $obs</span></center><br>
<br>

<b><center><span class=''>Promotor</span></center></b>
<center><span class=''> $prom</span></center><br>
<br>

</div>
<a href='inpros.php'><input type ='button' class='btp' value='Regresar'></a>

</body>";



?>
</body>
</html>












