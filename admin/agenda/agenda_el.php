<?php
session_start();
include("../../general/consultas/basic.php");
include("../../general/consultas/calendario.php");

//Guarda por primera vez
if ($_GET){
	a_ev2($_GET['id'],0);
}

$red=explode("@",$_SESSION['fecha_anterior']);




echo "<script>
	top.window.location='index.php';

</script>";

?>
