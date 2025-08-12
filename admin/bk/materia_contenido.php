<?php
include("../consultas.php");
include("../todos.php");


cabeza(2);

echo "<link href='../estilo/estilo.css' type='text/css' rel='stylesheet' /><link href='../estilo/estilos.css' type='text/css' rel='stylesheet' /></head><body><br><br><br><center>";

if($_POST){
$mat=$_POST['mat'];
$des=$_POST['des'];
$sem=$_POST['sem'];
$dura=$_POST['dura'];
$id=$_POST['id'];

act_mat($mat,$des,$sem,$dura,$id);

echo "<script type='text/javascript'> top.window.location='materia_edita.php'; </script>";
}
else{
$mat=$_GET['mat'];
$datos=b_materia($mat);
$fila=mysqli_fetch_assoc($datos);


echo "<form method='POST'>
Materia:<input type='text' value='".$fila['nombre']."' name='mat'><br>
Descripción: <textarea name='des' cols='100' rows='10'>".$fila['descripcion']."</textarea><br>
Semestre: <input type='text' value='".$fila['semestre']."' name='sem'><br>
Duración: <input type='text' value='".$fila['duracion']."' name='dura'><br>
<input type='hidden' value='".$fila['id_materia']."' name='id'><br>
<input type='submit' value='Actualizar'>
</form>";

}


?>






</body>
</html>

