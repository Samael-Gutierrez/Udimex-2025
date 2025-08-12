<?php
session_start();
	include('../funciones.php');
	include('../../general/consultas/basic.php');
	include('../../general/consultas/admin.php');
	include('../../general/consultas/alumno.php');
//permiso();
cabeza();
?>

		<title>Alumno</title>

		<script type='text/javascript' src='../../general/js/jquery-1.6.4.js'></script> 

		<script>

			function busca(){
				var url = 'busca.php';
				$.ajax({                        
			   		type: 'POST',                 
					url: url,                     
					data: $('#formulario').serialize(), 
					success: function(data)             
					{
						$('#resultado').html(data); 
							     
					}
				});
			}
			


		</script>




	</head>

	<body>
<?php
usuario("../../",'index.php');
menu_i();
?><br><br><center>

<canvas id="baja" width="180" height="150"></canvas>
<canvas id="cursando" width="180" height="150"></canvas>
<canvas id="certificado" width="180" height="150"></canvas>
<canvas id="2a" width="180" height="150"></canvas>
<canvas id="3a" width="180" height="150"></canvas>

<br><br><br>





		<form id='formulario'>
			<?php
			//$esc=$_SESSION["esc"];
			//echo "<input type='hidden' id='esc' name='esc' value='$esc'>";
			?>
			<center>
				
				<table border='0'>
					<tr>
						<td colspan='3'><p id='mensaje'>Escribe el nombre de alumno</p></td>
					</tr>
					<tr>
						<td><input type='text' id='nom' name='nom' placeholder='Nombre(s)' onkeyup='busca();'></td>
						<td><input type='text' id='ap' name='ap' placeholder='Apellido Paterno' onkeyup='busca();'></td>
						<td><input type='text' id='am' name='am' placeholder='Apellido Materno' onkeyup='busca();'></td>
						<td><input type='hidden' id='tp' name='tp' value='0'></td>
					</tr>
				</table>
			</center><br>
				
		</form>
		<div id='resultado'></div> 
		<script>busca();</script>	
	</body>
</html>

<?php
	$datos=b_us_edo2(0,0);
	$fila=mysqli_fetch_assoc($datos);
	echo "<script>var baja; baja=".$fila['r'].";</script>";

	$datos=b_us_edo2(0,2);
	$fila=mysqli_fetch_assoc($datos);
	echo "<script>var cursando; cursando=".$fila['r'].";</script>";

	$datos=b_us_edo2(0,1);
	$fila=mysqli_fetch_assoc($datos);
	$datos2=b_us_edo2(0,8);
	$fila2=mysqli_fetch_assoc($datos2);
	echo "<script>var certificado; certificado=(".$fila['r']+$fila2['r'].");</script>";

	$datos=b_us_edo2(0,4);
	$fila=mysqli_fetch_assoc($datos);
	echo "<script>var segunda; segunda=".$fila['r'].";</script>";

	$datos=b_us_edo2(0,5);
	$fila=mysqli_fetch_assoc($datos);
	echo "<script>var tercera;
		var total; 
		tercera=".$fila['r']."; 
	total=baja+cursando+certificado+segunda+tercera;
	baja=baja/total;
	cursando=cursando/total;
	certificado=certificado/total;
	segunda=segunda/total;
	tercera=tercera/total;
	</script>";

	
?>

<script>

var c = document.getElementById("baja");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.lineWidth = 10;
ctx.arc(50, 50, 40, 0.5 * Math.PI, (2 * Math.PI *baja) + (0.5 * Math.PI));
ctx.stroke();
ctx.font = "30px Arial";
ctx.fillText(baja*100 + '%', 20, 60);
ctx.font = "22px Arial";
ctx.fillText("Baja", 25, 120);

var c = document.getElementById("cursando");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(50, 50, 40, 0.5 * Math.PI, (2 * Math.PI *cursando) + (0.5 * Math.PI));
ctx.stroke();
ctx.font = "30px Arial";
ctx.fillText(cursando*100 + '%', 20, 60);
ctx.font = "22px Arial";
ctx.fillText("Cursando", 2, 120);

var c = document.getElementById("certificado");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.font = "30px Arial";
ctx.fillText(certificado*100 + '%', 30, 70);
ctx.font = "22px Arial";
ctx.fillText("Certificado", 2, 120);

ctx.strokeStyle = "#ffeb3b";
ctx.lineWidth = 10;
ctx.shadowBlur = 10;
ctx.shadowColor = "black";

ctx.arc(90, 75, 40, 0.5 * Math.PI, (2 * Math.PI *certificado) + (0.5 * Math.PI));
ctx.stroke();

var c = document.getElementById("2a");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(50, 50, 40, 0.5 * Math.PI, (2 * Math.PI *segunda) + (0.5 * Math.PI));
ctx.stroke();
ctx.font = "30px Arial";
ctx.fillText(segunda*100 + '%', 20, 60);
ctx.font = "22px Arial";
ctx.fillText("Segundo", 7, 120);
ctx.fillText("Examen", 10, 150);

var c = document.getElementById("3a");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(50, 50, 40, 0.5 * Math.PI, (2 * Math.PI *tercera) + (0.5 * Math.PI));
ctx.stroke();
ctx.font = "30px Arial";
ctx.fillText(tercera*100 + '%', 20, 60);
ctx.font = "22px Arial";
ctx.fillText("Tercer", 18, 120);
ctx.fillText("Examen", 10, 150);

</script>


