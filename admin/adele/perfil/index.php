<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');
include('../general/db/profesor.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
}

$verifica=verifica_cuenta();

$estudios="";
$acronimo="";
$datos=busca_estudios($_SESSION['id']);
while($fila=mysqli_fetch_assoc($datos)){
	$estudios=$estudios.$fila['acronimo']."<br>".$fila['carrera']."<br><br>";
	$acronimo=$fila['acronimo'];
}

$datos=busca_id($_SESSION['id']);
$fila=mysqli_fetch_assoc($datos);
$nombre=$fila['nombre'];
$ap=$fila['ap'];
$am=$fila['am'];
$fn=$fila['fn'];
$correo=$fila['correo'];

$contacto=$correo;
$datos=busca_tel($_SESSION['id']);
while($fila=mysqli_fetch_assoc($datos)){
	$contacto=$contacto."<br><a href='http://wa.me/".$fila['numero']."' target='_blank'>".$fila['numero']."</a>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/css/dashboard.css">
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
            <h1>Bienvenido al Dashboard</h1>
        </div>
		<?php
			echo $verifica."<div class='contenedor'>";
		?>
		<div class='tabla-contenedor'>
			<div id='generales' class='borde-redondo'>	
				<?php echo "
					<center>
						<h1>
							<span id='acr'>".$acronimo."</span> 
							<span id='nombre'> ".$nombre."</span>
						</h1>
						<h2><span id='ap'>".$ap."</span>
						<span id='am'>".$am."</span></h2>
					</center>"; 
				?>
				
				<center>
					<img src='../general/im/perfil.png' width='150px' id='foto'>
				</center>
								<?php echo "
					
				<br>Fecha de nacimiento: <span id='fn'>".$fn."</span>"; 
				?>
				<hr>
				<img src='../general/im/editar.png' width='30px' title="Editar datos generales" align='right' id='editar' onclick='emergente(1);' >.
			</div><br>
			
			<div id='generales' class='borde-redondo'>
				<br>Información de estudios<br>
				<?php echo $estudios; ?>
				<hr>
				<img src='../general/im/agregar.png' width='30px' title="Editar datos generales" align='right' id='editar' onclick='emergente(2);' >.
			</div><br>

			<div id='generales' class='borde-redondo'>
				<br><br>Datos de contacto<br>
				<?php echo $contacto; ?>
				<hr>
				<img src='../general/im/editar.png' width='30px' title="Editar datos generales" align='right' id='editar' onclick='emergente(3);' >.
			</div>
		</div>

		
			<div id="emergente1" class='emergentes'>
				<span class="close-btn" onclick='cierra(1);'>&times;</span>
				<h3>Editar Información</h3>
				<form method='POST' action='generales_actualiza.php'>
					Nombre(s):
					<input type="text" id="nombre" name="nombre" value='<?php echo $nombre;?>' required ><br>
					Apellido Paterno:
					<input type="text" id="ap" name="ap" required value='<?php echo $ap;?>'><br>
					Apellido Materno:
					<input type="text" id="am" name="am" required value='<?php echo $am;?>'><br>
					Fecha de nacimiento:
					<input type="date" id="fn" name="fn" required value='<?php echo $fn;?>'><br>
				  	Imagen de perfil:
					<input type="file" id="foto" name="foto" accept="image/*">
					<button type="submit">Guardar</button>
				</form>
		  </div>
		</div>
	  
	  <div id="emergente2" class='emergentes'>
			<span class="close-btn" onclick='cierra(2);'>&times;</span>
			<h3>Editar Información</h3>
			<form method='POST' action='carrera_guarda.php'>
				Nivel:
				<select name='nivel' required>
					<option value='1'>Licenciatura</option>
					<option value='2'>Maestría</option>
					<option value='3'>Doctorado</option>
				</select>
				Acrónimo:
				<input type="text" id="acronimo" name="acronimo">
				Carrera:
				<input type="text" id="carrera" name="carrera" required>
				<button type="submit">Guardar</button>
			</form>
	  </div>
	  
		<div id="emergente3" class='emergentes'>
			<span class="close-btn" onclick='cierra(3);'>&times;</span>
			<h3>Editar Información</h3>
			<form id="formulario_editar">
        <div class="grupo-formulario">
            <label for="phone">Teléfono</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="grupo-formulario">
            <label for="institutional-email">Correo Institucional</label>
            <input type="email" id="institutional-email" name="institutional-email" required>
        </div>

        <div class="grupo-formulario">
            <label for="personal-email">Correo Personal</label>
            <input type="email" id="personal-email" name="personal-email">
        </div>
			</form>
		</div>
    </div>

</body>
</html>


