<?php
    session_start();
    $dir="../../general/";
    include($dir."db/basica.php");
    include($dir."db/publicidad.php");
    
if(!empty($_GET["id"])){
    $id=$_GET["id"];
    borrar($id); 
}
header("location:index.php");
// borrar publicacion
?>
