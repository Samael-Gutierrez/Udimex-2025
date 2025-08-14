<?php
$dir = "../../../general/";
include($dir."db/notificacion.php");
include($dir."db/basica.php");

$id=$_GET["id"];
cambio_de_estado($id);

?>