<?php
include('../../general/consultas/basic.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/promotor.php');
include('../../general/consultas/prospecto.php');
 
 //Datos usuario

$nom=$_POST["nombre"];
$apepa=$_POST["ap"];
$apema=$_POST["am"];



// Datos prospecto
$liga=$_POST["liga"];
$ins=$_POST["ins"];
$cm=$_POST["cm"];
$ccer=$_POST["cert"];
$mo=$_POST["mo"];
$carrera=$_POST["carrera"];
$prom=$_POST["prom"];
if($ins<=0){
	$ins=0;
	}
	if($cm<=0){
		$cm=0;
		
	}
	if($ccer<=0){
		$ccer=0;
		}

//Datos prospecto_seguimiento


$est=$_POST["est"];
$obs=$_POST["obs"];




//datos telefono
$telefonoa=$_POST["telef"];
if($telefonoa<=0){
	$telefonoa=0;
	}


$id=guarda_uprospecto($nom,$apepa,$apema);
guarda_prospecto($id,$liga,$ins,$cm,$ccer,$mo,$carrera,$prom);
g_pros_seg($id,$est,$obs);



if (strlen($telefonoa)>0){
	g_telpros($telefonoa,$id);
}

header('Location: recu_prospecto.php?id='.$id);

?>
