<?php
//include("../todos.php");
session_start();
include("../funciones.php");
include("../../general/consultas/basic.php");
include("../../general/consultas/admin.php");
include("../../general/consultas/materias.php");
include("../../general/consultas/cuestionario.php");
cabeza();

echo "</head><body>";

usuario("../../","index.php");
menu_i();

echo "<br><br><br><br><br>";
//$control=0;

if ($_GET){
	$tema=$_GET['tema'];
	$datos=b_preg($_GET['id']);
	if ($fila=mysqli_fetch_assoc($datos)){
		$p=$fila['pregunta'];
		$id=$fila['id_pregunta'];
	}

	$datos2=res($_GET['id'],"order by tipo desc");
	$i=0;
	while ($fila2=mysqli_fetch_assoc($datos2)){
		$r[$i]=$fila2['respuesta'];
		$i++;
	}

	formulario($id,$p,$r[0],$r[1],$r[2],$r[3],$r[4]);
}
/*else{
	//$control=$control+1;
}*/




if ($_POST){
	$error="";
	$actualiza=0;
	if (strlen(trim($_POST['pregunta']))<=0){
		$error=$error."La pregunta no puede estar en blanco<br>";
	}

	if (strlen(trim($_POST['r1']))<=0){
		$error=$error."La respuesta correcta no puede estar en blanco<br>";
	}

	if (strlen(trim($_POST['r2']))<=0){
		$error=$error."La pregunta debe proponer por lo menos una segunda opción<br>";
	}

	if($_POST['id']>=0){
		$actualiza=1;
		$id=$_POST['id'];
	}

	if (strlen($error)==0){
		$sub=$_POST['subtema'];
		if ($actualiza==0){
			$id=g_preg($_POST['pregunta'],$sub,1);
			formulario(0,"","","","","","");
			$mensaje="Se guardó la pregunta correctamente, puedes volver a llenar el formulario para otra pregunta";
			 
		}
		else{
			echo "actualiza";
			a_preg($id,$_POST['pregunta'],$sub,1);
			e_res($id);
			$mensaje="Se actualizó la pregunta correctamente, puedes volver a llenar el formulario para otra pregunta";
			$dir="<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=curso_cues_edita.php?tema=".$_POST['tema']."'>";
		}
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

		echo $menesaje;
	}
	else{
		formulario(0,$_POST['pregunta'],$_POST['r1'],$_POST['r2'],$_POST['r3'],$_POST['r4'],$_POST['r5']);
		echo "Verifica los siguiente: <br><br> $error";
	}
}
else{
	//$control=$control+1;
	formulario(0,"","","","","","");
}

/*if ($control==2){
	formulario(0,"","","","","","");
}*/


if ($actualiza==1){
	echo $dir;
}

function formulario($id,$p,$r1,$r2,$r3,$r4,$r5){

$dato2=curso_muestra($_GET['tema']);
	echo "<form method='POST'>

		<input type='text' value='$id' name='id'>
		<input type='text' value='".$_GET['tema']."' name='tema'>
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
		<select name='subtema'>";
		while($fila2=mysqli_fetch_assoc($dato2)){
			echo "<option value='".$fila2['id_material']."'>".$fila2['subtitulo']."</option>";	
		}
		echo "</select><br><br>
	</form>
";
}

?>






</body>
</html>

