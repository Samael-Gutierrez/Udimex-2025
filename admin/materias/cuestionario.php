<?php
//include("../todos.php");
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/materias.php");
include("../../general/consultas/cuestionario.php");
cabeza("","");

echo "</head><body>";

usuario("../../","index.php");
menu_i();

echo "<br><br><br><br><br>";
//$control=0;






if ($_POST){
	$id=g_preg($_POST['pregunta'],$material,1);
	formulario(0,"","","","","","");
	$mensaje="Se guardó la pregunta correctamente, puedes volver a llenar el formulario para otra pregunta";
			 
		
		

		for($i=1;$i<=5;$i++){
			if($i==1){
				$tipo=1;
			}
			else{
				$tipo=0;
			}
			if (strlen(trim($_POST['r'.$i]))>0){
				g_res($_POST['r'.$i],$tipo,$id);
			}
		}

		echo $mensaje;
}
else{
	//$control=$control+1;
	formulario(0,"","","","","","");
}

/*if ($control==2){
	formulario(0,"","","","","","");
}*/





function formulario($id,$p,$r1,$r2,$r3,$r4,$r5){
if ($_GET){
    $material=$_GET["sub"];
}
$dato2=curso_muestra($material);
	echo "<form method='POST'>

		<input type='text' value='$id' name='id'>
		<input type='text' value='$material' name='tema'>
		Pregunta:<br>
		<textarea name='pregunta' cols='50' rows='3'>$p</textarea><br><br>

		Respuestas:<br>
		<img src='../../general/imagen/bien.png' align='left' width='20'><input type='text' name='r1' value='$r1' size='80'><br>
		<img src='../../general/imagen/mal.png' align='left' width='20'><input type='text' name='r2' value='$r2' size='80'><br>
		<img src='../../general/imagen/mal.png' align='left' width='20'><input type='text' name='r3' value='$r3' size='80'><br>
		<img src='../../general/imagen/mal.png' align='left' width='20'><input type='text' name='r4' value='$r4' size='80'><br>
		<img src='../../general/imagen/mal.png' align='left' width='20'><input type='text' name='r5' value='$r5' size='80'><br><br>
		<center><input type='submit' value='Guardar'></center>";

		echo "Tema:
		<input type='text' name='subtema' value='$material'>


	</form>
";
}

?>






</body>
</html>

