<?php
	session_start();
	include("../general/funcion/basica.php");
	include("../general/consultas/basic.php");
	include("../general/consultas/pagos.php");
	include("../general/consultas/materias.php");
	
	carga_estilo('../');
?>

	<body>
<?php
	permiso();
	menu('../');

	
	$al=$_SESSION["g_id"];


	     

echo "";
menu_flota();
mysqli_free_result($datos);


?>

<center>

<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px;' align='center'>
    
					<a href="./Documentos/cd.pdf" download="Carta de Designación.pdf">
					    <img src='../general/imagen/icono_pdf.png' width='120px' height='100px'>
					 <h3>Carta de Designación</h3></a>
				
					
</div>


<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px;' align='center'>
        
					<a href="./Documentos/ca.pdf" download="Carta de Aceptación.pdf">
					<img src='../general/imagen/icono_pdf.png' width='120px' height='100px'>
					 <h3>Carta de Aceptación</h3></a>
				
    					
</div>


<div class='w3-card-4 linea2 w3-margin w3-white' style='width:310px;' align='center'>
        
					<a href="./Documentos/hr.pdf" download="Hoja de Respuestas.pdf">
					<img src='../general/imagen/icono_pdf.png' width='120px' height='100px'>
					 <h3>Hoja de Respuestas</h3></a>
				
    					
</div>
<br><br>

<div class='w3-card-4 linea2 w3-margin w3-white' style='width:510px;' align='center'>

<video width="450" height="240" controls>
    
    <source src="./Documentos/ca.mp4" type="video/mp4">
    
</video>
<h5>Llenado de formato de Carta de Aceptación</h5>
</div>


<div class='w3-card-4 linea2 w3-margin w3-white' style='width:510px;' align='center'>

<video width="450" height="240" controls>
    
    <source src="./Documentos/cd.mp4" type="video/mp4">
    
</video>
<h5>Llenado de formato de Carta de Designación</h5>
</div>




<br><br><br><br><br><br><br><br><br>

</center>
	</body>
</html>
