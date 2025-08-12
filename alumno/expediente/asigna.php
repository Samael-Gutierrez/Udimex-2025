<?php
session_start();
$dato=$_GET['id'];
$tp=$_GET['tp'];

switch ($tp) {
	case 1:
		$_SESSION['exp']=$dato;
		$red="location: ../expediente";
	break;
	case 2:
		$_SESSION['pac']=$dato;
		$red="location: ../expediente/paciente.php";
	break;
	default:
		$red="location: ../principal";
}

header($red);
?>

