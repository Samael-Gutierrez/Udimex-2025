<?php
session_start();
$dir = "../../general/";
include($dir."db/basica.php");
include($dir."db/calendario.php");

//Guarda por primera vez
if ($_GET){
	a_ev2($_GET['id'],0);
}

$red=explode("@",$_SESSION['fecha_anterior']);




echo "<script>
	top.window.location='index.php';

</script>";

?>
