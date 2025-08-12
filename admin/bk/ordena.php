<?php
session_start();
include("../consultas.php");
//include("../todos.php");
include("funciones.php");

cabeza();
permiso();

echo "<link href='estilo/estilo.css' type='text/css' rel='stylesheet'>
<script>
	function siguiente(){
		mod=document.getElementById('mod').value;
		if (mod>0){
			document.getElementById('oculta').style.display='block';
		}
		else{
			document.getElementById('oculta').style.display='none';
		}
	}
</script>
</head><body>";
usuario();
menu_i();



if ($_POST){
	echo "FUN:".$_POST['fun'];
	if ($_POST['fun']==1){
		$id=$_POST['id'];
		$ant=$_POST['ant'];
		act_ord($id,0);
		act_ord($ant,$id);
		act_ord(0,$ant);
	}
	if($_POST['fun']==2){
		$mat=$_POST['mat'];
		$mod=$_POST['mod'];
		$tit=$_POST['titulo'];
		

		$dato=t_vacio();
		if($fila=mysqli_fetch_assoc($dato)){
			a_tema($mat,$mod,$tit,$_SESSION["ad_prof"],$fila['id_tema']);
			$id=$fila['id_tema'];
		}
		else{
			$id=g_tema($mat,$mod,$tit,$_SESSION["ad_prof"]);
		}
		echo "<script type='text/javascript'> top.window.location='material_crea.php?tema=$id'; </script>";
	}
}



$dato=b_materia($_GET['mat']);
$fila=mysqli_fetch_assoc($dato);

echo "<br><br><br><center><font size='7' color='#ee9999'>".$fila['nombre']."</font><hr>

<br><br><fieldset align='center'>NUEVO MÓDULO</fieldset><br><br>
";

$datos=b_tem_prof($_GET['mat'],$_SESSION["ad_prof"]);
while($fila=mysqli_fetch_assoc($datos)){
	$datos2=curso_muestra($fila['id_tema']);
	while($fila2=mysqli_fetch_assoc($datos2)){
		$datos3=mat_ord($fila2['id_material']);
		$fila3=mysqli_fetch_assoc($datos3);
		$datos3=mat_ord($fila2['id_material']);
		if (!$fila3=mysqli_fetch_assoc($datos3)){
			g_ord($fila2['id_material']);
		}

	}
	
}

$ant=0;
$modulo=0;
$mm=1;
$aux=0;
$datos=b_ord($_GET['mat'],$_SESSION["ad_prof"],"orden","");
echo "<table border='0'><tr id='tab4'><th># Mod</th><th>Tema</th><th>#</th><th>Subtema</th><th colspan='2'></th></tr>";
while($fila=mysqli_fetch_assoc($datos)){
	if ($modulo!=$fila['modulo']){
		echo "<tr id='tab3'><th>".$fila['modulo']."</th><th>".$fila['titulo']."</th><th></th><th>
		<form method='POST' action='material_crea.php'>
		<input type='hidden' value='".$fila['id_tema']."' name='tema'><br>
		<input type='submit' value='Agregar Subtema'></form></th><th colspan='2'><a href='curso_cuestionario.php?tema=".$fila['id_tema']."'> <input type='button' value=' ? '></a>
<a href='curso_cues_edita.php?tema=".$fila['id_tema']."'><input type='button' value=' EC '> </a></th></tr>";
	}
	if($aux==0){
		$es="tab2";
		$aux=1;
	}
	else{
		$es="tab1";
		$aux=0;
	}
	
	echo "<tr id='$es'><td colspan='2'></td><th>".$fila['id_material']."</th><td>".$fila['subtitulo']."
	</td><td><a href='editor.php?cont=".$fila['id_material']."'>Editar</a></td>";
	if ($modulo==$fila['modulo']){
		echo "<td><form method='POST'><input type='hidden' name='id' size=2 value='".$fila['id_orden']."'>
		<input type='hidden' name='ant' size=2 value='".$ant."'><input type='hidden' name='fun' value='1'>
		<input type='submit' value='Subir'></form></td>";
	}

	echo "</tr>";
	$ant=$fila['id_orden'];
	$modulo=$fila['modulo'];
	if ($mm==$modulo){
		$mm=$mm+1;
	}
}
$max=$mm+3;
echo "<form method='POST'>
Módulo <input type='number' name='mod' value='$mm' size=2 min='$mm' max='$max'><br>

Tema<input type='text' name='titulo' >
<input type='hidden' value='".$_GET['mat']."' name='mat'>
<input type='hidden' value='2' name='fun'>
<input type='submit' value='Crear Tema'>

</form><br><br><hr><br><br></table>";


?>
