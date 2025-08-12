<?php
session_start();
include("../../general/consultas/basic.php");
//include("../../general/consultas/admin.php");
include("../../general/consultas/promotor.php");

if ($_POST){
	$pres=0;
	$ln=0;
	$us=$_SESSION["ad_id"];
	$nivel=$_POST['nivel'];
	$ins=$_POST['ins'];
	$mens=$_POST['mens'];
	$prom=$_POST['prom'];
	$cert=$_POST['cert'];
	$fi=$_POST['fi'];
	$ff=$_POST['ff'];
	$fc=$_POST['fc'];
	$tp=$_POST['tp'];

	if(isset($_POST['pres'])){
		$pres=$_POST['pres'];
	}
	
	if(isset($_POST['ln'])){
		$ln=$_POST['ln'];
	}

	if ($mens<1){
		$mens=0;
	}

	$mod=$pres+$ln;

	if ($tp<1){
		g_liga($us,$nivel,$ins,$mens,$prom,$cert,$mod,$fi,$ff,$fc);
	}
	else{
		a_liga($tp,$nivel,$ins,$mens,$prom,$cert,$mod,$fi,$ff,$fc);
	}
}

header("location: liga.php");

?>
