<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/carrera.php');
include('../general/db/materia.php');


if (!isset($_SESSION['id'])){
	header('location:../index.php');
	die();
}

$verifica=verifica_cuenta();

// Documento1
// Verifica si el usuario tiene por lo menos una carrera guardada

$datos= busca_carrera();

$tec11="<option></option>";
$tec12="<option></option>";
$ing="<option></option>";
$lic="<option></option>";

while($fila=mysqli_fetch_assoc($datos)){
	if($fila['tipo']==1){
		if($fila['estado']==1){
			$tec11=$tec11."<option value='".$fila['id_carrera']."'>".$fila['carrera']."</option>";
		}
		if($fila['estado']==2){
			$tec12=$tec12."<option value='".$fila['id_carrera']."'>".$fila['carrera']."</option>";;
		}
	}
	
	if($fila['tipo']==2){
		$ing=$ing."<option value='".$fila['id_carrera']."'>".$fila['carrera']."</option>";
	}
	
	if($fila['tipo']==3){
		$lic=$lic."<option value='".$fila['id_carrera']."'>".$fila['carrera']."</option>";
	}
}

//Muestra el periodo
$tec_cuatri="<option></option>";
$ing_cuatri="<option></option>";
$datos=busca_periodo();
if($fila=mysqli_fetch_assoc($datos)){
	$periodo=$fila['anio']." ".$fila['nombre'];
	$_SESSION['periodo']=$fila['id_pa'];
	for($i=$fila['cuatri'];$i<=11;$i=$i+3){
		if($i<=6){
			$tec_cuatri=$tec_cuatri."<option value='$i'>$i</option>";
		}
		else{
			$ing_cuatri=$ing_cuatri."<option value='$i'>$i</option>";
		}
	}
}


//Busca materias del profesor
$materias='';
$datos=busca_materia_profesor2($_SESSION['id'],$_SESSION['periodo']);
$c_mat=0;
while($fila=mysqli_fetch_assoc($datos)){
	$materias=$materias."		
		<div class='pdf-item' onclick='muestra(".$fila['id_mp'].")'>
            ".$fila['materia']."
            <div class='name'>".$fila['siglas']." ".$fila['cuatrimestre']."</div>
            <div class='date'>$periodo</div>
			<hr width='90%'>
			<a href='lista.php?mp=".$fila['id_mp']."'><img src='../general/im/lista.png'></a>
			<a href='calificaciones.php'><img src='../general/im/cali.png'></a>
			<a href='agenda.php'><img src='../general/im/agenda.png'></a>
			<a href='pdf.php'><img src='../general/im/pdf-icon.png'></a>
        </div>";
	$c_mat=$c_mat+1;
}

if($c_mat>0){
	//Verifica si ya se activo permiso de horario
	$datos=bAppHorario($_SESSION['id'],3);
	if($fila=mysqli_fetch_assoc($datos)){
	}
	else{
		$datos2=busca_periodo();
		$fila2=mysqli_fetch_assoc($datos2);
		activa_aplicacion($_SESSION['id'],3,$fila2['ff']);
	}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/css/dashboard.css">
	<link rel="stylesheet" href="../general/css/grupo.css">
	<script src='../general/js/emergente.js'></script>

    <title>Dashboard</title>

</head>
<body>
<div id="oscuro"></div>

<?php
	barra_lateral();
?>

    <div class="contenido">
        <div class="cabecera">
            <h1>Bienvenido</h1>
        </div>
		<?php
			echo $verifica."<div class='contenedor'>";
			echo $periodo;
		?>
		

    <div class="pdf-grid">
		<?php
			echo $materias;
		?>
		
        <div class="pdf-item" onclick='emergente(1);'>
            <span class='mas'>+</span>
            <div class="texto_grupo">Agregar Grupo</div>
        </div>
		



    </div>
		
			
        </div>
    </div>
	
				<div id="emergente1" class='emergentes'>
				<span class="close-btn" onclick='cierra(1);'>&times;</span>
				<h3>Editar Información</h3>
				<form method='POST' action='materia_guarda.php'>

					Tipo: 
					<div class="button-container">
						<button type='button' class="btn seleccion" id='c1' onclick="eligeCarrera(1)">Técnico</button>
						<button type='button' class="btn" id='c2' onclick="eligeCarrera(2)">Ingeniería</button>
						<button type='button' class="btn" id='c3' onclick="eligeCarrera(3)">Licenciatura</button>
					</div>
					
					<br>
					<div id='vigencia'>
						Vigencia: 
						<div class="button-container">
							<button type='button' class="btn seleccion" id='c12' onclick="eligeCarrera('12')">Nuevo</button>
							<button type='button' class="btn" id='c11' onclick="eligeCarrera('11')">Anterior</button>
						</div>
					</div>
					
					<br>
					Carrera:
					<select id="l11" onclick='cambia_carrera(11);' onchange='cambia_carrera(11);' hidden>
						<?php echo $tec11;?>
					</select>
					<select id="l12" onclick='cambia_carrera(12);' onchange='cambia_carrera(12);'>
						<?php echo $tec12;?>
					</select>
					<select id="l2" onclick='cambia_carrera(2);' onchange='cambia_carrera(2);' hidden>
						<?php echo $ing;?>
					</select>
					<select id="l3" onclick='cambia_carrera(3);' onchange='cambia_carrera(3);' hidden>
						<?php echo $lic;?>
					</select>
					<input type="hidden" name='carrera' id='carrera'>
					
					<br>
					Cuatrimestre:
					<select id='cuat1' onclick='cambia_cuatri(1);' onchange='cambia_cuatri(1);' >
						<?php echo $tec_cuatri; ?>
					</select>
					
					<select id='cuat2' onclick='cambia_cuatri(2);' onchange='cambia_cuatri(2);' hidden>
						<?php echo $ing_cuatri; ?>
					</select>
					<input type="hidden" name='cuatri' id='cuatri'><br>
					
					Materia:
					<input type="text" name='materia' id='materia'><br>
					<button type="submit">Guardar</button>
				</form>
			</div>

</body>
</html>

    <script>
        function eligeCarrera(id) {
			carrera_oculta();
			cuatri_oculta();
			reinicia_select();
			document.getElementById('c'+id).classList.add('seleccion');
			
			if(id==1){
				document.getElementById('vigencia').style.display='block';
				document.getElementById('l12').style.display='block';
				document.getElementById('c12').classList.add('seleccion');
				document.getElementById('cuat1').style.display='block';
			}
			else{
				document.getElementById('vigencia').style.display='none';
				document.getElementById('l'+id).style.display='block';
				document.getElementById('cuat2').style.display='block';
			}
			
			if(id>10){
				document.getElementById('vigencia').style.display='block';
				document.getElementById('l'+id).style.display='block';
				document.getElementById('c1').classList.add('seleccion');
				document.getElementById('c'+id).classList.add('seleccion');

			}
        }
		

		
		function carrera_oculta(){
			for(i=1;i<=3;i++){
				document.getElementById('c'+i).classList.remove('seleccion');
			}
			document.getElementById('c11').classList.remove('seleccion');
			document.getElementById('c12').classList.remove('seleccion');

			document.getElementById('l11').style.display='none';
			document.getElementById('l12').style.display='none';
			document.getElementById('l2').style.display='none';
			document.getElementById('l3').style.display='none';
			

	
		}
		
		function cuatri_oculta(){
			document.getElementById('cuat1').style.display='none';
			document.getElementById('cuat2').style.display='none';
		}
		
		function cambia_carrera(id){
			document.getElementById('carrera').value=document.getElementById('l'+id).value;
		}
		
		function cambia_cuatri(id){
			document.getElementById('cuatri').value=document.getElementById('cuat'+id).value;
		}
		
		function reinicia_select(){
			document.getElementById('l11').value='';
			document.getElementById('l12').value='';
			document.getElementById('l2').value='';
			document.getElementById('l3').value='';
			document.getElementById('cuat1').value='';
			document.getElementById('cuat2').value='';
			document.getElementById('carrera').value='';
			document.getElementById('cuatri').value='';
		}
    </script>

