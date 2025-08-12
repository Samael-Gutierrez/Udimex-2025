<?php
session_start();
include("../general/funcion/basica.php");
include("../general/consultas/pagos.php");
include("../general/consultas/basic.php");
include("../general/consultas/materias.php");




$us=$_SESSION["g_id"];
$mat=$_SESSION['mat'];
$tema=$_SESSION['tema'];
$sub=$_SESSION['sub'];



$bien=0;
$mal=0;

echo "<ol>";
if($tope=$_POST['tope']){
	for($i=1;$i<$tope;$i++){
		if(isset($_POST["p$i"])){
			$r=$_POST["p$i"];
			$d1=evalua($r);
			$f1=mysqli_fetch_assoc($d1);
			mysqli_free_result($d1);

			if ($f1['tipo']==1){
				$f='bien';
				$bien=$bien+1;
			}
			else{
				$f='mal';
				$mal=$mal+1;
			}
		}
		else{
		
			$mal=$mal+1;
		}
		
	}

	$calif=round(($bien*10/($bien+$mal)),1);
	g_calificacion($calif,$tema,$us);
}




	




header("location:index.php");
?>






	</body>
</html>
