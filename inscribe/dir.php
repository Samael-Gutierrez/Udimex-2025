
<?php

include("../general/consultas/usuario.php");
include("../general/consultas/basic.php");

$cp=$_POST["cp"];
$res="";

$dat=contruye($cp,'estado');
$res=$res.$dat;

$dat=contruye($cp,'municipio');
$res=$res.$dat;

$dat=contruye($cp,'colonia');
$res=$res.$dat;

$dat=contruye($cp,'calle');
$res=$res.$dat;

function contruye($cp,$columna){
	$datos=b_dom($cp,$columna);
	$res="<datalist id='l$columna'>";
	while($fila=mysqli_fetch_assoc($datos)){
		$res=$res."<option value='".$fila['r']."'>";  
	}
	$res=$res."</datalist>";
	return $res;
}

echo $res;


?>

