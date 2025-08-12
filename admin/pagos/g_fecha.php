<?php
include("../../general/consultas/basic.php");
include("../../general/consultas/pagos.php");


if ($_POST){
	$fpag=$_POST['fpag'];
	$alumno=$_POST['alumno'];

	a_fp($fpag,$alumno);

	header('location:index.php');
}
?>
