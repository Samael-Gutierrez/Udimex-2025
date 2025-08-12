<?php
include("../todos.php");
include("../consultas.php");
cabeza(2);
?>

<script src="../estilo/jquery-1.6.4.js" type="text/javascript"></script>
<link href='../estilo/estilo.css' type='text/css' rel='stylesheet' />	
<script>

</script>
</head>

<body>


<?php
	elige();
?>


</body>
</html>

<?php
	function f_1($ch){
		$ch1="";
		$ch2="";
		if ($ch==1){
			$ch1="checked";
		}
		if ($ch==2){
			$ch2="checked";
		}
		echo "
	<form name='f1' method='POST'>
		Bacillerato:<br>
		<input type='radio' name='ba' value='pa' onclick='submit();' $ch1>Prepa Abierta<br>
		<input type='radio' name='ba' value='ce' onclick='submit();' $ch2>CENEVAL<br><br>
		<input type='hidden' name='c' value='1'>
	</form>";
	}

function elige(){

	if ($_POST){
		if($_POST['c']==1){
			if ($_POST['ba']=="pa"){
				echo "<table border='1'><tr><td>";
				f_1(1);
				echo "</td><td>";
				f_2(0);
				echo "</td></tr></table>";
			}
			else{
				echo "<table border='1'><tr><td>";
				f_1(2);
				echo "</td><td>";
				f_3();
				echo "</td></tr></table>";
			}
		}

		if($_POST['c']==2){
			echo "<table border='1'><tr><td>";
			f_1(1);
			echo "</td><td>";
			f_2($_POST['sem']);
			echo "</td><td>";
			f_4();
			echo "</td></tr></table>";
		}
	}
	else{
		f_1(0);
	}
}

	function f_2($ch){
		echo "
	<form name='f2' method='POST'>
		Semestre<select name='sem' onchange='submit();'>";

	for ($i=0;$i<=6;$i++){
		if($i==$ch){

			$s="selected";
		}
		else{
			$s="";
		}

		
		echo "<option value='$i' $s>$i</option>";
	}
echo "
		</select>
		<input type='hidden' name='c' value='2'>
	</form>";
	}


	function f_3(){
		
		echo "
	<form name='f3' method='POST' action='curso_tema.php'>
		Selecciona la Materia
		<select name='mat'>
		<option value='68'>Habilidad de Expresión Escrita y Argumentativa</option>
		<option value='69'>Matemáticas</option>
		<option value='70'>Ciencias Experimentales</option>
		<option value='71'>Ciencias Sociales</option>
		<option value='72'>Humanidades</option>
		<option value='73'>Habilidad Comunicativa y Lectora</option>
		</select>
		<input type='hidden' name='c' value='3'>
		<input type='submit' value='Enviar'>
	</form>";
	}

	function f_4(){
			echo "<form name='f3' method='POST' action='curso_tema.php'>";
			$datos=b_mat($_POST['sem']);
			echo "<select name='mat'>";
			while($fila=mysqli_fetch_assoc($datos)){
				echo "<option value='".$fila['id_materia']."'>".$fila['nombre']."</option>";
			}
			echo "</select>
			<input type='submit' value='Enviar'></form>";
	}
?>

