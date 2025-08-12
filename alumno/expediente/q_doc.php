<?php
session_start();
include("../general/todos.php");
include("../consultas/expediente.php");

if($_GET){
	q_doc($_GET['id']);
}

$pagina='location: index.php?c=2#bot';

header($pagina);

?>
