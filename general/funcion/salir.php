<?php
session_start();
include("../consultas/basic.php");
include("../consultas/general.php");
$us=$_SESSION["g_id"];
$nom=$_SESSION["g_nom"];
$ap=$_SESSION["g_ap"];

bitacora($us,"CIERRA SESION");
Session_destroy();
?>

<script type='text/javascript'> top.window.location='../../'; </script>




