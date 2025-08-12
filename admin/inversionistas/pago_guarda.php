<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/pagos.php");
include("../../general/consultas/inv.php");

if ($_POST){
	if($_POST['cantidad']>0){
		g_inv($_POST['cantidad'],$_POST['usuario']);
	}
	
	header('location:index.php');
}
?>
