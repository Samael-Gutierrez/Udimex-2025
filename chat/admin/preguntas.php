<?php
include('../consultas/basic.php');
include('../consultas/chat.php');

if ($_POST){
	$pro=$_POST['pro'];
	$ro=$_POST['ro'];
	$pregunta=$_POST['pregunta'];
	$tp=$_POST['tp'];

	

	if ($tp==1){
		$id=g_pregunta($pregunta,1);
		g_respuesta($id,1,0);
		g_respuesta($id,2,0);
		a_respuesta($pro,$ro,$id);
	}

	if ($tp==2){
		$id=g_pregunta($pregunta,2);
		g_respuesta($id,0,0);
		a_respuesta($pro,$ro,$id);
	}

	if ($tp==3){
		$pl=$_POST['pl'];
		$id=g_pregunta($pregunta,1);
		for ($i=1;$i<=$pl;$i++){
			$resp=$_POST['r'.$i];
			if (strlen($resp)>0){
				$datos=b_respuestas3($resp);
				if($fila=mysqli_fetch_assoc($datos)){
					$id_resp=$fila['id_respuesta'];
				}
				else{
					$id_resp=g_respuesta2($resp);
				}
				g_respuesta($id,$id_resp,0);
			}
		}

		a_respuesta($pro,$ro,$id);
	}

	if ($tp==5){
		$id=g_pregunta($pregunta,1);
		a_respuesta($pro,$ro,$id);
		g_funcion(2,$id,"Termina Chat");
	}

}

$previas="<datalist id='previas'>";
$datos=b_respuestas2();
while($fila=mysqli_fetch_assoc($datos)){
	$previas=$previas."<option value='".$fila['respuesta']."'></option>";
}
echo $previas."</datalist>";





$datos=b_pregunta();
if($fila=mysqli_fetch_assoc($datos)){
	$id_pregunta=$fila['id_pregunta'];
	$pregunta=$fila['pregunta'];
	$id_respuesta=$fila['respuesta'];
	$respuesta=$fila['respuesta'];
}
else{
	$datos=b_pregunta3();
	if($fila=mysqli_fetch_assoc($datos)){
		$id_pregunta=$fila['id_pregunta'];
		$pregunta=$fila['pregunta'];
		$id_respuesta=0;
		$respuesta="";
	}
}

echo $id_pregunta.".- ".$pregunta."<br>".$respuesta;


echo "<br><br><form method='POST'>
	<input type='hidden' name='pro' value='".$fila['id_pregunta']."'>
	<input type='hidden' name='ro' value='".$fila['id_respuesta']."'>
	Siguiente pregunta:<br>
	<textarea name='pregunta' cols='50' rows='3'></textarea><br><br>
	Tipo:<br>
	<input type='radio' name='tp' onclick='accion(4);' value='4'>Pregunta de Apertura
	<input type='radio' name='tp' onclick='accion(5);' value='5'>Pregunta de Cierre
	<input type='radio' name='tp' onclick='accion(1);' value='1' checked>Si/No
	<input type='radio' name='tp' onclick='accion(2);' value='2'>Sin respuesta
	<input type='radio' name='tp' onclick='accion(3);' value='3'>Libre
	<input type='radio' name='tp' onclick='accion(6);' value='6'>Ligar a otra pregunta


	<input type='text' name='pl' id='pl' value='0' onchange='genera();'>

	<div id='pr_libre'>
	</div>
	<input type='button' value='+' onclick='ag_c();'>
	<input type='submit' value='Guardar'>
</form>

";

$preguntas="<div id='ligar' style=''>";
$datos2=b_pregunta2();
while($fila2=mysqli_fetch_assoc($datos2)){
	$preguntas=$preguntas.$fila2['pregunta']."<form method='POST' action='ligar.php'><input type='text' value='".$fila2['id_pregunta']."' name='origen'><input type='text' name='destino' value='".$fila['id_pregunta']."'><input type='text' name='res' value='".$fila['id_respuesta']."'><input type='submit' value='Ligar'></form><br><br>";
}
echo $preguntas."</div>";

?>

<script>
	function ag_c(){
		document.getElementById('pl').value=parseInt(document.getElementById('pl').value)+1;
		genera();
	}

	function accion(n){
		if (n==3){
			document.getElementById('pl').value=2;
			genera();
		}

		if (n==6){
			document.getElementById('pl').style.display='block';
		}
	}

	function genera(){
		pl=document.getElementById('pl').value;
		res="";
		for (i=1;i<=pl;i++){
			res=res + "Respuesta " + i + ":" + "<input list='previas' name='r" + i + "'><br>"; 
		}
		document.getElementById('pr_libre').innerHTML=res;
	}
</script>
