<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/calendario.php");



$red=explode("-",$_POST['fecha']);
$red="index.php?anio=".$red[0]."&mes=".$red[1]."&dia=".$red[2];

//Guarda por primera vez
if ($_POST['control']==1){
	$id=g_ev($_POST['asunto'],$_POST['desc'],$_POST['fecha'],$_POST['hi'],$_POST['hf'],$_POST['tipo'],$_SESSION['ad_id']);
	if ($_POST['tipo']==0){

		g_ev_per($id,$_POST['colab']);
	
	}

	if ($_POST['tipo']==1){
		g_ev_per($id,$_POST['reg']);
	}
}


//Actualiza el evento
if ($_POST['control']==2){
	a_ev($_POST['evento'],$_POST['desc'],$_POST['fecha'],$_POST['hi'],$_POST['hf'],$_POST['tipo']);
	if ($_POST['tipo']==0){
		a_ev_per($_POST['evento'],$_POST['colab']);
	}

	if ($_POST['tipo']==1){
		a_ev_per($_POST['evento'],$_POST['reg']);
	}
}

//Cambia el estado de un evento
if ($_GET){
	a_ev2($_GET['ev'],$_GET['es']);
}







echo "<script>
	top.window.location='$red';

</script>";

?>
