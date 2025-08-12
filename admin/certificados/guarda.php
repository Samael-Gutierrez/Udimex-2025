<?php
include ("../../general/consultas/basic.php");
include ("../../general/consultas/certificados.php");

$control=$_POST['control'];
for($i=1;$i<$control;$i++){
	$edo=$_POST['op'.$i];
	if($edo>0){
		$id=$_POST['us'.$i];
		$obs=$_POST['obs'.$i];
		guarda_seguimiento($id,$edo,$obs);
	}
}

header("location:index.php");
?>
