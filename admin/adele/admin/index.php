<?php
session_start();
include('../funciones.php');
include('../general/db/conecta.php');
include('../general/db/usuario.php');

if (!isset($_SESSION['id'])){
	header('location:../index.php');
	die();
}

$verifica=verifica_cuenta();

$datos=busca_desactivados();
$desactivados="
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
				<tbody>";
$i=0;
while($fila=mysqli_fetch_assoc($datos)){
	$i=$i+1;
	$desactivados=$desactivados."
	                <tr>
                        <td>$i</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['ap']."</td>
                        <td>".$fila['am']."</td>
                        <td>".$fila['correo']."</td>
                        <td>
							<a href='estado.php?id=".$fila['id_usuario']."&edo=1'>
								<button class='boton boton-activar'>Activar</button>
							</a> &nbsp; &nbsp;
							<a href='estado.php?id=".$fila['id_usuario']."&edo=2'>
								<button class='boton boton-eliminar'>Eliminar</button>
							</a>
                        </td>
                    </tr>
	";
}
$desactivados=$desactivados."
				</tbody>
            </table>";
			
if($i==0){
	$desactivados="No hay cuentas por activar";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../general/css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>

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
		
		<div class="tabla-contenedor">
		<?php echo $desactivados; ?>
			
        </div>
    </div>

</body>
</html>
