<?php
//include('Notificaciones/campana.php');


function usuario($raiz,$pag){
echo "<table border='0' align='right'>
	<tr>

		<th rowspan='3' width='50px'>";
		campana();
			echo "
		</th>
	</tr>
	<tr>
		<td>Bienvenido</td>
		<th rowspan='2' width='50px'>
			
			<a href='".$raiz."salir.php'><img src='".$raiz."general/imagen/cierra.png' title='Cerrar sesión' width='25px'></a>
		</th>
	</tr>
	<tr>
		<td><b>".$_SESSION["ad_nom"]." ".$_SESSION["ad_ap"]."</b></td>

	</tr>
</table>";
}

function cabeza($titulo,$adicional){
echo "
<!DOCTYPE HTML>
<html>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
    $adicional
    <title>$titulo</title>
</head>";
}

function menu_i(){
   
	$i=0;
	$datos=b_acceso($_SESSION["ad_id"]);
	
	/*
	$m_pr="";
	$m_ad="";
	$m_pu="";
	*/

	$id_area=0;
	$area="";



	while($fila=mysqli_fetch_assoc($datos)){
		if ($id_area!=$fila['id_area']){
			if($area!=""){
				$area=$area."</div></div>";
			}
			$area=$area."<div class='w3-dropdown-hover'>
				<button class='w3-button'>".$fila['descr']."</button>
				<div class='w3-dropdown-content w3-bar-block w3-card-4'>";
		}

		$area=$area."<a href='../".$fila['url']."' class='w3-bar-item w3-button'>".$fila['nombre']."</a>";
		$i=$i+1;
		$id_area=$fila['id_area'];
	}
	$area=$area."</div></div>";

		/*
		

		if ($fila['descr']=='PROFESOR'){
			$m_pr=$m_pr."<a href='../".$fila['url']."' class='w3-bar-item w3-button'>".$fila['nombre']."</a>";
		}

		if ($fila['descr']=='ADMINISTRADOR'){
			$m_ad=$m_ad."<a href='../".$fila['url']."' class='w3-bar-item w3-button'>".$fila['nombre']."</a>";
		}

		if ($fila['descr']=='PUBLICIDAD'){
			$m_pu=$m_pu."<a href='../".$fila['url']."' class='w3-bar-item w3-button'>".$fila['nombre']."</a>";
		}
	}

	if($m_pr!=""){
		$m_pr="
		<div class='w3-dropdown-hover'>
			<button class='w3-button'>Profesor</button>
			<div class='w3-dropdown-content w3-bar-block w3-card-4'>
				$m_pr
			</div>
		</div>";
	}

	if($m_ad!=""){
		$m_ad="
		<div class='w3-dropdown-hover'>
			<button class='w3-button'>Administrador</button>
			<div class='w3-dropdown-content w3-bar-block w3-card-4'>
				$m_ad
			</div>
		</div>";
	}

	if($m_pu!=""){
		$m_pu="
		<div class='w3-dropdown-hover'>
			<button class='w3-button'>Publicidad</button>
			<div class='w3-dropdown-content w3-bar-block w3-card-4'>
				$m_pu
			</div>
		</div>";
	}*/



	if ($i>0){
		echo "
			<div class='w3-bar w3-light-grey'>
				<a href='../menu.php' class='w3-bar-item w3-button'>Inicio</a>
				$area
			</div>";

	}
	else{
		echo "<script type='text/javascript'> top.window.location='../horario_muestra.php'; </script>";
	}

				
}




// aumenta días a una fecha dada
function m_dias($fecha,$dias){
	list($anio, $mes, $dia) = explode("-", $fecha);
	$fc=$dia+$dias;
	return date('Y-m-d', mktime(0, 0, 0, $mes, $fc, $anio));	
}

function aleatorio($longitud){
	$caracteres = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
	$cadena = "";
	for($i=0;$i<$longitud;$i++){
	    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1);
	}
	return $cadena;
}

?>


