<?php
session_start();

include("funciones.php");
include("../consultas.php");
permiso();
cabeza();

if($_POST){
    
$id=$_POST["id"];
$titulo=$_POST["titulo"];
$edic=$_POST["edicion"];
$edit=$_POST["editorial"];
$aut=$_POST["autor"];
registraLibro($id,$titulo,$edic,$edit,$aut);
    
   echo" <script>alert('Registro Exitoso');</script>";

}


echo "
<link href='estilo/registroLibros.css' rel='stylesheet'>
</head><body>";

usuario();

menu_i();

echo "<br><br><br><br><br><br>";



 echo "
<form action='' method='POST'>
Registro de Libros<br><br>
Numero del Libro:
<input type='text' name='id' size='15' required><br>
Titulo:
<input type='text' name='titulo' size='25' required><br>
Edición:
<input type='text'name='edicion' size='25' required><br>
Editorial:
<input type='text' name='editorial' size='25' required><br>
Autor:
<input type='text' name='autor' size='25' required><br>
<input type='submit' value='Guardar' >


</form
";




	

?>




    
</body>
</html>