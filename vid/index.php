<?php
session_start();
include("consultas/consultas.php");

if ($_GET){
	$_SESSION['video']=$_GET['id'];
}

if (isset($_SESSION['video'])){
	$datos=b_prin($_SESSION['video']);
}
else{
	$datos=b_aleatorio();
}

if($fila=mysqli_fetch_assoc($datos)){
	$ext=$fila['ext'];
	$video="video/".$fila['video'].".".$ext;
	$de=$fila['de'];
	$para=$fila['para'];
	$titulo=$fila['titulo'];
}

?>

<!DOCTYPE>
<html>
<head>
	<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>
	<link rel='stylesheet' href='estilo/estilo.css'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<center>
<img src='imagen/logo.png' width='50%'><br><br>



<div class='w3-container w3-blue'>
  <center><h1>Subir <button class="w3-button w3-circle w3-teal" onclick="document.getElementById('id01').style.display='block'"> + </button></h1></center>
</div>

<div class='w3-row-padding w3-margin-top'>
<?php

	$datos=b_todo();

	while($fila=mysqli_fetch_assoc($datos)){
		$ext=$fila['ext'];
		$video="video/".$fila['video'].".".$ext;
		$de=$fila['de'];
		$para=$fila['para'];
		$titulo=$fila['titulo'];


		echo "
		<a href='$video' target='_blank'><div class='w3-quarter w3-margin-top'>
			<div class='w3-card w3-blue'>
				<img src='imagen/audio.png' width='80px'>
				<div class='w3-container'>
					<h3>\"$titulo\"</h3>
					<h6>Archivo subido por: $para</h6>
				</div>
			</div>
		</div></a>";
	}
?>
</div>


<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
      </div>

      <form class="w3-container" method='POST' action='sube.php' enctype='multipart/form-data'>
        <div class="w3-section">
          <label><b>Título:</b></label>
          <input class="w3-input w3-border" type="text" placeholder="Escribe el título de tu archivo" name="titulo"><br>
	<label><b>Selecciona tu archivo</b></label><br>
	<input type='file' name='doc'>
          <button class='w3-button w3-block w3-green w3-section w3-padding' type='submit'>Guardar</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancelar</button>
      </div>

    </div>
  </div>


</center>
</body>
</html>
