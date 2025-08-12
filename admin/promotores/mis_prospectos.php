<?php
session_start();
include('../funciones.php');
include('../../general/consultas/usuario.php');
include('../../general/consultas/admin.php');
include('../../general/consultas/basic.php');
include('../../general/consultas/carreras.php');
include('../../general/consultas/prospecto.php');

cabeza();
menu_i();



$id=$_SESSION["ad_id"];



if(isset($id)){
	$datos=b_u_pros($id);
	$est="";
    $prospectos="";
	while ($fila=mysqli_fetch_assoc($datos)){
		$datos2=ult_seg($fila['id_prospecto']);
		if($fila2=mysqli_fetch_assoc($datos2)){
			$est=$fila2['estatus'];
		}
        $prospectos=$prospectos."<tr><td>".$fila['id_prospecto']."</td><td>".$fila['nombre']."</td><td>".$fila['ap_pat']."</td><td>".$fila['ap_mat']."</td>
        <td>".$fila['numero']."</td><td>".$fila['m_contacto']."</td><td>".$fila['c_insc']."</td><td>".$fila['c_mens']."</td><td>".$fila['c_cert']."</td>
        <td>".$fila['modalidad']."</td><td>".$fila['carrera']."</td><td>".$est."</td>
		<td><a href='historial.php?ver=".$fila['id_prospecto']."'><button class='ver'>Ver</button></a></td>
    <td><a href='editar.php?edit=".$fila['id_prospecto']."'><button class='ver'>Editar</button></a></td></tr>";
      
	}

	 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Prospectos</title>
   
</head>

<body>


<div class="titulo">
	<br>Mis Prospectos<br>
</div>

				<table class="registro" border=".5">
				
				
					  <th>ID</th>
					  <th>Nombre</th>
					  <th>A. Paterno</th>
            <th>A. Materno</th>
					  <th>Teléfono</th>
            <th>Med. Contacto</th>
            <th>Inscripción</th>
            <th>Mensualidad</th>
            <th>Certificado</th>
            <th>Modalidad</th>
            <th>Servicio</th>
            <th>Estatus</th>
            <th>Observaciones </th>
            <th>Editar </th>
					
				
                <?php
				echo $prospectos;
                
               ?>
				
			</table>



			
            <a href='inpros.php'><button class="botons">Regresar</button></a>
</body>
</html>
